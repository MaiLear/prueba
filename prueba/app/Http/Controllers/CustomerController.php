<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class CustomerController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->crudResponses('customer');
    }
    /**
     * Display a listing of the resource.
     */
    public function index():JsonResponse
    {
        $customers = Customer::all();
        return response()->json($customers);
    }

   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):JsonResponse
    {
        try{
            Customer::create($request->all());
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
            $customer = Customer::findOrFail($id);
            return response()->json($customer,200);
        }catch(ModelNotFoundException $e){
            return response()->json($e->getMessage(),404);
        }
        return response()->json($customer);
    }

   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id):JsonResponse
    {
        try{
            $customer = Customer::findOrFail($id);
            $customer->update($request->all());
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
            $customer = Customer::findOrFail($id);
            $customer->delete();
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
