<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class ProductController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->crudResponses('product');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('products',compact('products'));
    }

   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            Product::create($request->all());
            $message = $this->responses['store'];
            return to_route('products.index')->with('message',$message);
        }catch(Throwable $e){
            return to_route('products')->with('message',$e->getMessage());
            // return response()->json($e->getMessage(),500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id):JsonResponse
    {
        try{
            $product = Product::findOrFail($id);
            return response()->json($product,200);
        }catch(ModelNotFoundException $e){
            return response()->json($e->getMessage(),404);
        }
    }

   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id):JsonResponse
    {
        try{
            $product = Product::findOrFail($id);
            $product->update($request->all());
            $message = $this->responses['updated'];
            return response()->json($message,200);
        }
        catch(ModelNotFoundException $e){
            return response()->json($e->getMessage(),404);
        }
        
        catch(Throwable $e){
            return response()->json($e->getMessage(),500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id):JsonResponse
    {
        try{
            $products = Product::findOrFail($id);
            $products->delete();
            $message = $this->responses['destroy'];
            return response()->json($message,200);
        }
        catch(ModelNotFoundException $e){
         return response()->json($e->getMessage(),404);
        }
        
        catch(Throwable $e){
            return response()->json($e->getMessage(),500);
        }
    }

}
