<?php

namespace App\Http\Controllers;

use App\Models\rsmstParameter;
use Illuminate\Http\Request;
use DataTables;

class RsmstParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rsmst_parameters = rsmstParameter::latest()->get();

        if ($request->ajax()) {
            $data = rsmstParameter::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->par_id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editParameter">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->par_id . '" data-original-title="Hapus" class="btn btn-danger btn-sm deleteParameter">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('medis.parameter', compact('rsmst_parameters'));
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
            'par_desc' => 'required|max:255',
            'par_value' => 'required|max:255'
        ];

        //   @dd($request->myMethod);
        if ($request->myMethod == 'create') {
            $myRules['par_id'] = 'required|unique:rsmst_parameters|max:25|min:3';
        } else if ($request->myMethod == 'edit') {
            $myRules['par_id'] = 'required|max:25|min:3';
        }

        $request->validate($myRules);

        $myPrimer = ['par_id' => $request->par_id];
        $myData = [
            'par_desc' => $request->par_desc,
            'par_value' => $request->par_value
        ];
        rsmstParameter::updateOrCreate($myPrimer, $myData);

        return response()->json(['success' => 'Parameter saved successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(rsmstParameter $rsmstParameter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($par_id)
    {
        $rsmst_parameters = rsmstParameter::find($par_id);
        return response()->json($rsmst_parameters);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rsmstParameter $rsmstParameter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($rsmstParameter)
    {
        rsmstParameter::find($rsmstParameter)->delete();

        // dd($sx);

        return response()->json(['success' => 'Parameter deleted successfully.']);
    }
}
