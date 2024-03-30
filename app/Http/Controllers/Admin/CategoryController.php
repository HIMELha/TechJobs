<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(12);
        return view('admin.categories', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }

        Category::create([
            'name' => $request->name
        ]);

        return redirect()->back()->withSuccess('Category created succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);

        if(!$category){
            return redirect()->back()->withError('Category not found');
        }

        return view('admin.categoryedit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);

        if(!$category){
            return redirect()->back()->withError('Category not found');
        }

        $category->name = $request->name;
        $category->save();

        return redirect()->route('category.index')->withSuccess('Category updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if(!$category){
            return redirect()->back()->withError('Category not found');
        }

        $category->delete();
        return redirect()->back()->withSuccess('Category deleted successfully');
    }
}
