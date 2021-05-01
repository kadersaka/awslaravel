<?php

namespace App\Http\Controllers;

use App\Models\TrustedLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrustedLogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
               //
        $path = $request->file('logo')->store('logos', 's3');
        //  $path = $request->file('logo')->store('logos');
        $logo = new TrustedLogo();
        $logo->name = basename($path);
        $logo->url = Storage::disk('s3')->url($path);
        $logo->save();
        return $logo;
       // dd($request->file('logo'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TrustedLogo  $trustedLogo
     * @return \Illuminate\Http\Response
     */
    public function show(TrustedLogo $trustedLogo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TrustedLogo  $trustedLogo
     * @return \Illuminate\Http\Response
     */
    public function edit(TrustedLogo $trustedLogo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TrustedLogo  $trustedLogo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TrustedLogo $trustedLogo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TrustedLogo  $trustedLogo
     * @return \Illuminate\Http\Response
     */
    public function destroy(TrustedLogo $trustedLogo)
    {
        //
    }
}
