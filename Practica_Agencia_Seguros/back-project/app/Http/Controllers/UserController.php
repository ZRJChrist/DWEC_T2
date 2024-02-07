<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(User::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'unique:users', 'max:255'],
                'password' => ['required', 'string', 'min:6'],
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return response()->json($user);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->validator->errors()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $user = User::findOrFail($id);

            return response()->json($user);
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
            $request->validate([
                'name' => ['string', 'max:255'],
                'email' => ['string', 'email', 'unique:users', 'max:255'],
                'password' => ['string', 'min:6'],
            ]);

            try {
                $newData = User::findOrFail($id)->fill($request->all());
                $newData->save();

                return response()->json($newData);
            } catch (\Exception $e) {
                return response()->json([], 500);
            }
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->validator->errors()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json($user);
        } catch (\Exception $e) {
            return response()->json([], 500);
        }
    }
}
