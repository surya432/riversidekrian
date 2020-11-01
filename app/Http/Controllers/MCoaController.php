<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MCoa as MCoaModel;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MCoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coa = MCoaModel::orderBy('code')->get();

        return view('coa.index', compact('coa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $coa = MCoaModel::orderBy('desc', 'ASC')->get();

        return view('coa.create', compact('coa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        //code
        ($request->parent_code == null)  ? $code = $request->code : $code = $request->parent_code . $request->code;

        //parent-id
        ($request->parent_id == null) ? $parent_id = 0 : $parent_id =  $request->parent_id;

        //cek code
        $cekCode = MCoaModel::where('code', $code)->count();

        if ($cekCode > 0) {
            return redirect()->back()->with('message', 'Code Sudah Dipakai');
        }
        //replace-array-request
        $request->merge([
            'code' => $code,
            'parent_id' => $parent_id,
            'desc' =>  strtoupper($request->desc),
            'cmp_id' => Auth::user()->cmp_id,
        ]);

        DB::beginTransaction();

        try {

            MCoaModel::create($request->except('_token', '_method', 'parent_code'));

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
        }

        return redirect()->route('coa.index')->with('message', 'Berhasil Disimpan');;
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
    public function edit(MCoaModel $mCoa, $id)
    {
        $cmp_id = Auth::user()->cmp_id;

        $coa = MCoaModel::where('id', $id)->where('cmp_id', $cmp_id)->first();
        if (!$coa) {
            return abort(404);
        }
        $coaParent = MCoaModel::where('id', $id)->where('cmp_id', $cmp_id)->orderBy('desc', 'ASC')->get();

        // dd($coa);
        return view('coa.edit', compact('coa', 'coaParent'));
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
        // dd($request->all());
        $request->merge(['desc' => strtoupper($request->desc),]);
        MCoaModel::where('id', $id)->update($request->except('_token', '_method', 'code'));

        return redirect()->route('coa.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cmp_id = Auth::user()->cmp_id;
        $mCoa = MCoaModel::find($id);
        $cekParentId = MCoaModel::where('parent_id', $mCoa->id)->where('cmp_id', $cmp_id)->count();

        if ($cekParentId > 0) {
            return redirect()->back()->with('message', 'Data tidak Bisa dihapus karena punya cabang');
        }

        // $cekTransaksi = DB::table('t_cash_bank')->where('id_coa', $id)->count();

        // if ($cekTransaksi > 0) {
        //     return redirect()->back()->with('message', 'Data tidak Bisa dihapus karena Dipakai transaksi');
        // }

        MCoaModel::where('id', $id)->where('cmp_id', $cmp_id)->delete();
        // var_dump($cekParentId);
        return redirect()->back()->with('message-success', 'Data berhasil dihapus');
    }

    public function getParent($id)
    {
        return response()->json(MCoaModel::find($id));
    }
    public function apiCoa()
    {
        $cmp_id = Auth::user()->cmp_id;
        $coa = MCoaModel::where('cmp_id', $cmp_id)->orderBy('code')->get();

        return Datatables::of($coa)
            ->addColumn('action', function ($q) {
                return view('links', [
                    //Kemudian dioper ke file links.blade.php
                    'model' => $q,
                    'link_edit' => route('coa.edit', $q->id),
                    'link_hapus' => route('coa.destroy', $q->id),
                    // 'link_show' => route('coa.show', $q->id),
                    // 'url_detail' => route('permission.show', $q->id),
                ]);
            })

            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }
}
