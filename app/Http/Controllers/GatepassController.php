<?php

namespace App\Http\Controllers;

use App\Models\Gatepass;
use Illuminate\Http\Request;

class GatepassController extends Controller
{
    // Método para listar todos os Gatepasses
    public function index()
    {
        $gatepasses = Gatepass::all();
        return response()->json(['data' => $gatepasses], 200);
    }

    // Método para exibir um Gatepass específico
    public function show($id)
    {
        $gatepass = Gatepass::find($id);

        if (!$gatepass) {
            return response()->json(['message' => 'Gatepass não encontrado'], 404);
        }

        return response()->json(['data' => $gatepass], 200);
    }

    // Método para criar um novo Gatepass
    public function store(Request $request)
    {
        $request->validate([
            'jobcard' => 'required',
            'gatepass_no' => 'required',
            'customer_name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'vehicle_name' => 'required',
            'veh_type' => 'required',
            'chassis' => 'required',
            'kms' => 'required',
            'out_date' => 'required|date',
        ]);

        $gatepass = Gatepass::create($request->all());

        return response()->json(['message' => 'Gatepass criado com sucesso!', 'data' => $gatepass], 201);
    }

    // Método para atualizar um Gatepass
    public function update(Request $request, $id)
    {
        $gatepass = Gatepass::find($id);

        if (!$gatepass) {
            return response()->json(['message' => 'Gatepass não encontrado'], 404);
        }

        $gatepass->update($request->all());

        return response()->json(['message' => 'Gatepass atualizado com sucesso!', 'data' => $gatepass], 200);
    }

    // Método para deletar um Gatepass
    public function destroy($id)
    {
        $gatepass = Gatepass::find($id);

        if (!$gatepass) {
            return response()->json(['message' => 'Gatepass não encontrado'], 404);
        }

        $gatepass->delete();

        return response()->json(['message' => 'Gatepass deletado com sucesso!'], 200);
    }
}
