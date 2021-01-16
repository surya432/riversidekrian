<?php

namespace App\Http\Controllers;

use App\Models\Cmp;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CmpController extends Controller
{
    public function redirectShow()
    {
        if (User::find(Auth::user()->id)->first()->hasRole('super-admin')) {
            return view('home');
        }
        $data = Cmp::with(['provinsi', 'kabupaten', 'kecamatan', 'kelurahan', 'warga', 'rumah' => function ($q) {
            $q
                ->join('rumahs', 'rumahs.id', '=', 'homeusers.rumah_id')
                ->select('rumahs.*');
        }])->where('id', Auth::user()->id)->first();
        return view('cmp.show', compact('data'));
    }
    public function json(Request $request)
    {

        return \Yajra\Datatables\Datatables::of(\App\Models\Cmp::all())
            //$query di masukkan kedalam Datatables
            ->addColumn('action', function ($q) {
                //Kemudian kita menambahkan kolom baru , yaitu "action"
                return view('links', [
                    //Kemudian dioper ke file links.blade.php
                    'model' => $q,
                    'link_edit' => route('cmp.edit', $q->id),
                    'url_hapus' => route('cmp.destroy', $q->id),
                    'link_show' => route('cmp.show', $q->id),
                    // 'url_detail' => route('permission.show', $q->id),
                ]);
            })
            ->addIndexColumn()
            // ->rawColumns(['other-columns'])
            ->make(true);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('cmp.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $provinsi = \App\Models\Provinsi::pluck('name', 'id');
        return view('cmp.create', compact('provinsi'));
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
        // dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cmp  $cmp
     * @return \Illuminate\Http\Response
     */

    public function show(Cmp $cmp)
    {
        $data = $cmp::with(['provinsi', 'kabupaten', 'kecamatan', 'kelurahan', 'warga', 'rumah' => function ($q) {
            $q
                ->join('rumahs', 'rumahs.id', '=', 'homeusers.rumah_id')
                ->select('rumahs.*');
        }])->first();
        // dd($data);  
        return view('cmp.show', compact('data'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cmp  $cmp
     * @return \Illuminate\Http\Response
     */
    public function edit(Cmp $cmp)
    {
        //
        $provinsi = \App\Models\Provinsi::pluck('name', 'id');
        $kabupaten = Kabupaten::where('provinsi_id', $cmp->provinsi_id)->pluck('name', 'id');
        $kecamatan = Kecamatan::where('kabupaten_id', $cmp->kabupaten_id)->pluck('name', 'id');
        $kelurahan = Kelurahan::where('kecamatan_id', $cmp->kecamatan_id)->pluck('name', 'id');

        return view('cmp.edit', compact('cmp', 'kecamatan', 'kabupaten', 'kelurahan', 'provinsi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cmp  $cmp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cmp $cmp)
    {
        //

        Cmp::find($cmp->id)->update($request->except('_method', '_token'));
        return
            redirect()->route('cmp.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cmp  $cmp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cmp $cmp)
    {
        //
    }
}
