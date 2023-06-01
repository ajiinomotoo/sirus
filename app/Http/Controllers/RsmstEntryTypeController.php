<?php

namespace App\Http\Controllers;

use App\Models\rsmstEntryType;
use Illuminate\Http\Request;
use DataTables;

class RsmstEntryTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rsmst_entrytypes = rsmstEntryType::latest()->get();

        if ($request->ajax()) {
            $data = rsmstEntryType::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->entry_id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editEntry">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->entry_id . '" data-original-title="Hapus" class="btn btn-danger btn-sm deleteEntry">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('medis.entrytype', compact('rsmst_entrytypes'));
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
            'entry_desc' => 'required|max:255'
        ];

        //   @dd($request->myMethod);
        if ($request->myMethod == 'create') {
            $myRules['entry_id'] = 'required|unique:rsmst_entrytypes|max:25|min:1';
        } else if ($request->myMethod == 'edit') {
            $myRules['entry_id'] = 'required|max:25|min:1';
        }

        $request->validate($myRules);

        $myPrimer = ['entry_id' => $request->entry_id];
        $myData = ['entry_desc' => $request->entry_desc];
        rsmstEntryType::updateOrCreate($myPrimer, $myData);

        return response()->json(['success' => 'created successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(rsmstEntryType $rsmstEntryType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($entry_id)
    {
        $rsmst_entrytypes = rsmstEntryType::find($entry_id);
        return response()->json($rsmst_entrytypes);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rsmstEntryType $rsmstEntryType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($rsmstEntryType)
    {
        rsmstEntryType::find($rsmstEntryType)->delete();

        // dd($sx);

        return response()->json(['success' => 'Entrytype deleted successfully.']);
    }
}
