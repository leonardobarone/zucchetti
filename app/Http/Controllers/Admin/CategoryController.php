<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    protected $validationRules = [
        'name' => 'required|string|max:50|unique:categories,name'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validazione
        $request->validate($this->validationRules);
        // creazione categoria
        $newCategory = new Category();
        $newCategory->fill($request->all());
        $newCategory->slug = Str::of($newCategory['name'])->slug('-');
        $newCategory->save();
        // redirect
        return redirect()->route('admin.categories.index')->with('success', "La categoria {$newCategory['id']} è stata creata!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validation = $this->validationRules;
        $validation['name'] = 'required|string|max:50|unique:categories,name'.",{$category->id}";
        $request->validate($validation);

        if ($category->name != $request->name) {
            $category->slug = Str::of($request['name'])->slug('-');
        }

        $category->fill($request->all());
        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Hai modificato la categoria!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $category = Category::find($request->id);
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', "Hai eliminato la categoria: {$category->id}");
    }
}
