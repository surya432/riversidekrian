<?php

namespace App\Http\Controllers;

use App\Models\DPengeluaran;
use App\Models\MCoa;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function json(Request $request)
    {
        $dataWarga = Pengeluaran::with(['detail'])->where('cmp_id', Auth::user()->cmp_id)->get();

        return \Yajra\Datatables\Datatables::of($dataWarga)
            ->addColumn('biaya', function ($q) {
                return "Rp " . number_format($q->total, 0);
            })
            ->addColumn('action', function ($q) {
                //Kemudian kita menambahkan kolom baru , yaitu "action"
                $button = [
                    //Kemudian dioper ke file links.blade.php
                    'model' => $q,
                    // 'link_hapus' => route('tagihan.destroy', $q->id),
                    'link_show' => route('pengeluaran.show', $q->id),
                    'link_edit' => route('pengeluaran.edit', $q->id)
                    // 'url_detail' => route('permission.show', $q->id),
                ];
                return view('links', $button);
            })
            ->addIndexColumn()
            ->make(true);
    }
    public function index()
    {
        //

        return view('pengeluaran.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $akun = MCoa::where('grup', 'EXPENSE')->get();
        return view('pengeluaran.create', compact('akun'));
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
        \DB::beginTransaction();

        try {
            //code...
            $noInvoice = Pengeluaran::where('cmp_id', Auth::user()->cmp_id)->whereMonth('created_at', '=', \Carbon\Carbon::now()->format('m'))->get();
            $noTransaction = "PAY/" . Auth::user()->cmp_id . "/" . \Carbon\Carbon::now()->format('Y/m/') . str_pad($noInvoice->count() + 1, 3, "0", STR_PAD_LEFT);
            $nom = str_replace(array(".", ",00"), "", $request->total);
            $nom = str_replace("Rp", "", $nom);
            $request->merge([
                'no' => $noTransaction,
                'status' => "in-approval",
                'cmp_id' => Auth::user()->cmp_id,
                "create_by" => Auth::user()->name,
                'total' => trim($nom),
            ]);
            $pengeluaran =  Pengeluaran::create($request->only('name',  'date', 'total', 'status', "keterangan", 'create_by', 'no', 'cmp_id'));
            foreach (json_decode($request->detail, true) as $a => $b) {
                $b["pengeluaran_id"] = $pengeluaran->id;
                DPengeluaran::create($b);
            }
            \DB::commit();
            return response()->json(array('status' => true, "message" => "Berhasil Di Simpan",), 200);
        } catch (\Throwable $e) {
            \DB::rollback();
            return response()->json(array('status' => false, "message" => "Tagihan Gagal Di buat", "error" => $e->getMessage()), 500);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(array('status' => false, "message" => "Tagihan Gagal Di buat", "error" => $e->getMessage()), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function show(Pengeluaran $pengeluaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengeluaran $pengeluaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengeluaran $pengeluaran)
    {
        //
    }
}
