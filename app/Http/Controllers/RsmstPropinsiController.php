<?php

namespace App\Http\Controllers;

use App\Models\rsmstPropinsi;
use Illuminate\Http\Request;
use DataTables;

class RsmstPropinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rsmst_propinsis = rsmstPropinsi::latest()->get();

        if ($request->ajax()) {
            $data = rsmstPropinsi::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->prop_id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProp">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->prop_id . '" data-original-title="Hapus" class="btn btn-danger btn-sm deleteProp">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('nonMedis.propinsi', compact('rsmst_propinsis'));
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
            'prop_name' => 'required|max:255'
        ];

        //   @dd($request->myMethod);
        if ($request->myMethod == 'create') {
            $myRules['prop_id'] = 'required|unique:rsmst_propinsis|max:25|min:1';
        } else if ($request->myMethod == 'edit') {
            $myRules['prop_id'] = 'required|max:25|min:1';
        }

        $request->validate($myRules);

        $myPrimer = ['prop_id' => $request->prop_id];
        $myData = ['prop_name' => $request->prop_name];
        rsmstPropinsi::updateOrCreate($myPrimer, $myData);

        return response()->json(['success' => 'Provinsi saved successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(rsmstPropinsi $rsmstPropinsi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($prop_id)
    {
        $rsmst_propinsis = rsmstPropinsi::find($prop_id);
        return response()->json($rsmst_propinsis);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rsmstPropinsi $rsmstPropinsi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($rsmstPropinsi)
    {
        rsmstPropinsi::find($rsmstPropinsi)->delete();

        // dd($sx);

        return response()->json(['success' => 'Poli deleted successfully.']);
    }
}
