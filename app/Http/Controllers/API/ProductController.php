<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = DB::table('products')
                        ->join('categories','products.category_id','categories.id')
                        ->join('suppliers','products.supplier_id','suppliers.id')
                        ->select('products.*','categories.category_name','suppliers.name')
                        ->orderBy('products.id','DESC')
                        ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'All product list..',
            'data' => $products,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_code' => 'required|string|unique:products|max:255',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'buying_date' => 'required',
            'product_quantity' => 'required',
        ]);

        try {
            $productStore = new Product();
            $productStore->product_name = $validated['product_name'];
            $productStore->product_code = $validated['product_code'];
            $productStore->category_id = $validated['category_id'];
            $productStore->supplier_id = $validated['supplier_id'];
            $productStore->buying_price = $validated['buying_price'];
            $productStore->selling_price = $validated['selling_price'];
            $productStore->buying_date = $validated['buying_date'];
            $productStore->product_quantity = $validated['product_quantity'];
            $productStore->root = $request->root;

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('public/photos/products');
                $productStore->image = Storage::url($path);
            }

            $productStore->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Product created successfully!',
                'data' => $productStore
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create Product',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);

        if ($product)
        {

            return response()->json([
                'status' => 'success',
                'message' => 'Product found!',
                'data' => $product
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found!',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $productUpdate = Product::find($id);

        if($productUpdate)
        {

            $productUpdate->update($request->all());

            return response()->json([
                'status' => 'success',
                'message' => 'Product Updated!',
                'data' => $productUpdate
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found!',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $productDelete = Product::find($id);

        if ($productDelete)
        {

            if($productDelete->image)
            {
                $photoPath = str_replace('/storage', 'public', $productDelete->image);

                if(Storage::exists($photoPath))
                {
                    Storage::delete($photoPath);
                }
            }

            $productDelete->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Product deleted successfully!',
                'data' => $productDelete
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found!',
            ], 404);
        }
    }
}
