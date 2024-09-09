<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Author; // This line is crucial

class ArticleController extends Controller
{


    public function index()
    {
        $articles = Article::where('subcategory', '1')
            ->orderBy('id', 'DESC')
            ->paginate(3);

        $category = Category::all();


        $categories = Category::where('is_hidden', 0)->orderBy('position', 'desc')->get();

        return view('index', compact('articles', 'categories', 'category'));
    }


    public function contact()
    {

        $categories = Category::where('is_hidden', 0)->get();
        $articles = Article::where('category', '')
            ->paginate(3);

        return view('/contact', compact('categories', 'articles'));
    }




    public function category($id)
    {
        // Fetch articles with category 'Biography' along with their authors
        $category = Category::where('is_hidden', 0)->findOrFail($id);

        // Get all articles that belong to this category
        $articles = Article::where('category_id', $id)
            ->where('subcategory', '0')
            ->orderBy('id', 'DESC')
            ->paginate(10); // Use pagination (adjust the number as needed)

        $categories = Category::orderBy('position', 'desc')->where('is_hidden', 0)->get();

        return view('category', compact('articles', 'categories', 'category'));
    }

    
    
    public function search(Request $request)
{
    $searchTerm = $request->get('title', '');

    $articles = Article::where(function ($query) use ($searchTerm) {
            $query->where('title', 'like', '%' . $searchTerm . '%')
                  ->orWhere('full_text', 'like', '%' . $searchTerm . '%');
        })
        ->whereHas('category', function ($query) {
            $query->where('is_hidden', 0); // Ensure category is not hidden
        })
        ->orderBy('id', 'DESC')
        ->paginate(10)
        ->appends(['title' => $searchTerm]);

    $search_count = $articles->total();

    $categories = Category::where('is_hidden', 0)->orderBy('position', 'desc')->get();

    return view('search', compact('articles', 'categories', 'searchTerm', 'search_count'));
}

    
    

    public function full($title, $id)
    {
        // Retrieve the article by ID and eager load the category relationship
        $article = Article::with('category')->findOrFail($id);
        $categories = Category::all();



        // Pass the article and its category to the view
        return view('full', [
            'article' => $article,
            'category' => $article->category,
            'categories' => $categories,
            'title' => $title
        ]);
    }


    public function admin_index()
    {
        $articles = Article::join('categories', 'articles.category_id', '=', 'categories.id')
        ->where('categories.is_hidden', '=', 0) // Ensure the category is not hidden
        ->orderBy('articles.id', 'DESC')
        ->select('articles.*', 'categories.name as category_name')
        ->paginate(10); // Pagination with 10 articles per page

            $categories= Category::all();
     

        return view('admin.index', compact('articles', 'categories'));
    }

    public function create()
    {
        $authors = Author::all();
        $categories = Category::all();
        return view('admin.create', compact('authors', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'full_text' => 'required',
            'description' => 'nullable',
            'author_id' => 'nullable|exists:authors,id',
            'category_id' => 'nullable|exists:categories,id', // Ensure validation for category_id
            'subcategory' => 'nullable|in:0,1', // Validate subcategory if provided
        ]);

        $filePath = null; // Default to null if no file is uploaded

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('img', $filename, 'public');
        }

        // Create the article regardless of whether a photo is uploaded
        Article::create([
            'title' => $request->input('title'),
            'photo' => $filePath, // This will be null if no file was uploaded
            'full_text' => $request->input('full_text'),
            'description' => $request->input('description'),
            'author_id' => $request->input('author_id'),
            'category_id' => $request->input('category_id'), // Save category_id
            'subcategory' => $request->input('subcategory', '0'), // Default to '0' if not provided
        ]);



        return redirect()->route('admin.index')->with('success', 'Article created successfully!');
    }


    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $authors = Author::all();
        $categories = Category::all();
        return view('admin.edit', compact('article', 'authors', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'photo' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Photo is optional during update
            'full_text' => 'required',
            'description' => 'nullable',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'subcategory' => 'required|string|max:255',
        ]);

        $article = Article::findOrFail($id);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('img', $filename, 'public');
            $article->photo = $filePath;
        }

        $article->title = $request->input('title');
        $article->full_text = $request->input('full_text');
        $article->description = $request->input('description');
        $article->author_id = $request->input('author_id');
        $article->category_id = $request->input('category_id');
        $article->subcategory = $request->input('subcategory');
        $article->save();

        return redirect()->route('admin.index')->with('success', 'Article updated successfully!');
    }


    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        // Redirect back to the articles index with a success message
        return redirect()->route('admin.index')->with('success', 'Article deleted successfully!');
    }



    public function create_video()
    {
        $authors = Author::all();
        $categories = Category::all();

        return view('admin.create_video', compact('authors', 'categories'));
    }


    public function video_store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
            'subcategory' => 'required|string|max:255',
            'author_id' => 'nullable|string',
        ]);

        $articleData = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id', 0), // Default category_id
            'subcategory' => $request->input('subcategory'),
            'author_id' => $request->input('author_id'),
        ];

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('img', $filename, 'public');
            $articleData['photo'] = $filePath;
        }

        if ($request->input('full_text')) {
            $articleData['full_text'] = $request->input('full_text');
        }

        Article::create($articleData);

        return redirect()->route('admin.index_video')->with('success', 'Video successfully uploaded');
    }

    public function index_video()
    {
        $articles = Article::with('author')
            ->orderBy('id', 'DESC')
            ->where('category_id', '10')
            ->paginate(10); // Example: Pagination with 10 articles per page
        return view('admin.index_video', compact('articles'));
    }
}
