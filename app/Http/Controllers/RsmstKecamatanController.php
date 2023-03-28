<?php

namespace App\Http\Controllers;

use App\Models\tkmstKota;
use App\Models\rsmstKecamatan;
use Illuminate\Http\Request;
use DataTables;

class RsmstKecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rsmst_kecamatans = rsmstKecamatan::latest()->get();

        if ($request->ajax()) {
            $data = rsmstKecamatan::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->kec_id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editKec">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->kec_id . '" data-original-title="Hapus" class="btn btn-danger btn-sm deleteKec">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('nonMedis.kecamatan', compact('rsmst_kecamatans'), [
            // 'kabs' => tkmstKota::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $myRules = [
            'kec_name' => 'required|max:255',
            'kota_id' => 'required'
        ];

        //   @dd($request->myMethod);
        if ($request->myMethod == 'create') {
            $myRules['kec_id'] = 'required|unique:rsmst_kecamatans|max:25|min:1';
        } else if ($request->myMethod == 'edit') {
            $myRules['kec_id'] = 'required|max:25|min:1';
        }

        $request->validate($myRules);

        $myPrimer = ['kec_id' => $request->kec_id];
        $myData = [
            'kec_name' => $request->kec_name,
            'kota_id' => $request->kota_id
        ];
        rsmstKecamatan::updateOrCreate($myPrimer, $myData);

        return response()->json(['success' => 'Kecamatan saved successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(rsmstKecamatan $rsmstKecamatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($kec_id)
    {
        $rsmst_kecamatans = rsmstKecamatan::find($kec_id);
        return response()->json($rsmst_kecamatans);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rsmstKecamatan $rsmstKecamatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($rsmstKecamatan)
    {
        rsmstKecamatan::find($rsmstKecamatan)->delete();

        // dd($sx);

        return response()->json(['success' => 'Kecamatan deleted successfully.']);
    }
}
