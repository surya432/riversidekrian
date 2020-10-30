<?php

namespace App\Http\Controllers;

use App\Models\Billed;
use App\Models\MPackages;
use App\Models\MUserPackages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{

    public function json(Request $request)
    {
        $usersPayments = \App\Models\MUserPackages::join('users', 'm_user_packages.user_id', 'users.id')->where("m_user_packages.cmp_id", Auth::user()->cmp_id)->whereIn("m_user_packages.status", ['in-proses', 'paid'])->orderBy('m_user_packages.status', 'asc')->orderBy('m_user_packages.id', 'desc')->select('m_user_packages.*', 'users.name')->get();
        return \Yajra\Datatables\Datatables::of($usersPayments)
            //$query di masukkan kedalam Datatables
            ->addColumn('totalTagihanRp', function ($q) {
                return
                    "Rp " . number_format((int)trim($q->totalTagihan), 2, ',', '.');
            })
            ->addColumn('status-tagihan', function ($q) {
                if ($q->status == 'in-proses') {
                    return "Belum Dibayar";
                } else {
                    return "Sudah Dibayar";
                }
            })
            ->addColumn('action', function ($q) {
                //Kemudian kita menambahkan kolom baru , yaitu "action"
                if ($q->status == 'in-proses') {
                    return view('links', [
                        //Kemudian dioper ke file links.blade.php
                        'model' => $q,
                        // 'link_edit' => route('tagihan.edit', $q->id),
                        // 'link_hapus' => route('tagihan.destroy', $q->id),
                        // 'link_show' => route('tagihan.show', $q->id),
                        // 'url_detail' => route('permission.show', $q->id),
                        'link_payment' => route('payment.update', $q->id),
                    ]);
                } else {
                    return view('links', [
                        //Kemudian dioper ke file links.blade.php
                        'model' => $q,
                        // 'link_edit' => route('tagihan.edit', $q->id),
                        // 'link_hapus' => route('tagihan.destroy', $q->id),
                        // 'link_show' => route('tagihan.show', $q->id),
                        'link_show' => route('payment.show', $q->id),
                        // 'link_payment' => route('payment.update', $q->id),
                    ]);
                }
            })
            ->addIndexColumn()
            // ->rawColumns(['other-columns'])
            ->make(true);
    }
    public function paymentset()
    {

        try {

            DB::beginTransaction();
            $data = \App\Models\Billed::join('m_packages', 'm_packages.id', 'billeds.m_packages_id')->select('m_packages.tipe', 'm_packages.date', 'billeds.*')->where('billeds.status', 'Aktif')->whereMonth('m_packages.date', '=', \Carbon\Carbon::now()->format('m'))->whereDay('m_packages.date', '=', \Carbon\Carbon::now()->format('d'))->get();
            $datas = [];
            foreach ($data as $a => $b) {
                foreach (json_decode($b->user_id, true) as  $bc) {
                    $noInvoice = MUserPackages::where('cmp_id', Auth::user()->cmp_id)->whereMonth('created_at', '=', \Carbon\Carbon::now()->format('m'))->get();
                    $no = \Carbon\Carbon::now()->format('Ym') . str_pad($noInvoice->count() + 1, 4, "0", STR_PAD_LEFT);
                    $b["no"] = $no;
                    $dataInsert = ['no' => $no, 'm_packages_id' => $b->m_packages_id, 'status' => "in-proses", "date" => \Carbon\Carbon::now()->format('Y-m-d'), "totalTagihan" => $b->totalTagihan, "user_id" => $bc, "cmp_id" => $b->cmp_id];
                    $datacheck = ['m_packages_id' => $b->m_packages_id, 'status' => "in-proses", "date" => \Carbon\Carbon::now()->format('Y-m-d'), "totalTagihan" => $b->totalTagihan, "user_id" => $bc, "cmp_id" => $b->cmp_id];
                    $insert = MUserPackages::firstOrCreate($datacheck, $dataInsert);
                    array_push($datas, $insert);
                }
                if ($b->tipe == "Sekali") {
                    Billed::find($b->id)->update(['status' => "Tidak Aktif", 'last_run' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')]);
                } else {
                    Billed::find($b->id)->update(['last_run' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')]);
                }
            }
            DB::commit();
            return response()->json(array('status' => true, "message" => "Tagihan berhasil Di buat"), 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(array('status' => false, "message" => "Tagihan Gagal Di buat", "error" => $th->getMessage()), 500);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('payment.index');
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
        $data =  MUserPackages::with('Payment', 'userDetail')->find($id);
        return view('payment.show', compact('data'));
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
        MUserPackages::where([
            "cmp_id" => Auth::user()->cmp_id,
            "id" => $id,
        ])->update(['status' => "paid", 'update_by' => Auth::user()->name]);
        return redirect()->route('payment.index')->with('message', 'Status Berhasil Diubah.');;
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
