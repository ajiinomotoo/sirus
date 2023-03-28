<?php

namespace App\Http\Controllers;

use App\Models\tkmstProv;
use Illuminate\Http\Request;
use DataTables;

class TkmstProvController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tkmst_provs = tkmstProv::latest()->get();

        if ($request->ajax()) {
            $data = tkmstProv::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->prov_id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProv">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->prov_id . '" data-original-title="Hapus" class="btn btn-danger btn-sm deleteProv">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('nonMedis.provinsi', compact('tkmst_provs'));
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
            'prov_name' => 'required|max:255'
        ];

        //   @dd($request->myMethod);
        if ($request->myMethod == 'create') {
            $myRules['prov_id'] = 'required|unique:tkmst_provs|max:25|min:3';
        } else if ($request->myMethod == 'edit') {
            $myRules['prov_id'] = 'required|max:25|min:3';
        }

        $request->validate($myRules);

        $myPrimer = ['prov_id' => $request->prov_id];
        $myData = ['prov_name' => $request->prov_name];
        tkmstProv::updateOrCreate($myPrimer, $myData);

        return response()->json(['success' => 'Provinsi saved successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(tkmstProv $tkmstProv)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($prov_id)
    {
        $tkmst_provs = tkmstProv::find($prov_id);
        return response()->json($tkmst_provs);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tkmstProv $tkmstProv)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($tkmstProv)
    {
        tkmstProv::find($tkmstProv)->delete();

        // dd($sx);

        return response()->json(['success' => 'Provinsi deleted successfully.']);
    }
}
