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

class RstxnRjhdrsSlideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rstxn_rjhdrs = rstxnRjhdrs::latest()->get();

        return view('medis.rjslide', compact('rstxn_rjhdrs'), [
            'polis' => rsmstPoli::all(),
            'doctors' => rsmstDoctor::all(),
            'klaims' => rsmstKlaimType::all(),
            'noRj' => RstxnRjhdrsSlideController::myRjno(),
            'autodate' => RstxnRjhdrsSlideController::autodate()
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
            'rj_date_step3' => 'required',
            'reg_no_step3' => 'required',
            'poli_id_step3' => 'required',
            'dr_id_step3' => 'required',
            'klaim_id_step3' => 'required',
        ];

        //   @dd($request->myMethod);
        if ($request->myMethod == 'create') {
            $myRules['rj_no_step3'] = 'required|unique:rstxn_rjhdrs|max:25|min:1';
        } else if ($request->myMethod == 'edit') {
            $myRules['rj_no_step3'] = 'max:25|min:1';
        }

        $request->validate($myRules);

        $myPrimer = ['rj_no' => $request->rj_no_step3];

        $myData = [
            'rj_date' => $request->rj_date_step3,
            'reg_no' => $request->reg_no_step3,
            'poli_id' => $request->poli_id_step3,
            'dr_id' => $request->dr_id_step3,
            'klaim_id' => $request->klaim_id_step3,
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

    public function autofillrjonline(Request $request)
    {
        $auto = $request->input('reg_no');
        $nik = $request->input('nik_bpjs');

        $pasien = rsmstPasien::where('reg_no', $auto)
            ->where('nik_bpjs', $nik)
            ->first();

        if (!$pasien) {
            return response()->json(['data' => '0']);
        } else {
            return response()->json($pasien);
        }
    }

    public function autodate()
    {
        $autodate = Carbon::now();

        return $autodate;
    }
}
