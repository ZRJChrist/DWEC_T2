<?php

namespace App\Http\Controllers;

use App\Enums\PolizaEnums;
use App\Http\Controllers\Controller;
use App\Models\Poliza;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PolizaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            Poliza::all()
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
                    'cliente_id' => ['required', 'exists:clientes,id'],
                    'numero' => ['required', 'string', 'max:255'],
                    'importe' => ['required', 'decimal:2'],
                    'fecha' => ['required', 'after:now'],
                    'estado' => ['required', Rule::enum(PolizaEnums::class)],
                ]
            );
            $poliza = Poliza::create($request->all());
            return response()->json($poliza);
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
            $poliza = Poliza::findOrFail($id);
            return response()->json($poliza);
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
                    'cliente_id' => ['exists:clientes,id'],
                    'numero' => ['string', 'max:255'],
                    'importe' => ['decimal:2'],
                    'fecha' => ['after:now'],
                    'estado' => [Rule::enum(PolizaEnums::class)],
                ]
            );
            try {
                $newData = Poliza::findOrFail($id)->fill($request->all());
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
            $cliente = Poliza::findOrFail($id);
            $cliente->delete();
            return response()->json(
                $cliente
            );
        } catch (\Exception $e) {
            return response()->json([], 500);
        }
    }
}
