<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Category;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withCount('subcategories')->get();
        
        // fetch products
        $products = Product::paginate(40);
        $featuredProducts = Product::where('featured', true)->take(4)->get();
        $popularProducts = Product::orderBy('views', 'desc')->take(4)->get();
        
        $sort = NULL;
        $subcat = NULL;

        if ($request->has('sort')) {
            $sort = $request->input('sort');

            // filter products
            $products = Product::when($sort, function ($query, $sort) {
                if ($sort == 'price-asc') {
                    $query->orderBy('price', 'asc');
                } elseif ($sort == 'price-desc') {
                    $query->orderBy('price', 'desc');
                } elseif ($sort == 'name-asc') {
                    $query->orderBy('name', 'asc');
                } elseif ($sort == 'name-desc') {
                    $query->orderBy('name', 'desc');
                } elseif ($sort == 'featured') {
                    $query->where('featured', true);
                } elseif ($sort == 'popularity') {
                    $query->orderBy('views', 'desc');
                } elseif ($sort == 'rating') {
                    $query->withCount('ratings')->orderBy('ratings_count', 'desc');
                } elseif ($sort == 'date') {
                    $query->orderBy('created_at', 'desc');
                } else {
                    $query->orderBy('created_at', 'desc');
                }
            })->paginate(40);
        }
        
        if (request()->ajax()) {
            return view('products.load-more', compact('categories', 'products', 'featuredProducts', 'popularProducts', 'sort', 'subcat'));
        }
    }

    public function show(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->first();

        if (!$category) {
            return redirect()->route('products.index');
        }

        $categories = Category::withCount('subcategories')->get();

        $products = [];

        foreach ($category->subcategories as $subcategory) {
            $products[] = $subcategory->products;
        }

        $products = collect($products)->flatten()->paginate(40);
        
        $featuredProducts = Product::where('featured', true)->take(4)->get();
        $popularProducts = Product::orderBy('views', 'desc')->take(4)->get();
        
        $sort = NULL;
        $url = route("categories.show", $slug);

        // return response()->json([
        //     'products' => $products,
        //     'featuredProducts' => $featuredProducts,
        //     'popularProducts' => $popularProducts,
        //     'sort' => $sort,
        //     'url' => $url,
        // ]);

        return view('products.index', compact('categories', 'products', 'featuredProducts', 'popularProducts', 'sort', 'url'));
    }
}
