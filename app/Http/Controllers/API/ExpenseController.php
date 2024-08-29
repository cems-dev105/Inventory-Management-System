<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenseList = Expense::all();

        return response()->json([
            'status' => 'success',
            'message' => 'All expense list..',
            'data' => $expenseList
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'details' => 'required|max:255',
            'amount' => 'required'
        ]);

        $expense = new Expense();
        $expense->details = $request->details;
        $expense->amount = $request->amount;
        $expense->date = date('d/m/Y');
        $expense->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Expense created successfully!',
            'data' => $expense
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $expense = Expense::find($id);

        if ($expense)
        {

            return response()->json([
                'status' => 'success',
                'message' => 'Expense found!',
                'data' => $expense
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Expense not found!',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $expenseUpdate = Expense::find($id);

        if($expenseUpdate)
        {

            $expenseUpdate->update($request->all());

            return response()->json([
                'status' => 'success',
                'message' => 'Expense Updated!',
                'data' => $expenseUpdate
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Expense not found!',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $expenseDelete = Expense::find($id);

        if ($expenseDelete)
        {
            $expenseDelete->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Expense deleted successfully!',
                'data' => $expenseDelete
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Expense not found!',
            ], 404);
        }
    }
}
