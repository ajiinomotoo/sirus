<?php

namespace App\Http\Controllers;

use App\Models\rsmstPasien;
use App\Models\rstxnRjhdrs;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RjslideController extends Controller
{
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

    public function myRjno()
    {
        $maxReg = rstxnRjhdrs::count('rj_no') + 1;
        $noRj = sprintf("%06s", $maxReg);

        return $noRj;
    }

    public function autodate()
    {
        $autodate = Carbon::now();

        return $autodate;
    }
}
