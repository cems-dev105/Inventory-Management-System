<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplierList = Supplier::all();

        return response()->json([
            'status' => 'success',
            'message' => 'All supplier list..',
            'data' => $supplierList,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'shopname' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $supplier = new Supplier();
            $supplier->name = $validated['name'];
            $supplier->email = $validated['email'];
            $supplier->phone = $validated['phone'];
            $supplier->address = $validated['address'];
            $supplier->shopname = $validated['shopname'];

            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('public/photos');
                $supplier->photo = Storage::url($path);
            }

            $supplier->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Supplier created successfully!',
                'data' => $supplier
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create supplier',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplier = Supplier::find($id);

        if ($supplier)
        {

            return response()->json([
                'status' => 'success',
                'message' => 'Supplier found!',
                'data' => $supplier
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Supplier not found!',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $supplierUpdate = Supplier::find($id);

        if($supplierUpdate)
        {

            $supplierUpdate->update($request->all());

            return response()->json([
                'status' => 'success',
                'message' => 'Supplier Updated!',
                'data' => $supplierUpdate
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Supplier not found!',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplierDelete = Supplier::find($id);

        if ($supplierDelete)
        {

            if($supplierDelete->photo)
            {
                $photoPath = str_replace('/storage', 'public', $supplierDelete->photo);

                if(Storage::exists($photoPath))
                {
                    Storage::delete($photoPath);
                }
            }

            $supplierDelete->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Supplier deleted successfully!',
                'data' => $supplierDelete
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Supplier not found!',
            ], 404);
        }
    }
}
