<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function index()
    {
        return Compra::all();
    }

    public function store(Request $request)
    {
        $compra = Compra::create($request->all());
        return response()->json($compra, 201);
    }

    public function show($id)
    {
        return Compra::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $compra = Compra::findOrFail($id);
        $compra->update($request->all());
        return response()->json($compra, 200);
    }

    public function destroy($id)
    {
        Compra::destroy($id);
        return response()->json(null, 204);
    }
}
