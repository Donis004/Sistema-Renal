<?php

namespace App\Http\Controllers\Paciente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Comida;
use App\Models\ComidaDetalle;
use App\Models\Alimento;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ComidaPacienteController extends Controller
{
    // Mostrar el historial de comidas del día actual
    public function index()
    {
        $paciente = Auth::user()->pacientes()->first();
        $hoy = Carbon::today();

        // Traemos las comidas de hoy, ordenadas por hora, incluyendo sus detalles y alimentos
        $comidas = Comida::with('comidaDetalles.alimento')
            ->where('id_paciente', $paciente->id_paciente)
            ->whereDate('fecha_hora', $hoy)
            ->orderBy('fecha_hora', 'asc')
            ->get();

        return view('paciente.comidas.index', compact('comidas'));
    }

    // Mostrar el formulario manual
    public function createManual()
    {
        // Traemos todos los alimentos para llenar el <select>, ordenados alfabéticamente
        $alimentos = Alimento::orderBy('nombre', 'asc')->get();
        
        return view('paciente.comidas.create_manual', compact('alimentos'));
    }

    // Guardar la comida registrada manualmente (Múltiples alimentos)
    public function storeManual(Request $request)
    {
        // 1. Validamos que lleguen los arrays correctamente
        $request->validate([
            'alimentos' => 'required|array|min:1',
            'alimentos.*' => 'exists:alimentos,id_alimento', // Cada ID debe existir
            'cantidades' => 'required|array|min:1',
            'cantidades.*' => 'numeric|min:0.1', // Cada cantidad debe ser válida
        ]);

        $paciente = Auth::user()->pacientes()->first();

        // 2. Creamos el registro "Padre" (El plato completo)
        $comida = Comida::create([
            'id_paciente' => $paciente->id_paciente,
            'tipo_registro' => 'MANUAL',
            'fecha_hora' => now(), 
        ]);

        // 3. Recorremos los alimentos enviados y creamos los detalles (Los ingredientes)
        foreach ($request->alimentos as $index => $id_alimento) {
            ComidaDetalle::create([
                'id_comida' => $comida->id_comida,
                'id_alimento' => $id_alimento,
                'cantidad_porcion' => $request->cantidades[$index],
            ]);
        }

        // 4. (Opcional pero recomendado) Actualizar fecha_actualizacion en LimitesNutricionales
        // Esto dispara que el dashboard calcule con datos frescos si usas caché, aunque no es estrictamente necesario aquí.

        return redirect()->route('paciente.comidas.index')
            ->with('success', '¡Plato registrado! Tus niveles de nutrientes han sido actualizados.');
    }

    // ==========================================
    // MÓDULO DE IA CON GEMINI
    // ==========================================
    
    public function createFoto()
    {
        return view('paciente.comidas.create_foto');
    }

    public function procesarFoto(Request $request)
    {
        $request->validate([
            'foto_comida' => 'required|image|max:5120', // Máximo 5MB
        ]);

        // 1. Guardar la imagen temporalmente para mostrarla en la vista
        $path = $request->file('foto_comida')->store('temp_comidas', 'public');
        $imagenBase64 = base64_encode(file_get_contents($request->file('foto_comida')->path()));
        $mimeType = $request->file('foto_comida')->getMimeType();

        // 2. Construir el Prompt para la IA
        $prompt = 'Eres un experto nutricionista especializado en dietas para pacientes con Enfermedad Renal Crónica (ERC). 
        Analiza esta imagen y detecta los alimentos. Devuelve ÚNICAMENTE un objeto JSON válido, sin formato markdown ni texto adicional.
        Usa estrictamente esta estructura:
        {
            "observacion_general": "Breve comentario sobre el plato en el contexto renal",
            "alimentos": [
                {
                    "nombre": "Nombre del alimento",
                    "porcion_estandar": "Ej: 1 taza, 100g, 1 filete",
                    "cantidad_detectada": 1,
                    "potasio_mg": 250,
                    "fosforo_mg": 150,
                    "sodio_mg": 50,
                    "proteina_g": 10.5,
                    "es_peligroso": false,
                    "motivo_riesgo": "Solo si es peligroso (ej. Alto en potasio), sino null"
                }
            ]
        }';

        // 3. Consumir la API de Gemini 2.5 Flash
        $apiKey = env('GEMINI_API_KEY');
        // CAMBIO 1: Actualizamos la versión del modelo en la URL
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}";

        try {
            $response = Http::post($url, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt],
                            [
                                // CAMBIO 2: Llaves en camelCase exacto
                                'inlineData' => [
                                    'mimeType' => $mimeType,
                                    'data' => $imagenBase64
                                ]
                            ]
                        ]
                    ]
                ],
                // CAMBIO 3: Forzamos la salida en formato JSON
                'generationConfig' => [
                    'responseMimeType' => 'application/json'
                ]
            ]);

            if ($response->successful()) {
                // Extraer el texto de la respuesta
                $geminiText = $response->json('candidates.0.content.parts.0.text');
                
                // Limpiar posibles etiquetas residuales de markdown por seguridad
                $geminiText = str_replace(['```json', '```'], '', $geminiText);
                $resultadoIa = json_decode(trim($geminiText), true);

                if (!$resultadoIa || !isset($resultadoIa['alimentos'])) {
                    throw new \Exception("Formato JSON inválido devuelto por la IA.");
                }

                return view('paciente.comidas.analisis', [
                    'resultadoIa' => $resultadoIa,
                    'rutaImagen' => $path
                ]);
            } else {
                // Si la API falla, mostramos el error real para poder depurar
                $errorDetails = $response->json('error.message') ?? 'Error desconocido';
                return back()->withErrors(['foto_comida' => 'Error de la API: ' . $errorDetails]);
            }
        } catch (\Exception $e) {
            return back()->withErrors(['foto_comida' => 'No pudimos analizar la imagen: ' . $e->getMessage()]);
        }
    }

    public function confirmarIa(Request $request)
    {
        // Validar que vengan los arrays de datos desde la vista
        $request->validate([
            'nombres' => 'required|array',
            'cantidades' => 'required|array',
            'potasios' => 'required|array',
            'fosforos' => 'required|array',
            'sodios' => 'required|array',
            'proteinas' => 'required|array',
            'porciones_estandar' => 'required|array',
        ]);

        $paciente = Auth::user()->pacientes()->first();

        // 1. Crear el registro Padre (Comida FOTO)
        $comida = Comida::create([
            'id_paciente' => $paciente->id_paciente,
            'tipo_registro' => 'FOTO',
            'fecha_hora' => now(),
        ]);

        // 2. Procesar cada alimento detectado
        foreach ($request->nombres as $index => $nombre) {
            
            // Buscar si el alimento ya existe en nuestra base de datos, si no, crearlo "al vuelo"
            $alimento = Alimento::firstOrCreate(
                ['nombre' => $nombre], // Busca por nombre exacto
                [
                    'potasio_mg' => $request->potasios[$index],
                    'fosforo_mg' => $request->fosforos[$index],
                    'sodio_mg' => $request->sodios[$index],
                    'proteina_g' => $request->proteinas[$index],
                    'porcion_estandar' => $request->porciones_estandar[$index],
                    'seguro_renal' => true, // Por defecto
                    'estado' => true,
                ]
            );

            // 3. Crear el detalle de la comida
            ComidaDetalle::create([
                'id_comida' => $comida->id_comida,
                'id_alimento' => $alimento->id_alimento,
                'cantidad_porcion' => $request->cantidades[$index],
            ]);
        }

        return redirect()->route('paciente.comidas.index')
            ->with('success', '¡Análisis guardado exitosamente!');
    }
}