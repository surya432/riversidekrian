<?php

namespace App\Http\Controllers;

use App\Models\Billed;
use App\Models\MCoa;
use App\Models\MDPackages;
use App\Models\MPackages;
use App\Models\MUserPackages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MPackagesController extends Controller
{
    public function json(Request $request)
    {
        $data = \App\Models\MPackages::join('billeds', 'billeds.m_packages_id', 'm_packages.id')->where("m_packages.cmp_id", Auth::user()->cmp_id)->select('m_packages.*', 'billeds.status')->orderBy('id', 'desc')->get();
        return \Yajra\Datatables\Datatables::of($data)
            //$query di masukkan kedalam Datatables
            ->addColumn('action', function ($q) {
                //Kemudian kita menambahkan kolom baru , yaitu "action"
                return view('links', [
                    //Kemudian dioper ke file links.blade.php
                    'model' => $q,
                    'link_edit' => route('tagihan.edit', $q->id),
                    // 'link_hapus' => route('tagihan.destroy', $q->id),
                    'link_show' => route('tagihan.show', $q->id),
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
        $nom = str_replace(",00", "", $request->totalTagihan);
        $request->merge([
            'cmp_id' => Auth::user()->cmp_id,
            "create_by" => Auth::user()->name,
            "totalTagihan" =>  preg_replace('/\D/', '', $nom),
        ]);

        try {
            DB::beginTransaction();
            $tagihan =  MPackages::create($request->only('name', 'tipe', 'date', 'duedate',  'create_by', 'cmp_id'));
            $dataDetail = $request->only('detail');

            foreach (json_decode($dataDetail['detail'], true) as $a => $b) {
                $b["m_packages_id"] = $tagihan->id;

                MDPackages::create($b);
            }
            $request->merge([
                'cmp_id' => Auth::user()->cmp_id,
                "create_by" => Auth::user()->name,
                "m_packages_id" => $tagihan->id,
                "user_id" => json_encode($request->warga)
            ]);
            // if ($request->tipe == "Sekali") {
            //     $noInvoice = MUserPackages::where('cmp_id', Auth::user()->cmp_id)->whereMonth('created_at', '=', \Carbon\Carbon::now()->format('m'))->get();
            //     $no = \Carbon\Carbon::now()->format('Ymd') . str_pad($noInvoice->count(), 3, "0", STR_PAD_LEFT);
            //     foreach ($request->warga as $a => $b) {
            //         $request->merge([
            //             "no" => $no,
            //             "user_id" => $b
            //         ]);
            //         MUserPackages::create($request->only('user_id', 'totalTagihan', 'no', 'm_packages_id', 'cmp_id'));
            //     }
            // } else {
            Billed::create($request->only('status', 'm_packages_id', 'cmp_id', 'user_id', 'totalTagihan'));
            // }
            DB::commit();
            return response()->json(array('status' => true, "message" => "Tagihan berhasil Di buat"), 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(array('status' => false, "message" => "Tagihan Gagal Di buat", "error" => $th->getMessage()), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MPackages  $mPackages
     * @return \Illuminate\Http\Response
     */
    public function show(MPackages $mPackages, $id)
    {
        $dataAccount = MCoa::where('grup', 'REVENUE')->get();
        $dataWarga = User::where('cmp_id', Auth::user()->cmp_id)->pluck('name', 'id');
        $dataDetail = MDPackages::where('cmp_id', Auth::user()->cmp_id)->where('m_packages_id', $id)->get();
        if (count($dataDetail) < 1) {
            abort(404);
        }
        $mPackages = MPackages::find($id);
        $dataUser = MUserPackages::where('cmp_id', Auth::user()->cmp_id)->where('m_packages_id', $mPackages->id)->pluck('user_id')->toArray();
        $billed = Billed::where('cmp_id', Auth::user()->cmp_id)->where('m_packages_id', $mPackages->id)->first();
        return view('tagihan.show', compact('dataAccount', 'mPackages', 'dataWarga', 'dataDetail', 'dataUser', 'billed'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MPackages  $mPackages
     * @return \Illuminate\Http\Response
     */
    public function edit(MPackages $mPackages, $id)
    {

        //
        $dataAccount = MCoa::where('grup', 'REVENUE')->get();
        $dataWarga = User::where('cmp_id', Auth::user()->cmp_id)->pluck('name', 'id');
        $dataDetail = MDPackages::where('cmp_id', Auth::user()->cmp_id)->where('m_packages_id', $id)->get();
        if (count($dataDetail) < 1) {
            abort(404);
        }
        $mPackages = MPackages::find($id);
        $dataUser = MUserPackages::where('cmp_id', Auth::user()->cmp_id)->where('m_packages_id', $mPackages->id)->pluck('user_id')->toArray();
        $billed = Billed::where('cmp_id', Auth::user()->cmp_id)->where('m_packages_id', $mPackages->id)->first();

        return view('tagihan.edit', compact('dataAccount', 'mPackages', 'dataWarga', 'dataDetail', 'dataUser', 'billed'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MPackages  $mPackages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MPackages $mPackages, $id)
    {
        // dd($request->all());
        $nom = str_replace(",00", "", $request->totalTagihan);
        $request->merge([
            'cmp_id' => Auth::user()->cmp_id,
            "update_by" => Auth::user()->name,
            "totalTagihan" =>  preg_replace('/\D/', '', $nom),
        ]);

        try {
            DB::beginTransaction();
            $tagihan =  MPackages::where(['id' => $id, 'cmp_id' => Auth::user()->cmp_id])->update($request->only('name', 'tipe', 'date', 'duedate',  'update_by'));
            $dataDetail = $request->only('detail');
            $dataDelete2 =  MDPackages::where('m_packages_id', $id)->where('cmp_id', Auth::user()->cmp_id)->get();
            $dataDelete2->each->delete();
            foreach (json_decode($dataDetail['detail'], true) as $a => $b) {
                $b["m_packages_id"] = $id;
                MDPackages::create($b);
            }

            $request->merge([
                'cmp_id' => Auth::user()->cmp_id,
                "create_by" => Auth::user()->name,
                "m_packages_id" => $id,
            ]);
            // if ($request->tipe == "Sekali") {
            //     $noInvoice = MUserPackages::where('cmp_id', Auth::user()->cmp_id)->whereMonth('created_at', '=', \Carbon\Carbon::now()->format('m'))->get();
            //     $no = \Carbon\Carbon::now()->format('Ymd') . str_pad($noInvoice->count(), 3, "0", STR_PAD_LEFT);
            //     foreach ($request->warga as $a => $b) {
            //         $request->merge([
            //             "no" => $no,
            //             "user_id" => $b
            //         ]);
            //         MUserPackages::where("m_packages_id", $id)->where('cmp_id', $request->cmp_id)->update($request->only('status',  'user_id', 'totalTagihan'));
            //     }
            // } else {
            $request->merge([
                "user_id" => $request->warga
            ]);
            Billed::where('m_packages_id', $request->m_packages_id)->update($request->only('status',  'user_id', 'totalTagihan'));
            // }
            DB::commit();
            return response()->json(array('status' => true, "message" => "Tagihan berhasil Di Ubah"), 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(array('status' => false, "message" => "Tagihan Gagal Di Ubah", "error" => $th->getMessage()), 500);
        }
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
        $mPackages->delete();
    }
}
