<?php

namespace App\Http\Controllers;

use App\Models\rsmstDoctor;
use App\Models\rsmstPoli;
use Illuminate\Http\Request;
use DataTables;

class RsmstDoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rsmst_doctors = rsmstDoctor::latest()->get();

        if ($request->ajax()) {
            $data = rsmstDoctor::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('poli_id', function ($data) {
                    return $data->poli->poli_desc;
                })
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->dr_id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editDoctor">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->dr_id . '" data-original-title="Hapus" class="btn btn-danger btn-sm deleteDoctor">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('medis.doctor', compact('rsmst_doctors'), [
            'polis' => rsmstPoli::all()
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
            'dr_name' => 'required',
            'dr_phone' => 'required',
            'dr_address' => 'required',
            'poli_id' => 'required',
            'poli_price' => 'required',
            'ugd_price' => 'required',
            'basic_salary' => 'required',
            'contribution_status' => 'required',
            'active_status' => 'required'
        ];

        //   @dd($request->myMethod);
        if ($request->myMethod == 'create') {
            $myRules['dr_id'] = 'required|unique:rsmst_doctors|max:25|min:1';
        } else if ($request->myMethod == 'edit') {
            $myRules['dr_id'] = 'max:25|min:1';
        }

        $request->validate($myRules);
        $myPrimer = ['dr_id' => $request->dr_id];

        $myData = [
            'dr_name' => $request->dr_name,
            'dr_phone' => $request->dr_phone,
            'dr_address' => $request->dr_address,
            'poli_id' => $request->poli_id,
            'poli_price' => $request->poli_price,
            'ugd_price' => $request->ugd_price,
            'basic_salary' => $request->basic_salary,
            'contribution_status' => $request->contribution_status,
            'active_status' => $request->active_status
        ];
        rsmstDoctor::updateOrCreate($myPrimer, $myData);

        return response()->json(['success' => 'Dokter saved successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(rsmstDoctor $rsmstDoctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($dr_id)
    {
        $rsmst_doctors = rsmstDoctor::find($dr_id);
        return response()->json($rsmst_doctors);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rsmstDoctor $rsmstDoctor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($rsmstDoctor)
    {
        rsmstDoctor::find($rsmstDoctor)->delete();

        // dd($sx);

        return response()->json(['success' => 'Dokter deleted successfully.']);
    }
}
