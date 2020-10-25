<?php

namespace App\Http\Controllers;

use App\Models\MCoa;
use App\Models\MPackages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MPackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('tagihan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $dataAccount = MCoa::where('grup', 'REVENUE')->get();
        $dataWarga = User::where('cmp_id', Auth::user()->cmp_id)->pluck('name', 'id');
        return view('tagihan.create', compact('dataAccount', 'dataWarga'));
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
        try {
            DB::beginTransaction();
            DB::table('users')->create($request->except('_token', '_method', 'warga'));

            DB::table('posts')->delete();
            DB::commit();
            return redirect()->route('coa.index')->with('message', 'Berhasil Disimpan');;
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(array('status' => false, "message" => "Tagihan Gagal Di buat"), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MPackages  $mPackages
     * @return \Illuminate\Http\Response
     */
    public function show(MPackages $mPackages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MPackages  $mPackages
     * @return \Illuminate\Http\Response
     */
    public function edit(MPackages $mPackages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MPackages  $mPackages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MPackages $mPackages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MPackages  $mPackages
     * @return \Illuminate\Http\Response
     */
    public function destroy(MPackages $mPackages)
    {
        //
    }
}
