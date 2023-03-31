<?php

namespace App\Http\Controllers;

use App\Models\rsmstDesa;
use App\Models\rsmstEducation;
use App\Models\rsmstJob;
use App\Models\rsmstKabupaten;
use App\Models\rsmstKecamatan;
use App\Models\rsmstPasien;
use App\Models\rsmstPropinsi;
use App\Models\rsmstReligion;
use Illuminate\Http\Request;
use DataTables;

class RsmstPasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rsmst_pasiens = rsmstPasien::latest()->get();

        if ($request->ajax()) {
            $data = rsmstPasien::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('rel_id', function ($data) {
                    return $data->rel->rel_desc;
                })
                ->editColumn('des_id', function ($data) {
                    return $data->desa->des_name;
                })
                ->editColumn('kec_id', function ($data) {
                    return $data->kec->kec_name;
                })
                ->editColumn('kab_id', function ($data) {
                    return $data->kab->kab_name;
                })
                ->editColumn('prop_id', function ($data) {
                    return $data->prop->prop_name;
                })
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->reg_no . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editPasien">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->reg_no . '" data-original-title="Hapus" class="btn btn-danger btn-sm deletePasien">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('medis.pasien', compact('rsmst_pasiens'), [
            'rels' => rsmstReligion::all(),
            'edus' => rsmstEducation::all(),
            'jobs' => rsmstJob::all(),
            'desas' => rsmstDesa::all(),
            'kecs' => rsmstKecamatan::all(),
            'kabs' => rsmstKabupaten::all(),
            'props' => rsmstPropinsi::all()
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
            'reg_name' => 'required|max:255',
            'no_jkn' => 'required',
            'nik_bpjs' => 'required',
            'sex' => 'required',
            'age' => 'required',
            'blood' => 'required',
            'birth_date' => 'required',
            'birth_place' => 'required',
            'rel_id' => 'required',
            'edu_id' => 'required',
            'job_id' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'des_id' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kec_id' => 'required',
            'kab_id' => 'required',
            'prop_id' => 'required'
        ];

        //   @dd($request->myMethod);
        if ($request->myMethod == 'create') {
            $myRules['reg_no'] = 'required|unique:rsmst_pasiens|max:25|min:1';
        } else if ($request->myMethod == 'edit') {
            $myRules['reg_no'] = 'required|max:25|min:1';
        }

        $request->validate($myRules);

        $myPrimer = ['reg_no' => $request->reg_no];
        $myData = [
            'reg_name' => $request->reg_name,
            'no_jkn' => $request->no_jkn,
            'nik_bpjs' => $request->nik_bpjs,
            'sex' => $request->sex,
            'age' => $request->age,
            'blood' => $request->blood,
            'birth_date' => $request->birth_date,
            'birth_place' => $request->birth_place,
            'rel_id' => $request->rel_id,
            'edu_id' => $request->edu_id,
            'job_id' => $request->job_id,
            'phone' => $request->phone,
            'address' => $request->address,
            'des_id' => $request->des_id,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'kec_id' => $request->kec_id,
            'kab_id' => $request->kab_id,
            'prop_id' => $request->prop_id
        ];
        rsmstPasien::updateOrCreate($myPrimer, $myData);

        return response()->json(['success' => 'Pasien saved successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(rsmstPasien $rsmstPasien)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($reg_no)
    {
        $rsmst_pasiens = rsmstPasien::find($reg_no);
        return response()->json($rsmst_pasiens);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rsmstPasien $rsmstPasien)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($rsmstPasien)
    {
        rsmstPasien::find($rsmstPasien)->delete();

        // dd($sx);

        return response()->json(['success' => 'Pasien deleted successfully.']);
    }
}
