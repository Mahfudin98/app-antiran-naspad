<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PDF;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'no_hp' => 'required',
            'level' => 'required',
        ]);
        $data = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'level' => $request->level,
        ]);
        return redirect()->route('users.index')->with('success', 'User Berhasil Ditambah!');
    }

    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'nullable',
            'no_hp' => 'required',
            'level' => 'required',
        ]);
        $data = User::find($id);
        $data->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password != '' ? Hash::make($request->password) : $data->password,
            'no_hp' => $request->no_hp,
            'level' => $request->level,
        ]);
        return redirect()->route('users.index')->with('success', 'User Berhasil Diupdate!');
    }

    public function destroy(User $user)
    {
        DB::beginTransaction();
        try {
            $user->delete();
        } catch (\Throwable $th) {
            DB::rollBack();
        } finally {
            DB::commit();
            return redirect()->back()->with('success', 'User Berhasil Dihapus!');
        }
    }

    public function exportpdf()
    {
        $path = 'img/enesers.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $user = User::all();

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadview('users.userspdf', compact('base64', 'user'));
        return
            $pdf->setPaper('a3', 'portail')->setOptions(['defaultFont' => 'serif'])->download('DataUser.pdf');
    }
}
