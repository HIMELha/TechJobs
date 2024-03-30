<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::latest()->paginate(12);
        return view('admin.pages', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.createpages');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|unique:pages|max:255',
            'description' => 'required|string|max:50000',
            'keywords' => 'required|string|max:255',
            'status' => 'boolean',
        ]);

        $page = Page::create($validatedData);
        return redirect()->route('pages.index')->with('success', 'Page created successfully');
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
        $page = Page::find($id);

        if(!$page){
            return redirect()->back()->withError('Page not found');
        }

        return view('admin.updatepages', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        $page = Page::find($id);
        $validatedData = $request->validate([
            'title' => 'required|string|unique:pages,title,'.$page->id.',id|max:255',
            'description' => 'required|string|max:50000',
            'keywords' => 'required|string|max:255',
            'status' => 'boolean',
        ]);

        
        if(!$page){
            return redirect()->back()->withError('Page not found');
        }

        $page->update($validatedData);

        return redirect()->route('pages.index')->with('success', 'Page updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $page = Page::find($id);

        if(!$page){
            return redirect()->back()->withError('Page not found');
        }

        $page->delete();
        return redirect()->back()->withSuccess('Page deleted successfully');
    }
}
