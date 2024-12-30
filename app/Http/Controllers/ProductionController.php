<?php

namespace App\Http\Controllers;

use App\Models\production;
use App\Http\Controllers\Controller;
use App\Models\accounts;
use App\Models\products;
use App\Models\warehouses;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productions = production::all();
        return view('production.index', compact('productions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = products::all();
        $accounts = accounts::Business()->get();
        $warehouses = warehouses::all();
        return view('production.create', compact('products', 'accounts', 'warehouses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       try{
        if($request->isNotFilled('ids'))
        {
            throw new Exception('Please Select Atleast One Product');
        }
        $ref = getRef();
        DB::beginTransaction();
        $production = production::create([
            'accountID' => $request->accountID,
            'productID' => $request->productID,
            'warehouseID' => $request->warehouseID,
            'qty' => $request->qty,
            'cost' => $request->cost,
            'date' => $request->date,
            'note' => $request->note,
            'refID' => $ref,
        ]);

        createStock($request->productID,0, $request->qty, $request->date, "Used in Production # $production->id", $ref, $request->warehouseID);

        foreach($request->ids as $key => $id)
        {
            $production->details()->attach($id, [
                'qty' => $request->quantity[$key],
                'date' => $request->date,
                'refID' => $ref,
            ]);

            createStock($id ,$request->quantity[$key], 0, $request->date, "Produced in Production # $production->id", $ref, $request->warehouseID);
        }

        createTransaction($request->accountID, $request->date, 0, $request->cost, "Production Cost - Production ID: $production->id", $ref);
        DB::commit();

        return redirect()->route('productions.index')->with('success', 'Production Created Successfully');
       }
         catch(\Exception $e){
                DB::rollBack();
              return redirect()->back()->with('error', $e->getMessage());
         }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $production = production::find($id);

        return view('production.view', compact('production'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(production $production)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, production $production)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(production $production)
    {
        //
    }
}
