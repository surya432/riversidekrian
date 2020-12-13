<?php

namespace App\Http\Controllers;

use App\Models\MCoa;
use App\Models\MDPackages;
use App\Models\MInterface;
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
        $data = \App\Models\MPackages::where("m_packages.cmp_id", Auth::user()->cmp_id)->orderBy('id', 'desc')->get();
        // $data = \App\Models\Billed::with('packages')->orderBy('id', 'desc')->get();
        return \Yajra\Datatables\Datatables::of($data)
            //$query di masukkan kedalam Datatables
            ->addColumn('action', function ($q) {
                //Kemudian kita menambahkan kolom baru , yaitu "action"

                $button = [
                    //Kemudian dioper ke file links.blade.php
                    'model' => $q,
                    // 'link_hapus' => route('tagihan.destroy', $q->id),
                    'link_show' => route('tagihan.show', $q->id),
                    'link_edit' => route('tagihan.edit', $q->id)
                    // 'url_detail' => route('permission.show', $q->id),
                ];
                return view('links', $button);
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
        $dataMaster = MInterface::where('var', "VAR_RECEIPT")->first();
        $coaLike = explode(',', $dataMaster->code_coa);
        $dataAccount = MCoa::where(function ($query) use ($coaLike) {
            for ($i = 0; $i < count($coaLike); $i++) {
                $query->orwhere('code', 'like',  $coaLike[$i] . '%');
            }
        })->whereNotIn('code', $coaLike)->get();
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
            "next_run" =>  $request->only('tipe') != "Sekali" ? \Carbon\Carbon::now()->addMonth() : null,
        ]);

        try {
            DB::beginTransaction();
            $tagihan =  MPackages::create($request->only('name', 'tipe', 'date', 'duedate', 'status', 'create_by', 'next_run', 'cmp_id'));
            $detail = $request->only('detail');
            $d_Detail = json_decode($detail['detail'], true);
            foreach ($d_Detail as $a => $b) {
                $mPackagesId = array();
                $b["m_packages_id"] = $tagihan->id;
                // MDPackages::create($b);
                DB::table('m_d_packages')->insert($b);
            }
            $request->merge([
                'cmp_id' => Auth::user()->cmp_id,
                "create_by" => Auth::user()->name,
                "m_packages_id" => $tagihan->id,
                "user_id" => json_encode($request->warga)
            ]);
            // if ($request->tipe == "Sekali") {
            foreach ($request->warga as $a => $b) {
                $noInvoice = MUserPackages::where('cmp_id', Auth::user()->cmp_id)->whereMonth('created_at', '=', \Carbon\Carbon::now()->format('m'))->get();
                $no = \Carbon\Carbon::now()->format('Y/m/') . str_pad($noInvoice->count() + 1, 3, "0", STR_PAD_LEFT);
                $request->merge([
                    "no" => $no,
                    "user_id" => $b,
                    "date" => \Carbon\Carbon::now()->format('Y/m/d'),
                    "note" => \Carbon\Carbon::now()->format('M Y')
                ]);
                MUserPackages::create($request->only('user_id', 'totalTagihan', 'no', 'date', 'note', 'm_packages_id', 'cmp_id'));
            }
            // }
            //  else {
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
        $dataDetail = MDPackages::with('d_packages')->where('cmp_id', Auth::user()->cmp_id)->where('m_packages_id', $id)->get();
        if (count($dataDetail) < 1) {
            abort(404);
        }
        $mPackages = MPackages::find($id);
        $dataUser = MUserPackages::where('cmp_id', Auth::user()->cmp_id)->where('m_packages_id', $mPackages->id)->pluck('user_id')->toArray();
        return view('tagihan.show', compact('dataAccount', 'mPackages', 'dataWarga', 'dataDetail', 'dataUser'));
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
        // $billed = Billed::where('cmp_id', Auth::user()->cmp_id)->where('m_packages_id', $mPackages->id)->first();

        return view('tagihan.edit', compact('dataAccount', 'mPackages', 'dataWarga', 'dataDetail', 'dataUser'));
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
            // Billed::where('m_packages_id', $request->m_packages_id)->update($request->only('status',  'user_id', 'totalTagihan'));
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
