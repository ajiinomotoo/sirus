<?php

namespace App\Http\Controllers;

use App\Models\rsmstMstDiag;
use Illuminate\Http\Request;
use DataTables;

class RsmstMstDiagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rsmst_mstdiags = rsmstMstDiag::latest()->get();

        if ($request->ajax()) {
            $data = rsmstMstDiag::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->diag_id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editDiag">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->diag_id . '" data-original-title="Hapus" class="btn btn-danger btn-sm deleteDiag">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('medis.mstdiag', compact('rsmst_mstdiags'));
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
            'diag_desc' => 'required|max:255'
        ];

        //   @dd($request->myMethod);
        if ($request->myMethod == 'create') {
            $myRules['diag_id'] = 'required|unique:rsmst_mstdiags|max:25|min:3';
        } else if ($request->myMethod == 'edit') {
            $myRules['diag_id'] = 'required|max:25|min:3';
        }

        $request->validate($myRules);

        $myPrimer = ['diag_id' => $request->diag_id];
        $myData = ['diag_desc' => $request->diag_desc];
        rsmstMstDiag::updateOrCreate($myPrimer, $myData);

        return response()->json(['success' => 'Entrytype saved successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(rsmstMstDiag $rsmstMstDiag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($diag_id)
    {
        $rsmst_mstdiags = rsmstMstDiag::find($diag_id);
        return response()->json($rsmst_mstdiags);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rsmstMstDiag $rsmstMstDiag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($rsmstMstDiag)
    {
        rsmstMstDiag::find($rsmstMstDiag)->delete();

        // dd($sx);

        return response()->json(['success' => 'Entrytype deleted successfully.']);
    }
}
