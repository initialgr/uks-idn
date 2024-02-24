<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Record::paginate();

        return view('record.index', compact('records'));
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
            'name' => 'required|string|regex:/^[A-Za-z\s]+$/i|max:255',
            'age' => 'required|numeric|min:10',
            'school' => 'required|string|max:255',
            'allergy' => 'nullable|string|regex:/^[A-Za-z\s]+$/i|max:255',
            'complaint' => 'required|string|regex:/^[A-Za-z\s]+$/i|max:255',
            'ph_inspect' => 'nullable|string|regex:/^[A-Za-z\s]+$/i|max:255',
            'diagnose' => 'required|string|regex:/^[A-Za-z\s]+$/i|max:255',
        ], [
            'name.regex' => 'Nama hanya boleh berisi huruf dan spasi!',
            'allergy.regex' => 'Alergi hanya boleh berisi huruf dan spasi!',
            'complaint.regex' => 'Komplain hanya boleh berisi huruf dan spasi!',
            'ph_inspect.regex' => 'Pemeriksaan Fisik hanya boleh berisi huruf dan spasi!',
            'diagnose.regex' => 'Diagnosa hanya boleh berisi huruf dan spasi!',
        ]);

        if ($validate->fails()) {
            return redirect()->route('record.index')->withInput()->withErrors($validate);
        }

        Record::create($data);
        return redirect()->route('record.index')->with('status', 'Pemeriksaan berhasil Dibuat');
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

        $query = Record::query();

        if ($tgl_mulai && $tgl_selesai) {
            $query->whereBetween('created_at', [$tgl_mulai, $tgl_selesai]);
        }

        $records = $query->paginate();
        $sum_record = $query->count();

        return view('record.print', compact('records', 'sum_record', 'tgl_mulai', 'tgl_selesai'));
    }
}
