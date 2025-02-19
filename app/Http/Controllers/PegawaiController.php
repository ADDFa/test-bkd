<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawai = Pegawai::all();
        return response()->json($pegawai);
    }

    public function pegawaiGol()
    {
        $pegawaiGol = Pegawai::query("SELECT COUNT(pegawai_golongan) FROM pegawai GROUP BY pegawai_golongan")->get();
        return response()->json($pegawaiGol);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "pegawai_nip"           => "required|unique:pegawai|min:18|max:18",
            "pegawai_nama"          => "required",
            "pegawai_glr_depan"     => "required",
            "pegawai_glr_blkg"  => "required",
            "pegawai_jabatan"       => "required",
            "pegawai_golongan"      => "required",
            "pegawai_unor"          => "required",
        ]);
        if ($validator->fails()) return response()->json(["errors" => $validator->errors()], 400);

        $pegawai = new Pegawai($validator->validate());
        $pegawai->save();

        return response()->json($pegawai);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {
        return response()->json($pegawai);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $validator = Validator::make($request->all(), [
            "pegawai_nip"           => [
                "required",
                "min:18",
                "max:18",
                Rule::unique("pegawai")->ignore($pegawai->id)
            ],
            "pegawai_nama"          => "required",
            "pegawai_glr_depan"     => "required",
            "pegawai_glr_blkg"  => "required",
            "pegawai_jabatan"       => "required",
            "pegawai_golongan"      => "required",
            "pegawai_unor"          => "required",
        ]);
        if ($validator->fails()) return response()->json(["errors" => $validator->errors()], 400);

        $pegawai->update($validator->validate());

        return response()->json($pegawai);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();
        return response()->json($pegawai);
    }
}
