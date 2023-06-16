<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Graph;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GraphController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $transactions = Transaction::whereBelongsTo(Auth::user())->orderBy('date')->get();
        $categories = array();
        $dateMin = Carbon::parse($transactions->min('date'))->format('Y-m');
        $count = 0;
        foreach ($transactions as $transaction) {

            if (array_key_exists($transaction->category->name, $categories)) {
                if (array_key_exists('sem categoria', $categories)) {
                    $count += 1;
                    print_r("<pre>{{$count}}</pre>");
                };
                $categories[$transaction->category->name] += $transaction->value;
            } else {
                $categories[$transaction->category->name] = $transaction->value;
            }
        }


        $label = array_keys($categories);
        $values = array_values($categories);


        return view('graph', ['transactions' => $transactions, 'label' => $label, 'values' => $values, 'dateMin' => $dateMin]);
    }



    public function month(Request $request)
    {


        $transactions = Transaction::whereBelongsTo(Auth::user())->whereMonth('date', Carbon::parse($request->month)->format('m'))->get()->groupBy(function ($item) {
            return $item->category->name;
        });


        $dateMin = $request->month;

        $label = $transactions->keys();
        $values = array();

        foreach ($transactions as $transaction) {

            array_push($values, $transaction->sum('value'));
        }



        return view('graph', ['transactions' => $transactions, 'label' => $label, 'values' => $values, 'dateMin' => $dateMin]);
    }

    public function year(int $key)
    {
    }
}