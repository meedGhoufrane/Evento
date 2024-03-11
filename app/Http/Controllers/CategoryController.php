<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        return view('admin.category.index', compact('categories'));
    }
    public function create()
    {
        return view('admin.category.create');
    }
    public function edit(Categories $category)
    {
        return view('admin.category.edit', compact('category'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);
    
        $categories = Categories::create($request->all());
        return redirect()->route('admin.category.index')->with('success', 'Category created successfully.');
    }
    
    public function show($id)
    {
        $category = Categories::find($id);
        if (!$category) {
            return redirect()->route('category.index')->with('error', 'Category not found.');
        }
        return view('admin.category.show', compact('category'));
    }
    
    public function update(Request $request, $id)
    {
        $category = Categories::find($id);
        if (!$category) {
            return redirect()->route('category.index')->with('error', 'Category not found.');
        }
    
        $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);
    
        $category->name = $request->name;
        $category->save();
        return redirect()->route('admin.category.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = Categories::find($id);
        if (!$category) {
            return redirect()->route('admin.category.index')->with('error', 'Category not found.');
        }
        $category->delete();
        return redirect()->route('admin.category.index')->with('success', 'Category deleted successfully.');
    }
    
}
