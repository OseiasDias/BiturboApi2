<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    // Função para listar todos os métodos de pagamento
    public function index()
    {
        $paymentMethods = PaymentMethod::all();
        return response()->json($paymentMethods);
    }

    // Função para exibir um único método de pagamento
    public function show($id)
    {
        $paymentMethod = PaymentMethod::find($id);

        if ($paymentMethod) {
            return response()->json($paymentMethod);
        } else {
            return response()->json(['message' => 'Método de pagamento não encontrado'], 404);
        }
    }

    // Função para criar um novo método de pagamento
    public function store(Request $request)
    {
        $request->validate([
            'payment_method_name' => 'required|string|max:50',
        ]);

        $paymentMethod = PaymentMethod::create([
            'payment_method_name' => $request->payment_method_name,
        ]);

        return response()->json(['message' => 'Método de pagamento criado com sucesso!', 'data' => $paymentMethod], 201);
    }

    // Função para atualizar um método de pagamento existente
    public function update(Request $request, $id)
    {
        $paymentMethod = PaymentMethod::find($id);

        if ($paymentMethod) {
            $request->validate([
                'payment_method_name' => 'required|string|max:50',
            ]);

            $paymentMethod->update([
                'payment_method_name' => $request->payment_method_name,
            ]);

            return response()->json(['message' => 'Método de pagamento atualizado com sucesso!', 'data' => $paymentMethod]);
        } else {
            return response()->json(['message' => 'Método de pagamento não encontrado'], 404);
        }
    }

    // Função para excluir um método de pagamento
    public function destroy($id)
    {
        $paymentMethod = PaymentMethod::find($id);

        if ($paymentMethod) {
            $paymentMethod->delete();
            return response()->json(['message' => 'Método de pagamento excluído com sucesso!']);
        } else {
            return response()->json(['message' => 'Método de pagamento não encontrado'], 404);
        }
    }
}
