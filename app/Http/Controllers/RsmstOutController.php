<?php

namespace App\Http\Controllers;

use App\Models\rsmstOut;
use Illuminate\Http\Request;
use DataTables;

class RsmstOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rsmst_outs = rsmstOut::latest()->get();

        if ($request->ajax()) {
            $data = rsmstOut::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->out_no . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editOut">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->out_no . '" data-original-title="Hapus" class="btn btn-danger btn-sm deleteOut">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('nonMedis.out', compact('rsmst_outs'));
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
            'out_desc' => 'required|max:255'
        ];

        //   @dd($request->myMethod);
        if ($request->myMethod == 'create') {
            $myRules['out_no'] = 'required|unique:rsmst_outs|max:25|min:3';
        } else if ($request->myMethod == 'edit') {
            $myRules['out_no'] = 'required|max:25|min:3';
        }

        $request->validate($myRules);

        $myPrimer = ['out_no' => $request->out_no];
        $myData = ['out_desc' => $request->out_desc];
        rsmstOut::updateOrCreate($myPrimer, $myData);

        return response()->json(['success' => 'Entrytype saved successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(rsmstOut $rsmstOut)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($out_no)
    {
        $rsmst_outs = rsmstOut::find($out_no);
        return response()->json($rsmst_outs);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rsmstOut $rsmstOut)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($rsmstOut)
    {
        rsmstOut::find($rsmstOut)->delete();

        // dd($sx);

        return response()->json(['success' => 'Entrytype deleted successfully.']);
    }
}
