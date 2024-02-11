<?php

namespace App\Http\Controllers;

use App\Enums\PolizaEnums;
use App\Http\Controllers\Controller;

use App\Models\Policy;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            Policy::all()
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
                    'customer_id' => ['required', 'exists:clientes,id'],
                    'number' => ['required', 'unique:Policies,number', 'string', 'max:255'],
                    'mount' => ['required', 'decimal:2'],
                    'status' => ['required', Rule::enum(PolizaEnums::class)],
                    'notes' => ['string', ''],
                ]
            );
            $policies = Policy::create($request->all());
            return response()->json($policies);
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
            $policies = Policy::findOrFail($id);
            return response()->json($policies);
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
                $newData = Policy::findOrFail($id)->fill($request->all());
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
            $policies = Policy::findOrFail($id);
            $policies->delete();
            return response()->json(
                $policies
            );
        } catch (\Exception $e) {
            return response()->json([], 500);
        }
    }
}
