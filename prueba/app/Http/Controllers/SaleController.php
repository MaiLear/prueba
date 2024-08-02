<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class SaleController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->crudResponses('sale');
    }
    /**
     * Display a listing of the resource.
     */
    public function index():JsonResponse
    {
        $sales = Sale::all();
        return response()->json($sales);
    }

   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):JsonResponse
    {
        try{
            Sale::create($request->all());
            $message = $this->responses['store'];
            return response()->json($message,200);
        }catch(Throwable $e){
            return response()->json($e->getMessage(),500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id):JsonResponse
    {
        try{
            $sale = Sale::findOrFail($id);
            return response()->json($sale,200);
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
            $sale = Sale::findOrFail($id);
            $sale->update($request->all());
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
            $sales = Sale::findOrFail($id);
            $sales->delete();
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
