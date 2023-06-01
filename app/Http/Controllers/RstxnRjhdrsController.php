<?php

namespace App\Http\Controllers;

use App\Models\rsmstDoctor;
use App\Models\rsmstKlaimType;
use App\Models\rsmstPasien;
use App\Models\rsmstPoli;
use App\Models\rstxnRjhdrs;
use Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon;

class RstxnRjhdrsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rstxn_rjhdrs = rstxnRjhdrs::latest()->get();

        if ($request->ajax()) {
            $data = rstxnRjhdrs::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('poli_id', function ($data) {
                    return $data->poli->poli_desc;
                })
                ->editColumn('dr_id', function ($data) {
                    return $data->doctor->dr_name;
                })
                ->editColumn('klaim_id', function ($data) {
                    return $data->klaim->klaim_desc;
                })
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->rj_no . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editRj">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->rj_no . '" data-original-title="Hapus" class="btn btn-danger btn-sm deleteRj">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('medis.rawatjalan', compact('rstxn_rjhdrs'), [
            'polis' => rsmstPoli::all(),
            'doctors' => rsmstDoctor::all(),
            'klaims' => rsmstKlaimType::all(),
            'noRj' => RstxnRjhdrsController::myRjno(),
            'autodate' => RstxnRjhdrsController::autodate()
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
            'rj_date' => 'required',
            'reg_no' => 'required',
            'poli_id' => 'required',
            'dr_id' => 'required',
            'klaim_id' => 'required',
            'no_antrian' => 'required',
        ];

        //   @dd($request->myMethod);
        if ($request->myMethod == 'create') {
            $myRules['rj_no'] = 'required|unique:rstxn_rjhdrs|max:25|min:1';
        } else if ($request->myMethod == 'edit') {
            $myRules['rj_no'] = 'max:25|min:1';
        }

        $request->validate($myRules);
        $myPrimer = ['rj_no' => $request->rj_no];

        $myData = [
            'rj_date' => $request->rj_date,
            'reg_no' => $request->reg_no,
            'poli_id' => $request->poli_id,
            'dr_id' => $request->dr_id,
            'klaim_id' => $request->klaim_id,
            'no_antrian' => $request->no_antrian,
        ];
        rstxnRjhdrs::updateOrCreate($myPrimer, $myData);

        return response()->json(['success' => 'Rawat Jalan saved successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(rstxnRjhdrs $rstxnRjhdrs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($rj_no)
    {
        $rstxn_rjhdrs = rstxnRjhdrs::find($rj_no);
        return response()->json($rstxn_rjhdrs);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rstxnRjhdrs $rstxnRjhdrs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($rstxnRjhdrs)
    {
        rstxnRjhdrs::find($rstxnRjhdrs)->delete();

        // dd($sx);

        return response()->json(['success' => 'Rawat Jalan deleted successfully.']);
    }

    public function myRjno()
    {
        $maxReg = rstxnRjhdrs::count('rj_no') + 1;
        $noRj = sprintf("%06s", $maxReg);

        return $noRj;
    }

    // public function getRegno(Request $request)
    // {
    //     $search = $request->search;

    //     if ($search == '') {
    //         $pasiens = rsmstPasien::orderby('reg_no', 'asc')
    //             ->select('reg_no', 'reg_name', 'phone', 'address')
    //             ->get();
    //     } else {
    //         $pasiens = rsmstPasien::orderby('reg_no', 'asc')
    //             ->select('reg_no', 'reg_name', 'phone', 'address')
    //             ->where('reg_no', 'LIKE', '%' . $search . '%')
    //             ->get();
    //     }
    //     $response = array();
    //     foreach ($pasiens as $pasien) {
    //         $response[] = array(
    //             'reg_no' => $pasien->reg_no,
    //             'reg_name' => $pasien->reg_name,
    //             'phone' => $pasien->phone,
    //             'address' => $pasien->address
    //         );
    //     }
    //     return response()->json($response);
    // }

    public function getRegno(Request $request)
    {
        $search = $request->get('search');

        $pasien = rsmstPasien::where('reg_no', 'LIKE', '%' . $search . '%')
            ->orWhere('reg_name', 'LIKE', '%' . $search . '%')->orderBy('reg_name', 'asc')
            ->get();

        if (count($pasien) == 0) {
            return response()->json(['message' => 'No results found.'], 404);
        } else {
            return response()->json($pasien);
        }
    }

    // public function autofill(Request $request)
    // {
    //     $regno = $request->input('reg_no');

    //     $pasien = rsmstPasien::where('reg_no', $regno)
    //         ->first();

    //     return response()->json($pasien);
    // }

    // public function autofill($reg_no)
    // {
    //     $pasien = rsmstPasien::find($reg_no);

    //     return response()->json([
    //         'reg_name' => $pasien->reg_name,
    //         'phone' => $pasien->phone,
    //         'address' => $pasien->address
    //     ]);
    // }

    public function autodate()
    {
        $autodate = Carbon::now();

        return $autodate;
    }
}
