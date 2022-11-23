<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Product;
use App\SubCategory;

class SubCategoryController extends Controller
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
        $subcategory = SubCategory::where('slug', $slug)->first();
        $categories = Category::withCount('subcategories')->get();

        $products = $subcategory->products()->paginate(40);
        $featuredProducts = Product::where('featured', true)->take(4)->get();
        $popularProducts = Product::orderBy('views', 'desc')->take(4)->get();
        
        $sort = NULL;
        $url = route("subcategories.show", $slug);

        if ($request->has('sort')) {
            $sort = $request->input('sort');

            // filter products
            $products = $subcategory->products()->when($sort, function ($query, $sort) {
                if ($sort == 'price-asc') {
                    $query->orderByRaw('CONVERT(original_price, SIGNED) asc');
                } elseif ($sort == 'price-desc') {
                    $query->orderByRaw('CONVERT(original_price, SIGNED) desc');
                } elseif ($sort == 'name-asc') {
                    $query->orderBy('title', 'asc');
                } elseif ($sort == 'name-desc') {
                    $query->orderBy('title', 'desc');
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

        return view('products.index', compact('categories', 'products', 'featuredProducts', 'popularProducts', 'sort', 'url'));
    }
}
