<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            Cliente::all()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate(
                [
                    'nombre' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'unique:clientes', 'max:255'],
                    'telefono' => ['required', 'max:9'],
                    'localidad' => ['required', 'max:255'],
                    'codigoPostal' => ['required', 'max:5'],
                    'provincia_id' => ['required', 'exists:provincias,id'],
                    'tipo' => ['required', 'boolean'],
                ]
            );
            $cliente = Cliente::create($request->all());
            return response()->json($cliente);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => $e->validator->errors()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            return response()->json($cliente);
        } catch (\Exception $e) {
            return response()->json([], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate(
                [
                    'nombre' => ['string', 'max:255'],
                    'email' => ['string', 'email', 'unique:clientes', 'max:255'],
                    'telefono' => ['max:9'],
                    'localidad' => ['max:255'],
                    'codigoPostal' => ['max:5'],
                    'provincia_id' => ['exists:provincias,id'],
                    'tipo' => ['boolean'],
                ]
            );
            try {
                $newData = Cliente::findOrFail($id)->fill($request->all());
                $newData->save();
                return response()->json(
                    $newData
                );
            } catch (\Exception $e) {
                return response()->json([], 500);
            }
        } catch (ValidationException $e) {
            return response()->json([
                'message' => $e->validator->errors()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            $cliente->delete();
            return response()->json(
                $cliente
            );
        } catch (\Exception $e) {
            return response()->json([], 500);
        }
    }
}
