<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Str;

class CategoriesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $category = new Category();
        return view('admin.categories.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->validated();

        $data['slug'] = Str::slug($data['slug'] ?? $data['name']);

        if (Category::whereSlug($data['slug'])->exists()) {
            return back()->withErrors(['Slug is not unique'])->withInput();
        }

        $category = new Category($data);
        $category->save();

        if ($category) {
            return redirect()->route('admin.categories.index')
                ->with('status', "Category `$category->name` has been created");
        } else {
            return back()->withErrors('msg', "Error")->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Category $category
     * @return Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->input();

        $data['slug'] = Str::slug($data['slug'] ?? $data['name']);

        if (Category::whereSlug($data['slug'])->exists() && Category::whereSlug($data['slug'])->first()->id !== $category->id) {
            return back()->withErrors(['Slug is not unique'])->withInput();
        }

        $category->fill($data);
        $category->save();

        return redirect()->route('admin.categories.index')
            ->with('status', "Category `$category->name` has been edited");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return Response
     * @throws Exception
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('status', "Category `$category->name` has been removed");
    }
}
