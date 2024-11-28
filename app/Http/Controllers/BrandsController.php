<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brands::all();
        return response()->json(['message' => 'Successfully Display Data', 'success' => true, 'brands' => $brands]);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateData = $request->validate(['brands_name' => 'required|unique:brands,brands_name'], ['brands_name.required' => 'Brands Name is Empty']);

            $newData = Brands::create($validateData);

            return response()->json(['message' => 'Successfully Added Brands', 'status' => true, 'data' => $newData], 201);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->errors(), 'status' => false], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error Created Data', 'status' => false, 'errors' => $e->getMessage()], 500);
            //throw $th;
        }
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $brands = Brands::find($id);
        if ($brands) {
            return response()->json(['message' => 'Successfully Display Data', 'status' => true, 'data' => $brands]);
        } else {
            return response()->json(['message' => 'Brands Not Found', 'status' => false], 404);
        }
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $brands = Brands::find($id);
        if (!$brands) {
            return response()->json(['message' => 'Brands Not Founds', 'status' => false], 404);
        }
        try {
            $validateData = $request->validate(['brands_name' => 'required']);
            $brands->update($validateData);
            return response()->json(['message' => 'Successfully Updated', 'status' => true, 'data' => $validateData], 200);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->errors(), 'status' => false], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error Updated Data', 'status' => false], 500);
            //throw $th;
        }
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $brands = Brands::find($id);
        if (!$brands) {
            return response()->json(['message' => 'Brands Not Found', 'status' => false], 404);
        }
        $brands->delete();
        return response()->json(['message' => 'Deleted Successfully', 'status' => true]);
        //
    }
}
