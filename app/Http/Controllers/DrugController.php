<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DrugController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drugs = Drug::paginate();
        $users = User::all();
        $stocks = Stock::all();


        return view('drug.index', compact('drugs', 'users', 'stocks'));
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
        $rules = [
            'name' => ['required', 'string', 'max:255', 'regex:/^[^\d]+$/'],
            'type' => 'required|string|max:100',
            'dose' => 'required|numeric',
            'unit' => 'required|string|max:100',
            'stok' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) {
                    if ($value < 0) {
                        $fail('Stok tidak boleh mines.');
                    }
                }
            ],
            'satuan' => 'required|string|max:100',
        ];

        // Pesan validasi kustom
        $customMessages = [
            'name.regex' => 'Nama obat tidak boleh menggunakan angka.',
            // Tambahkan pesan validasi kustom lainnya di sini sesuai kebutuhan
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            // Jika validasi gagal, kembalikan dengan pesan kesalahan
            return redirect()->route('drug.index')->withInput()->withErrors($validator);
        }

        Drug::create($request->all());
        return redirect()->route('drug.index')->with('status', 'Obat berhasil Dibuat');
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

    public function stock(Request $request)
    {
        Stock::create([
            'drug_id' => $request->drug_id,
            'user_id' => $request->user_id,
            'stock' => $request->stock,
        ]);

        $drug = Drug::find($request->drug_id);

        $drug->stok += $request->stock;
        $drug->save();

        return redirect()->route('drug.index')->with('status', 'Stok Obat berhasil Ditambahkan');
    }

    public function print(Request $request)
    {
        $drugs = Drug::paginate();

        return view('drug.print', compact('drugs'));
    }


}
