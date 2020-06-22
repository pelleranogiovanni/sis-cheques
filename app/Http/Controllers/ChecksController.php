<?php

namespace App\Http\Controllers;

use App\Check;
use App\Invoice;
use App\Provider;
use Illuminate\Http\Request;

class ChecksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $checks = Check::all();

        return view('checks.index', compact('checks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $provider = Provider::find($id);

        return view('checks.create', compact('provider'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request;
        $check = new Check;

        $check->numeroCheque = $request->numeroCheque;
        $check->monto = $request->monto;
        $check->destinatario = $request->destinatario;
        $check->fecha = $request->fecha;
        $check->provider_id = $request->provider_id;

        $check->save();


        $cantFacturas = $request->numeroFactura;
        $longitud = count($cantFacturas);
        $j = 0;


        for ($i = 0; $i < $longitud; $i++) {
            $invoice = new Invoice;
            $invoice->numeroFactura =  $cantFacturas[$j];
            $invoice->check_id = $check->id;

            $invoice->save();

            $j++;
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
