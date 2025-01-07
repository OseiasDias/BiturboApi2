<?php

namespace App\Http\Controllers;

use App\Models\Taxa;
use Illuminate\Http\Request;

class TaxaController extends Controller
{
    public function index()
    {
        $taxas = Taxa::all();  // Retorna todas as taxas cadastradas
        return response()->json($taxas);
    }

    public function store(Request $request)
    {
        $request->validate([
            'taxrate' => 'required|string|max:255',
            'tax_number' => 'required|string|max:255',
            'tax' => 'required|numeric',
        ]);

        $taxa = Taxa::create([
            'taxrate' => $request->taxrate,
            'tax_number' => $request->tax_number,
            'tax' => $request->tax,
        ]);

        return response()->json($taxa, 201);
    }

    public function show($id)
    {
        $taxa = Taxa::find($id);

        if (!$taxa) {
            return response()->json(['message' => 'Taxa not found'], 404);
        }

        return response()->json($taxa);
    }

    public function update(Request $request, $id)
    {
        $taxa = Taxa::find($id);

        if (!$taxa) {
            return response()->json(['message' => 'Taxa not found'], 404);
        }

        $taxa->update($request->all());

        return response()->json($taxa);
    }

    public function destroy($id)
    {
        $taxa = Taxa::find($id);

        if (!$taxa) {
            return response()->json(['message' => 'Taxa not found'], 404);
        }

        $taxa->delete();

        return response()->json(['message' => 'Taxa deleted successfully']);
    }
}
