<?php

namespace App\Http\Controllers;

use App\Models\Cmp;
use Illuminate\Http\Request;

class CmpController extends Controller
{
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
