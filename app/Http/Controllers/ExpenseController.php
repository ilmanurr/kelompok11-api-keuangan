<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveExpenseRequest;
use App\Models\Expense;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;


class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $user = Auth::user();
        $expenses = Expense::where('user_id', $user->id)->latest()->get();

        return response()->json($expenses, Response::HTTP_OK);
    }

    public function showExpensesPage(): View
    {
        $user = Auth::user();
        $expenses = Expense::where('user_id', $user->id)->latest()->get();

        return view('expenses.index', ['expenses' => $expenses]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveExpenseRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = Auth::user();

        $expense = new Expense($data);
        $expense->user_id = $user->id;
        $expense->save();

        return response()->json($expense, Response::HTTP_CREATED);
    }

    public function storeView(SaveExpenseRequest $request)
    {
        $data = $request->validated();
        $user = Auth::user();

        $expense = new Expense($data);
        $expense->user_id = $user->id;
        $expense->save();

        // Redirect pengguna ke halaman pengeluaran
        return Redirect::route('expenses.show');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $expense = Expense::findOrFail($id);

        return response()->json($expense, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SaveExpenseRequest $request, $id)
    {
        try {
            $expense = Expense::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Expense not found'], 404);
        }

        // Validate the request...
        $expense->update($request->validated());

        if ($request->wantsJson()) {
            return response()->json($expense, 200);
        } else {
            // Redirect pengguna ke halaman pengeluaran setelah berhasil menyimpan perubahan
            return Redirect::route('expenses.show');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $expense = Expense::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Expense not found'], 404);
        }

        $expense->delete();

        if (request()->wantsJson()) {
            return response()->json(['message' => 'Expense deleted successfully'], 200);
        } else {
            // Set notifikasi bahwa pengeluaran berhasil dihapus
            Session::flash('message', 'Pengeluaran berhasil dihapus.');

            // Redirect pengguna ke halaman pengeluaran
            return Redirect::route('expenses.show');
        }
    }

    public function filterByDateRange(Request $request): JsonResponse
    {
        $user = Auth::user();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        $expenses = Expense::where('user_id', $user->id)
                         ->whereBetween('expense_date', [$startDate, $endDate])
                         ->get();
    
        return response()->json($expenses, Response::HTTP_OK);
    }

    public function filterAndDisplayByDateRange(Request $request)
    {
        $user = Auth::user();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $expenses = Expense::where('user_id', $user->id)
                        ->whereBetween('expense_date', [$startDate, $endDate])
                        ->latest()
                        ->get();

        return view('expenses.index', ['expenses' => $expenses]);
    }

    public function create(): View
    {
        return view('expenses.create');
    }

    public function edit($expense): View
    {
        $expense = Expense::findOrFail($expense);
        return view('expenses.edit', compact('expense'));
    }
}