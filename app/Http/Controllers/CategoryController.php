<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function create()
    {
        return view('admin.create_category');
    }

    public function someMethod() // Replace 'someMethod' with your actual method name
    {
        $categories = Category::all(); // Fetch all categories from the database
        return view('inc/nav', compact('categories')); // Pass categories to the view
    }



    public function show($id)
    {
        // Fetch the category by its ID
        $category = Category::findOrFail($id);

        // Get all articles that belong to this category
        $articles = Article::where('category_id', $id)->get();

        // Pass the category and its articles to the view
        return view('category', compact('category', 'articles'));
    }


    // Store a new category in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('admin.index')->with('success', 'Category created successfully!');
    }

    // Display all categories
    public function index()
    {
        $categories = Category::orderBy('position', 'DESC')->get();
        return view('admin.categories.index', compact('categories'));
    }


    public function edit($id)
    {

        $category = Category::find($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->position = $request->position;
        $category->save;

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
    }

    public function hide($id)
{
    $category = Category::find($id);
    $category->is_hidden = true;
    $category->save();

    return redirect()->route('categories.index')->with('success', 'Category hidden successfully!');
}

public function unhide($id)
{
    $category = Category::find($id);
    $category->is_hidden = false;
    $category->save();

    return redirect()->route('categories.index')->with('success', 'Category unhidden successfully!');
}

public function destroy($id)
{
    $category = Category::find($id);
    $category->delete();

    return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
}


public function moveUp($id)
{
    $category = Category::find($id);

    // Find the category just above the current one (with a smaller position)
    $aboveCategory = Category::where('position', '<', $category->position)
                            ->orderBy('position', 'desc')
                            ->first();

    if ($aboveCategory) {
        DB::transaction(function() use ($category, $aboveCategory) {
            // Swap positions
            $tempPosition = $category->position;
            $category->position = $aboveCategory->position;
            $aboveCategory->position = $tempPosition;

            $category->save();
            $aboveCategory->save();
        });
    }

    return redirect()->back();
}


public function moveDown($id)
{
    $category = Category::find($id);

    // Find the category just below the current one (with a larger position)
    $belowCategory = Category::where('position', '>', $category->position)
                             ->orderBy('position', 'asc')
                             ->first();

    if ($belowCategory) {
        DB::transaction(function() use ($category, $belowCategory) {
            // Swap positions
            $tempPosition = $category->position;
            $category->position = $belowCategory->position;
            $belowCategory->position = $tempPosition;

            $category->save();
            $belowCategory->save();
        });
    }

    return redirect()->back();
}



}
