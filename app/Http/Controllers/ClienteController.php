<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Cambiar a paginate en lugar de get
        $clientes = Cliente::orderBy('created_at', 'desc')->paginate(10);
        
        return view('clientes.index', compact('clientes'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        try {
            // Validación de datos
            $validator = Validator::make($request->all(), [
                'tipo_documento' => 'required|string|max:10',
                'numero_documento' => 'required|string|max:20',
                'nombres' => 'required|string|max:100',
                'apellido_paterno' => 'required|string|max:100',
                'apellido_materno' => 'required|string|max:100',
                'fecha_nacimiento' => 'nullable|date',
                'telefono' => 'nullable|string|max:20',
                'email' => 'nullable|email|max:100',
                'direccion' => 'nullable|string|max:255',
            ], [
                'tipo_documento.required' => 'El tipo de documento es obligatorio.',
                'numero_documento.required' => 'El número de documento es obligatorio.',
                'nombres.required' => 'Los nombres son obligatorios.',
                'apellido_paterno.required' => 'El apellido paterno es obligatorio.',
                'apellido_materno.required' => 'El apellido materno es obligatorio.',
                'email.email' => 'El formato del email no es válido.',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            // Validación manual para documento único
            $existeCliente = Cliente::where('tipo_documento', $request->tipo_documento)
                ->where('numero_documento', $request->numero_documento)
                ->exists();

            if ($existeCliente) {
                return redirect()
                    ->back()
                    ->with('error', 'Ya existe un cliente con este tipo y número de documento.')
                    ->withInput();
            }

            DB::beginTransaction();

            // Crear el cliente
            $cliente = Cliente::create([
                'tipo_documento' => $request->tipo_documento,
                'numero_documento' => $request->numero_documento,
                'nombres' => $request->nombres,
                'apellido_paterno' => $request->apellido_paterno,
                'apellido_materno' => $request->apellido_materno,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'telefono' => $request->telefono,
                'email' => $request->email,
                'direccion' => $request->direccion,
                'estado' => 'ACTIVO', // Siempre ACTIVO al crear
                'fecha_registro' => now(),
            ]);

            DB::commit();

            return redirect()
                ->route('clientes.index')
                ->with('success', 'Cliente creado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()
                ->back()
                ->with('error', 'Error al crear el cliente: ' . $e->getMessage())
                ->withInput();
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
