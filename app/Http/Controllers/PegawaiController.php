<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;

class PegawaiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $pegawais = Pegawai::all();
        return response()->json([
            'status' => 'success',
            'pegawais' => $pegawais,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'job' => 'required|string|max:255',
        ]);

        $pegawai = Pegawai::create([
            'nama' => $request->nama,
            'job' => $request->job,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Pegawai created successfully',
            'pegawai' => $pegawai,
        ]);
    }

    public function show($id)
    {
        $pegawai = Pegawai::find($id);
        return response()->json([
            'status' => 'success',
            'pegawai' => $pegawai,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'job' => 'required|string|max:255',
        ]);

        $pegawai = Pegawai::find($id);
        $pegawai->nama = $request->nama;
        $pegawai->job = $request->job;
        $pegawai->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Pegawai updated successfully',
            'pegawai' => $pegawai,
        ]);
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::find($id);
        $pegawai->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Pegawai deleted successfully',
            'pegawai' => $pegawai,
        ]);
    }
}