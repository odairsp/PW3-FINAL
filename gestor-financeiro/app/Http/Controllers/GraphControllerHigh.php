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
    public function index(Request $request)
    {
        
        $categoria = $request->input('categoria', 'todas');
        $registros = Transaction::where(function ($query) use ($categoria) {
            if ($categoria !== 'todas') {
                $query->where('category_id', $categoria);
            }
        })->get();

        return view('registros.index', compact('registros', 'categoria'));
    }
}