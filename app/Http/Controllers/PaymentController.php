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
        $usersPayments = \App\Models\MUserPackages::join('users', 'm_user_packages.user_id', 'users.id')->where("m_user_packages.cmp_id", Auth::user()->cmp_id)->orderBy('m_user_packages.status', 'asc')->orderBy('m_user_packages.id', 'desc')->select('m_user_packages.*', 'users.name')->get();
        return \Yajra\Datatables\Datatables::of($usersPayments)
            //$query di masukkan kedalam Datatables
            ->addColumn('totalTagihanRp', function ($q) {
                return
                    "Rp " . number_format((int)trim($q->totalTagihan), 2, ',', '.');
            })
            ->addColumn('status-tagihan', function ($q) {
                if (\Carbon\Carbon::createFromFormat('Y-m-d', $q->date)->lte(\Carbon\Carbon::now()->format('Y-m-d'))) {
                    return "Belum Dibayar";
                } elseif ($q->status == 'paid') {
                    return "Sudah Dibayar";
                } elseif ($q->status == 'post') {
                    return "Pembayaran Diterima";
                } else {
                    return "Open";
                }
            })
            ->addColumn('action', function ($q) {
                //Kemudian kita menambahkan kolom baru , yaitu "action"
                if (\Carbon\Carbon::createFromFormat('Y-m-d', $q->date)->lte(\Carbon\Carbon::now()->format('Y-m-d')) && $q->status != "post" ||  $q->status != "in-proses") {
                    return view('links', [
                        //Kemudian dioper ke file links.blade.php
                        'model' => $q,
                        // 'link_edit' => route('tagihan.edit', $q->id),
                        // 'link_hapus' => route('tagihan.destroy', $q->id),
                        // 'link_show' => route('tagihan.show', $q->id),
                        // 'url_detail' => route('permission.show', $q->id),
                        'link_show' => route('payment.show', $q->id),
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
        // dd($data);
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
        DB::beginTransaction();
        try {

            DB::table('m_user_packages')->where([
                "cmp_id" => Auth::user()->cmp_id,
                "id" => $id,
            ])->update(['status' => "post", 'update_by' => Auth::user()->id]);

            DB::commit();
            return redirect()->route('payment.index')->with('message', 'Konfirmasi Pembayaran Berhasil .');
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(array('status' => false, "message" => "Tagihan Gagal Di buat", "error" => $th->getMessage()), 500);
        }
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
