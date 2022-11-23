<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

use App\Product;
use App\SubCategory;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withCount('subcategories')->get();
        
        // fetch products
        $products = Product::paginate(40);
        return response()->json($products);
        $featuredProducts = Product::where('featured', true)->take(4)->get();
        $popularProducts = Product::orderBy('views', 'desc')->take(4)->get();
        
        $sort = NULL;
        $url = route("products.index");

        if ($request->has('sort')) {
            $sort = $request->input('sort');

            // filter products
            if($sort == 'rating') {
                $products = Product::sortBy('total_ratings')->paginate(40);
            } else {
                $products = Product::when($sort, function ($query, $sort) {
                    if ($sort == 'price-asc') {
                        $query->orderBy('original_price', 'asc');
                    } elseif ($sort == 'price-desc') {
                        $query->orderBy('original_price', 'desc');
                    } elseif ($sort == 'name-asc') {
                        $query->orderBy('title', 'asc');
                    } elseif ($sort == 'name-desc') {
                        $query->orderBy('title', 'desc');
                    } elseif ($sort == 'featured') {
                        $query->where('featured', true);
                    } elseif ($sort == 'popularity') {
                        $query->orderBy('views', 'desc');
                    } elseif ($sort == 'date') {
                        $query->orderBy('created_at', 'desc');
                    } else {
                        $query->orderBy('created_at', 'desc');
                    }
                })->paginate(40);
            }

        }
        
        if (request()->ajax()) {
            return view('products.load-more', compact('categories', 'products', 'featuredProducts', 'popularProducts', 'sort', 'url'));
        }

        return view('products.index', compact('categories', 'products', 'featuredProducts', 'popularProducts', 'sort', 'url'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $products = Product::search($search)->paginate(10);
        $sort = NULL;

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
            })->search($search)->paginate(10);
        }

        if (request()->ajax()) {
            return view('products.load-more', compact('products', 'sort'));
        }

        return view('products.index', compact('products', 'sort'));
    }

    public function show(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        // return response()->json($product);
        $product->increment('views');

        $featuredProducts = Product::where('featured', true)->take(4)->get();
        $relatedProducts = Product::where('subcategory_id', $product->subcategory_id)->take(5)->get();

        return view('products.single', compact('product', 'featuredProducts', 'relatedProducts'));
    }

    public function quickview(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('products.quick-view', compact('product'));
    }

    public function addToCart(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $quantity = $request->input('quantity');

        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if (!$cart) {
            $cart = [
                $slug => [
                    "id" => $product->id,
                    "name" => $product->title,
                    "slug" => $product->slug,
                    "quantity" => $quantity ?? 1,
                    "price" => $product->sale_price,
                    "featured_image" => $product->featured_image
                ]
            ];

            session()->put('cart', $cart);

            if ($request->ajax()) {
                return response()->json(['success' => 'Product added to cart successfully.']);
            }

            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        // if cart not empty then check if this product exist then increment quantity
        if (isset($cart[$slug])) {
            $cart[$slug]['quantity'] = $quantity ? $quantity : $cart[$slug]['quantity'] + 1;
            session()->put('cart', $cart);

            if ($request->ajax()) {
                return response()->json(['success' => 'Product added to cart successfully.']);
            }

            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$slug] = [
            "id" => $product->id,
            "name" => $product->title,
            "slug" => $product->slug,
            "quantity" => $quantity ?? 1,
            "price" => $product->sale_price,
            "featured_image" => $product->featured_image
        ];
        session()->put('cart', $cart);

        if ($request->ajax()) {
            return response()->json(['success' => 'Product added to cart successfully.']);
        }
        
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function removeFromCart(Request $request, $slug)
    {
        $cart = session()->get('cart');

        if (isset($cart[$slug])) {
            unset($cart[$slug]);
            session()->put('cart', $cart);
        }

        if ($request->ajax()) {
            return response()->json(['success' => 'Product removed from cart successfully.']);
        }

        return redirect()->back()->with('success', 'Product removed from cart successfully!');
    }
}
