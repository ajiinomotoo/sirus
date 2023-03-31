<?php

namespace App\Http\Controllers;

use App\Models\rsmstDesa;
use App\Models\rsmstKecamatan;
use Illuminate\Http\Request;
use DataTables;

class RsmstDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rsmst_desas = rsmstDesa::latest()->get();

        if ($request->ajax()) {
            $data = rsmstDesa::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('kec.kec_name', function ($data) {
                    return $data->kec->kec_name;
                })
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->des_id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editDesa">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->des_id . '" data-original-title="Hapus" class="btn btn-danger btn-sm deleteDesa">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('nonMedis.desa', compact('rsmst_desas'), [
            'kecs' => rsmstKecamatan::all()
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
            'des_name' => 'required|max:255',
            'kec_id' => 'required'
        ];

        //   @dd($request->myMethod);
        if ($request->myMethod == 'create') {
            $myRules['des_id'] = 'required|unique:rsmst_desas|max:25|min:1';
        } else if ($request->myMethod == 'edit') {
            $myRules['des_id'] = 'required|max:25|min:1';
        }

        $request->validate($myRules);

        $myPrimer = ['des_id' => $request->des_id];
        $myData = [
            'des_name' => $request->des_name,
            'kec_id' => $request->kec_id
        ];
        rsmstDesa::updateOrCreate($myPrimer, $myData);

        return response()->json(['success' => 'Desa saved successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(rsmstDesa $rsmstDesa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($des_id)
    {
        $rsmst_desas = rsmstDesa::find($des_id);
        return response()->json($rsmst_desas);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rsmstDesa $rsmstDesa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($rsmstDesa)
    {
        rsmstDesa::find($rsmstDesa)->delete();

        // dd($sx);

        return response()->json(['success' => 'Desa deleted successfully.']);
    }
}
