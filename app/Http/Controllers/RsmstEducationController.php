<?php

namespace App\Http\Controllers;

use App\Models\rsmstEducation;
use Illuminate\Http\Request;
use DataTables;

class RsmstEducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rsmst_educations = rsmstEducation::latest()->get();

        if ($request->ajax()) {
            $data = rsmstEducation::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->edu_id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editEducation">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->edu_id . '" data-original-title="Hapus" class="btn btn-danger btn-sm deleteEducation">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('nonMedis.education', compact('rsmst_educations'));
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
            'edu_desc' => 'required|max:255'
        ];

        //   @dd($request->myMethod);
        if ($request->myMethod == 'create') {
            $myRules['edu_id'] = 'required|unique:rsmst_educations|max:25|min:3';
        } else if ($request->myMethod == 'edit') {
            $myRules['edu_id'] = 'required|max:25|min:3';
        }

        $request->validate($myRules);

        $myPrimer = ['edu_id' => $request->edu_id];
        $myData = ['edu_desc' => $request->edu_desc];
        rsmstEducation::updateOrCreate($myPrimer, $myData);

        return response()->json(['success' => 'Education saved successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(rsmstEducation $rsmstEducation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($edu_id)
    {
        $rsmst_educations = rsmstEducation::find($edu_id);
        return response()->json($rsmst_educations);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rsmstEducation $rsmstEducation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($rsmstEducation)
    {
        rsmstEducation::find($rsmstEducation)->delete();

        // dd($sx);

        return response()->json(['success' => 'Education deleted successfully.']);
    }
}
