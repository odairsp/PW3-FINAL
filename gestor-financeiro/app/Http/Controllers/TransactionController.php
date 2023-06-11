<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::whereBelongsTo(Auth::user())->orderBy('date')->get();
        return view('dashboard', ['transactions' => $transactions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $transactions = Transaction::whereBelongsTo(Auth::user())->orderBy('name')->get();
        $categories = Category::all()->sortBy('name');
        return view('create', ['transactions' => $transactions, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $transaction = new Transaction();
        $transaction->user_id = $request->user_id;
        $transaction->category_id = $request->category;
        $transaction->name = $request->name;

        if ($request->recurrent) {
            $transaction->recurrent = 1;
        } else {
            $transaction->recurrent = 0;
        }
        if ($request->is_spent) {
            $transaction->is_spent = 1;
            $transaction->value = $request->value * -1;
        } else {
            $transaction->is_spent = 0;
            $transaction->value = $request->value;
        }

        $transaction->date = $request->date;
        $transaction->save();

        return redirect(route('transactions/create'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        $transactions = Transaction::whereBelongsTo(Auth::user())->orderBy('date')->get();
        $categories = Category::all()->sortBy('name');
        return view('edit', ['transactions' => $transactions, 'categories' => $categories, 'transaction' => $transaction]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $transaction->category_id = $request->category;
        $transaction->name = $request->name;
        if ($request->recurrent) {
            $transaction->recurrent = 1;
        } else {
            $transaction->recurrent = 0;
        }
        if ($request->is_spent) {
            $transaction->is_spent = 1;
            if ($request->value > 0) {
                $transaction->value = $request->value * -1;
            }else{
                $transaction->value = $request->value;
            }

        } else {
            $transaction->is_spent = 0;
            if ($request->value < 0) {
                $transaction->value = $request->value * -1;
            }else{
                $transaction->value = $request->value;
            }
        }
        $transaction->date = $request->date;
        $transaction->save();
        return redirect('transactions/create')->with('msg', 'Transação "' . $transaction->name . '", alterada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        
        return redirect('transactions/create')->with('msg', 'Transação - "' . $transaction->name . '", excluida com sucesso!');

    }
}
