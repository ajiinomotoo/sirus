<?php

namespace App\Http\Controllers;

use App\Models\rsmstPoli;
use Illuminate\Http\Request;
use DataTables;

class RsmstPoliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rsmst_polis = rsmstPoli::latest()->get();

        if ($request->ajax()) {
            $data = rsmstPoli::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->poli_id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editPoli">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->poli_id . '" data-original-title="Hapus" class="btn btn-danger btn-sm deletePoli">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('medis.poli', compact('rsmst_polis'));
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
            'poli_desc' => 'required|max:255'
        ];

        //   @dd($request->myMethod);
        if ($request->myMethod == 'create') {
            $myRules['poli_id'] = 'required|unique:rsmst_polis|max:25|min:3';
        } else if ($request->myMethod == 'edit') {
            $myRules['poli_id'] = 'required|max:25|min:3';
        }

        $request->validate($myRules);

        $myPrimer = ['poli_id' => $request->poli_id];
        $myData = ['poli_desc' => $request->poli_desc];
        rsmstPoli::updateOrCreate($myPrimer, $myData);

        return response()->json(['success' => 'Poli saved successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(rsmstPoli $rsmstPoli)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($poli_id)
    {
        $rsmst_polis = rsmstPoli::find($poli_id);
        return response()->json($rsmst_polis);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rsmstPoli $rsmstPoli)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($rsmstPoli)
    {
        rsmstPoli::find($rsmstPoli)->delete();

        // dd($sx);

        return response()->json(['success' => 'Poli deleted successfully.']);
    }
}
