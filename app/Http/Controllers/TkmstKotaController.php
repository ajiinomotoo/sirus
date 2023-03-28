<?php

namespace App\Http\Controllers;

use App\Models\tkmstKota;
use App\Models\tkmstProv;
use Illuminate\Http\Request;
use DataTables;

class TkmstKotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tkmst_kotas = tkmstKota::latest()->get();

        if ($request->ajax()) {
            $data = tkmstKota::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('prov.prov_name', function ($data) {
                    return $data->prov->prov_name;
                })
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->kota_id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editKota">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->kota_id . '" data-original-title="Hapus" class="btn btn-danger btn-sm deleteKota">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('nonMedis.kota', compact('tkmst_kotas'), [
            'provs' => tkmstProv::all()
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
            'kota_name' => 'required|max:255',
            'prov_id' => 'required'
        ];

        //   @dd($request->myMethod);
        if ($request->myMethod == 'create') {
            $myRules['kota_id'] = 'required|unique:tkmst_kotas|max:25|min:1';
        } else if ($request->myMethod == 'edit') {
            $myRules['kota_id'] = 'required|max:25|min:1';
        }

        $request->validate($myRules);

        $myPrimer = ['kota_id' => $request->kota_id];
        $myData = [
            'kota_name' => $request->kota_name,
            'prov_id' => $request->prov_id
        ];
        tkmstKota::updateOrCreate($myPrimer, $myData);

        return response()->json(['success' => 'Kota saved successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(tkmstKota $tkmstKota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($kota_id)
    {
        $tkmst_kotas = tkmstKota::find($kota_id);
        return response()->json($tkmst_kotas);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tkmstKota $tkmstKota)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($tkmstKota)
    {
        tkmstKota::find($tkmstKota)->delete();

        // dd($sx);

        return response()->json(['success' => 'Kota deleted successfully.']);
    }
}
