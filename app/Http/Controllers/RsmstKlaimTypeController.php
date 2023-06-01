<?php

namespace App\Http\Controllers;

use App\Models\rsmstKlaimType;
use Illuminate\Http\Request;
use Yajra\DataTables\Services\DataTable;
use DataTables;

class RsmstKlaimTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rsmst_klaimtypes = rsmstKlaimType::latest()->get();

        if ($request->ajax()) {
            $data = rsmstKlaimType::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->klaim_id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editKlaim">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->klaim_id . '" data-original-title="Hapus" class="btn btn-danger btn-sm deleteKlaim">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('medis.klaimtype', compact('rsmst_klaimtypes'));
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
            'klaim_desc' => 'required|max:255',
            'klaim_status' => 'required'
        ];

        //   @dd($request->myMethod);
        if ($request->myMethod == 'create') {
            $myRules['klaim_id'] = 'required|unique:rsmst_klaimtypes|max:25|min:1';
        } else if ($request->myMethod == 'edit') {
            $myRules['klaim_id'] = 'required|max:25|min:1';
        }

        $request->validate($myRules);

        $myPrimer = ['klaim_id' => $request->klaim_id];
        $myData = [
            'klaim_desc' => $request->klaim_desc,
            'klaim_status' => $request->klaim_status
        ];
        rsmstKlaimType::updateOrCreate($myPrimer, $myData);

        return response()->json(['success' => 'Klaimtype saved successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(rsmstKlaimType $rsmstKlaimType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($klaim_id)
    {
        $rsmst_klaimtypes = rsmstKlaimType::find($klaim_id);
        return response()->json($rsmst_klaimtypes);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rsmstKlaimType $rsmstKlaimType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($rsmstKlaimType)
    {
        rsmstKlaimType::find($rsmstKlaimType)->delete();

        // dd($sx);

        return response()->json(['success' => 'Klaimtype deleted successfully.']);
    }
}
