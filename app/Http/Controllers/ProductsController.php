<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pagination = $request->query('page') ?? 10;
        $category = $request->query('category') ?? null;
        $brands = $request->query('brands') ?? null;
        $product = $request->query('product') ?? null;
        $query = Products::query();

        if ($product) {
            $query->where('name', 'like', "%$product%");
        }
        if ($category) {
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('category_name', 'like', "%$category%");
            });
        }
        if ($brands) {
            $query->whereHas('brands', function ($q) use ($brands) {
                $q->where('brands_name', 'like', "%$brands%");
            });
        }
        $query->with(['category', 'brands']);
        $products = $query->paginate($pagination);
        if ($products->isEmpty() && $products->currentPage() > $products->lastPage()) {
            $products = $query->paginate($pagination, ['*'], 'page', $products->lastPage());
        }

        return response()->json(['message' => 'Successfully Display Data', 'status' => true, 'data' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // $validateData = $request->validate([
        //     'name' => 'required',
        //     'price' => 'required|numeric',
        //     'quantity' => 'required|integer',
        //     'category_id' => 'required|integer',

        // ]);
        // $product = Products::where('name', $validateData['name'])->first();
        // if ($product) {
        //     return response()->json(['message' => 'Product Sudah Ada'], 400);
        // }
        // $newData = Products::create([
        //     'name' => $validateData['name'],
        //     'price' => $validateData['price'],
        //     'quantity' => $validateData['quantity'],
        //     'category_id' => $validateData['category_id'],
        // ]);
        // return response()->json(['message' => 'Produk Berhasil dibuat', 'product' => $newData], 201);
        // //
        // //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateData = $request->validate([
                'name' => 'required|unique:products,name',
                'price' => 'required|numeric',
                'quantity' => 'required|integer',
                'category_id' => 'required|exists:categories,id',
                'brands_id' => 'required|exists:brands,id'
            ], [
                'name.required' => 'Product Name is Empty',
                'price.required' => 'Product Price is Empty',
                'price.numeric' => 'Price is Numeric!!!',
                'quantity.required' => 'Quantity is Invalid',
                'quantity.integer' => 'Quantity must be integer'
            ]);

            $newProduct = Products::create($validateData);

            return response()->json([
                'message' => 'Added Successfully',
                'status' => true,
                'data' => $newProduct,
            ], 201);

            //code...
        } catch (ValidationException $e) {
            return response()->json(
                ['message' => $e->errors(), 'status' => false],
                422
            );
            //throw $th;
        } catch (\Exception $e) {
            return response()->json(
                ['message' => 'Error Create Data', 'status' => false, 'errors' => $e->getMessage()],
                500
            );
            //throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Products::find($id);
        if ($product) {
            return response()->json(['message' => 'Successfully ', 'status' => true, 'data' => $product,]);
        } else {
            return response()->json(['Message' => 'Product Tidak ditemukan', 'status' => false], 404);
        }
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products)
    {

        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Products::find($id);
        if (!$product) {
            return response()->json(['message' => 'Produk Not Found', 'status' => false], 404);
        }
        try {
            $validateData = $request->validate([
                'name' => 'required|unique:products,name',
                'price' => 'required|numeric|min:1',
                'quantity' => 'required|integer|min:1',
                'category_id' => 'required|exists:categories,id',
                'brands_id' => 'required|exists:brands,id'
            ]);
            $product->update($validateData);
            return response()->json(['message' => 'Product Updated Successfully', 'status' => true, 'product' => $product], 200);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->errors(), 'status' => false], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error Update Data', 'status' => false], 500);
            //throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Products::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product Not Found'], 404);
        }
        $product->delete();
        return response()->json(['message' => 'Produk Deleted']);

        //
    }
}
