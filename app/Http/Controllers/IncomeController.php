<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveIncomeRequest;
use App\Models\Income;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $user = Auth::user();
        $incomes = Income::where('user_id', $user->id)->latest()->get();

        return response()->json($incomes, Response::HTTP_OK);
    }

    public function showIncomesPage()
    {
        $user = Auth::user();
        $incomes = Income::where('user_id', $user->id)->latest()->get();

        return view('incomes.index', ['incomes' => $incomes]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveIncomeRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = Auth::user();

        $income = new Income($data);
        $income->user_id = $user->id;
        $income->save();

        return response()->json($income, Response::HTTP_CREATED);
    }

    public function storeView(SaveIncomeRequest $request)
    {
        $data = $request->validated();
        $user = Auth::user();

        $income = new Income($data);
        $income->user_id = $user->id;
        $income->save();

        // Redirect pengguna ke halaman pendapatan
        return Redirect::route('incomes.show');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $income = Income::findOrFail($id);

        return response()->json($income, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SaveIncomeRequest $request, $id)
    {
        try {
            $income = Income::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Income not found'], 404);
        }

        // Validate the request...
        $income->update($request->validated());

        if ($request->wantsJson()) {
            return response()->json($income, 200);
        } else {
            // Redirect pengguna ke halaman pendapatan setelah berhasil menyimpan perubahan
            return Redirect::route('incomes.show');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $income = Income::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Income not found'], 404);
        }

        $income->delete();

        if (request()->wantsJson()) {
            return response()->json(['message' => 'Income deleted successfully'], 200);
        } else {
            // Set notifikasi bahwa pendapatan berhasil dihapus
            Session::flash('message', 'Pendapatan berhasil dihapus.');

            // Redirect pengguna ke halaman pendapatan
            return Redirect::route('incomes.show');
        }
    }

    public function filterByDateRange(Request $request): JsonResponse
    {
        $user = Auth::user();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        $incomes = Income::where('user_id', $user->id)
                         ->whereBetween('income_date', [$startDate, $endDate])
                         ->get();
    
        return response()->json($incomes, Response::HTTP_OK);
    }

    public function filterAndDisplayByDateRange(Request $request)
    {
        $user = Auth::user();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $incomes = Income::where('user_id', $user->id)
                        ->whereBetween('income_date', [$startDate, $endDate])
                        ->latest()
                        ->get();

        return view('incomes.index', ['incomes' => $incomes]);
    }

    public function create(): View
    {
        return view('incomes.create');
    }

    public function edit($income): View
    {
        $income = Income::findOrFail($income);
        return view('incomes.edit', compact('income'));
    }
}