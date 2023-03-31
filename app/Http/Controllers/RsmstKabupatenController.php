<?php

namespace App\Http\Controllers;

use App\Models\rsmstKabupaten;
use App\Models\rsmstPropinsi;
use Illuminate\Http\Request;
use DataTables;

class RsmstKabupatenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rsmst_kabupatens = rsmstKabupaten::latest()->get();

        if ($request->ajax()) {
            $data = rsmstKabupaten::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('prop.prop_name', function ($data) {
                    return $data->prop->prop_name;
                })
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->kab_id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editKab">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->kab_id . '" data-original-title="Hapus" class="btn btn-danger btn-sm deleteKab">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('nonMedis.kabupaten', compact('rsmst_kabupatens',), [
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
            'kab_name' => 'required|max:255',
            'prop_id' => 'required'
        ];

        //   @dd($request->myMethod);
        if ($request->myMethod == 'create') {
            $myRules['kab_id'] = 'required|unique:rsmst_kabupatens|max:25|min:1';
        } else if ($request->myMethod == 'edit') {
            $myRules['kab_id'] = 'required|max:25|min:1';
        }

        $request->validate($myRules);

        $myPrimer = ['kab_id' => $request->kab_id];
        $myData = [
            'kab_name' => $request->kab_name,
            'prop_id' => $request->prop_id
        ];
        rsmstKabupaten::updateOrCreate($myPrimer, $myData);

        return response()->json(['success' => 'Kabupaten saved successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(rsmstKabupaten $rsmstKabupaten)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($kab_id)
    {
        $rsmst_kabupatens = rsmstKabupaten::find($kab_id);
        return response()->json($rsmst_kabupatens);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rsmstKabupaten $rsmstKabupaten)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($rsmstKabupaten)
    {
        rsmstKabupaten::find($rsmstKabupaten)->delete();

        // dd($sx);

        return response()->json(['success' => 'Kabupaten deleted successfully.']);
    }
}
