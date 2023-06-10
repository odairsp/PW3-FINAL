<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all()->sortBy('name');
        return view('categories.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = ucwords($request->name);
        $category->description = ($request->description);
        $category->save();

        return redirect('categories/create')->with('msg', 'Categoria - "' . $category->name . '", adicionada com sucesso!');
    }

    /**s
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $categories = Category::all()->sortBy('name');
        return view('categories.show', ['category' => $category, 'categories' => $categories]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {

        $categories = Category::all()->sortBy('name');
        return view('categories.edit', ['category' => $category, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        return redirect('categories/create')->with('msg', 'Categoria - "' . $category->name . '", editada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        dd(Transaction::whereBelongsTo($category)->get());

        if (Transaction::whereBelongsTo($category)->get()) {
            return redirect('categories/create')->with('alert', 'Categoria - "' . $category->name . '", Não é possivel deletar categoria vinculada a transação!');
        }

        $category->delete();

        return redirect('categories/create')->with('msg', 'Categoria - "' . $category->name . '", excluida com sucesso!');
    }
}
