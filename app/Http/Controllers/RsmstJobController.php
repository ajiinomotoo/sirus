<?php

namespace App\Http\Controllers;

use App\Models\rsmstJob;
use Illuminate\Http\Request;
use DataTables;

class RsmstJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rsmst_jobs = rsmstJob::latest()->get();

        if ($request->ajax()) {
            $data = rsmstJob::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->job_id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editJob">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->job_id . '" data-original-title="Hapus" class="btn btn-danger btn-sm deleteJob">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('nonMedis.job', compact('rsmst_jobs'));
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
            'job_name' => 'required|max:255'
        ];

        //   @dd($request->myMethod);
        if ($request->myMethod == 'create') {
            $myRules['job_id'] = 'required|unique:rsmst_jobs|max:25|min:1';
        } else if ($request->myMethod == 'edit') {
            $myRules['job_id'] = 'required|max:25|min:1';
        }

        $request->validate($myRules);

        $myPrimer = ['job_id' => $request->job_id];
        $myData = ['job_name' => $request->job_name];
        rsmstJob::updateOrCreate($myPrimer, $myData);

        return response()->json(['success' => 'Job saved successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(rsmstJob $rsmstJob)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($job_id)
    {
        $rsmst_jobs = rsmstJob::find($job_id);
        return response()->json($rsmst_jobs);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rsmstJob $rsmstJob)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($rsmstJob)
    {
        rsmstJob::find($rsmstJob)->delete();

        // dd($sx);

        return response()->json(['success' => 'Job deleted successfully.']);
    }
}
