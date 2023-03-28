<?php

namespace App\Http\Controllers;

use App\Models\tkmstProfile;
use Illuminate\Http\Request;
use DataTables;

class TkmstProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tkmst_profiles = tkmstProfile::latest()->get();

        if ($request->ajax()) {
            $data = tkmstProfile::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->prof_id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProfile">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->prof_id . '" data-original-title="Hapus" class="btn btn-danger btn-sm deleteProfile">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('nonMedis.profile', compact('tkmst_profiles'));
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
            'prof_desc' => 'required|max:255'
        ];

        //   @dd($request->myMethod);
        if ($request->myMethod == 'create') {
            $myRules['prof_id'] = 'required|unique:tkmst_profiles|max:25|min:3';
        } else if ($request->myMethod == 'edit') {
            $myRules['prof_id'] = 'required|max:25|min:3';
        }

        $request->validate($myRules);

        $myPrimer = ['prof_id' => $request->prof_id];
        $myData = ['prof_desc' => $request->prof_desc];
        tkmstProfile::updateOrCreate($myPrimer, $myData);

        return response()->json(['success' => 'Job saved successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(tkmstProfile $tkmstProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($prof_id)
    {
        $tkmst_profiles = tkmstProfile::find($prof_id);
        return response()->json($tkmst_profiles);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tkmstProfile $tkmstProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($tkmstProfile)
    {
        tkmstProfile::find($tkmstProfile)->delete();

        // dd($sx);

        return response()->json(['success' => 'Job deleted successfully.']);
    }
}
