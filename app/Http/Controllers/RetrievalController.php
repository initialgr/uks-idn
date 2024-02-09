<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use App\Models\Record;
use App\Models\Retrieval;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class RetrievalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $retrievals = Retrieval::paginate();
        $records = Record::all();
        $drugs = Drug::all();
        $users = User::all();

        $kosong = Drug::where('stok', 0)->get();

        return view('retrieval.index', compact('retrievals', 'records', 'drugs', 'users', 'kosong'));
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
        $data = $request->all();

        $validate = Validator::make($data, [
            'user_id' => 'required|numeric',
            'record_id' => 'required|numeric',
            'drug_id' => 'required|numeric',
            'quantity' => 'required|numeric',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $drug = Drug::find($request->drug_id);

        if ($drug->stok < $request->quantity) {
            return redirect()->route('retrieval.index')->with('kurang', 'Stok Obat tidak mencukupi');
        }
        $drug->stok -= $request->quantity;
        $drug->save();

        if ($validate->fails()) {
            return redirect()->route('retrieval.index')->withInput()->withErrors($validate);
        }
        Retrieval::create($data);
        return redirect()->route('retrieval.index')->with('status', 'Pengambilan Obat berhasil Dibuat');
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

    public function print(Request $request)
    {
        $tgl_mulai = $request->tgl_mulai;
        $tgl_selesai = $request->tgl_selesai;

        // Make sure dates are properly formatted
        $tgl_mulai = Carbon::parse($tgl_mulai)->startOfDay()->toDateTimeString();
        $tgl_selesai = Carbon::parse($tgl_selesai)->endOfDay()->toDateTimeString();

        $query = Retrieval::query();

        if ($tgl_mulai && $tgl_selesai) {
            $query->whereBetween('created_at', [$tgl_mulai, $tgl_selesai]);
        }

        $retrievals = $query->paginate();
        $sum_retrieval = $query->count();

        return view('retrieval.print', compact('retrievals', 'sum_retrieval', 'tgl_mulai', 'tgl_selesai'));
    }


}
