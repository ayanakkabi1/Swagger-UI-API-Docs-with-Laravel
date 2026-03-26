<?php

namespace App\Http\Controllers;

use App\Models\Banana;
use Illuminate\Http\Request;

class BananaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Banana::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'nullable|integer|min:0',
        ]);

        $banana = Banana::create($validated);
        return response()->json($banana, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Banana $banana)
    {
        return response()->json($banana, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banana $banana)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string',
            'description' => 'nullable|string',
            'price' => 'sometimes|numeric|min:0',
            'quantity' => 'nullable|integer|min:0',
        ]);

        $banana->update($validated);
        return response()->json($banana, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banana $banana)
    {
        $banana->delete();
        return response()->json(['message' => 'Banana deleted successfully'], 200);
    }
}
