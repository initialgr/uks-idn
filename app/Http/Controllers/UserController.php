<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::paginate();
        return view('user.index', compact('user'));
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
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:100|unique:users',
            'level' => 'required',
            'email' => 'nullable|email|unique:users',
            'password' => 'required|min:6',
        ]);

        if ($validate->fails()) {
            return redirect()->route('user.index')->withInput()->withErrors($validate);
        }

        $data['password'] = bcrypt($data['password']);
        User::create($data);
        return redirect()->route('user.index')->with('status', 'User berhasil Dibuat');

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
        $data = User::findOrFail($id);

        // Check if the user has 'admin' level
        if ($data->level == 'admin') {
            return redirect()->route('user.index')->with('error', 'Admin user cannot be deleted.');
        }

        $data->delete();

        return redirect()->route('user.index')->with('delete', 'User berhasil dihapus');

    }
}
