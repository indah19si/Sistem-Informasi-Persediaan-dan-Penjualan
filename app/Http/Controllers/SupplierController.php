<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;

class SupplierController extends Controller
{
    /**
     * Create the controller instance.
     */
    public function __construct() {
        $this->authorizeResource(Supplier::class, 'supplier');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Supplier::all();

        return view('content.pages.data-supplier')
            ->with(compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content.pages.data-supplier-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupplierRequest $request)
    {
        $supplier = Supplier::create([
            'nama' => $request->post('nama'),
            'alamat' => $request->post('alamat'),
            'no_hp' => $request->post('no_hp'),
            'lead_time' => $request->post('lead_time'),
        ]);

        if ($supplier instanceof Supplier) {
            //
        } else {
            //
        }

        return redirect()->route('data-supplier.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('content.pages.data-supplier-edit')
            ->with(compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $updatedRow = $supplier->update([
            'nama' => $request->post('nama'),
            'alamat' => $request->post('alamat'),
            'no_hp' => $request->post('no_hp'),
            'lead_time' => $request->post('lead_time'),
        ]);

        if ($updatedRow > 0) {
            //
        } else {
            //
        }

        return redirect()->route('data-supplier.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $isDeleted = $supplier->delete();

        if ($isDeleted) {
            //
        } else {
            //
        }

        return redirect()->route('data-supplier.index');
    }
}
