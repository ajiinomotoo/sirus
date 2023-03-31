<?php

namespace App\Http\Controllers;

use App\Models\rsmstReligion;
use Illuminate\Http\Request;
use DataTables;

class RsmstReligionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rsmst_religions = rsmstReligion::latest()->get();

        if ($request->ajax()) {
            $data = rsmstReligion::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->rel_id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editReligi">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->rel_id . '" data-original-title="Hapus" class="btn btn-danger btn-sm deleteReligi">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('nonMedis.religion', compact('rsmst_religions'));
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
            'rel_desc' => 'required|max:255'
        ];

        //   @dd($request->myMethod);
        if ($request->myMethod == 'create') {
            $myRules['rel_id'] = 'required|unique:rsmst_religions|max:25|min:1';
        } else if ($request->myMethod == 'edit') {
            $myRules['rel_id'] = 'required|max:25|min:1';
        }

        $request->validate($myRules);

        $myPrimer = ['rel_id' => $request->rel_id];
        $myData = ['rel_desc' => $request->rel_desc];
        rsmstReligion::updateOrCreate($myPrimer, $myData);

        return response()->json(['success' => 'Religion saved successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(rsmstReligion $rsmstReligion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($rel_id)
    {
        $rsmst_religions = rsmstReligion::find($rel_id);
        return response()->json($rsmst_religions);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rsmstReligion $rsmstReligion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($rsmstReligion)
    {
        rsmstReligion::find($rsmstReligion)->delete();

        // dd($sx);

        return response()->json(['success' => 'Religion deleted successfully.']);
    }
}
