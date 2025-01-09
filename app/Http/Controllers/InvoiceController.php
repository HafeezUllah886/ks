<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Http\Controllers\Controller;
use App\Models\accounts;
use App\Models\InvoiceContainers;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::all();

        return view('exp_inv.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = products::orderby('name', 'asc')->get();
        $customers = accounts::customer()->get();
        $accounts = accounts::business()->get();
        return view('exp_inv.create', compact('products', 'customers', 'accounts',));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try
        {
            DB::beginTransaction();
            $invoice = Invoice::create(
                [
                    'customerID' => $request->customerID,
                    'accountID' => $request->accountID,
                    'productID' => $request->productID,
                    'price' => $request->price,
                    'pi' => $request->pi,
                    'date' => $request->date,
                    'valid' => $request->valid,
                    'fi' => $request->fi,
                    'delivery_term' => $request->delivery_term,
                    'payment_term' => $request->payment_term,
                    'loading_port' => $request->loading_port,
                    'discharge_port' => $request->discharge_port,
                    'pp_gross' => $request->ppgross,
                    'pp_net' => $request->ppnet,
                ]
            );

            $containers = $request->container;

            $totalWeight = 0;

            foreach($containers as $key => $container)
            {
                $totalWeight += $request->net[$key];
                InvoiceContainers::create(
                    [
                        'invoiceID' => $invoice->id,
                        'container' => $container,
                        'size' => $request->size[$key],
                        'packs_pp' => $request->packs[$key],
                        'qty' => $request->qty[$key],
                        'gross' => $request->gross[$key],
                        'net' => $request->net[$key],
                        'totalpp' => $request->pp[$key],
                    ]
                );
            }

            $ton = $totalWeight / 1000;
            $amount = $ton * $request->price;

            $invoice->update(
                [
                    'qty'       => $ton,
                    'amount'    => $amount,
                ]
            );
            DB::commit();
            return to_route('invoice.show', $invoice->id)->with('success', "Invoice Generated");
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return to_route('invoice.create')->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $invoice = Invoice::with('details')->find($id);
        $containers = $invoice->details->groupBy('container');
        return view('exp_inv.view', compact('invoice', 'containers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
