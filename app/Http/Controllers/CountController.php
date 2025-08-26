<?php

namespace App\Http\Controllers;

use App\Services\CountmpsService;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Services\CountfasService;

class CountController extends Controller
{
    protected $countmpsService;
    protected $countfasService;

    public function __construct(CountmpsService $countmpsService, CountfasService $countfasService,)
    {
        $this->countmpsService = $countmpsService;
        $this->countfasService = $countfasService;
    }

    public function count(Request $request)
    {

        $kedalaman = $request->input('kedalaman');
        $panjang = $request->input('panjang');
        $lebar = $request->input('lebar');

        $result_calculate_id = $request->input('uid');
        $system_name = $request->input('system_name');
        $COD = $request->input('cod'); 
        $BOD = $request->input('bod');
        $TSS = $request->input('tss');
        $flow = $request->input('q_flowrate');

        if ($kedalaman) {
            $result = $this->countfasService->calculate($kedalaman, $panjang, $lebar, $system_name);
        }

        elseif ($COD) {
            $result = $this->countmpsService->calculate($COD, $BOD, $TSS, $flow, $result_calculate_id, $system_name);
        } else {
            
            return response()->json([
                'message' => 'Kedalaman atau COD harus diisi.',
                'data' => null
            ], 400); 
        }

        return response()->json([
            'message' => 'Perhitungan berhasil!',
            'data' => $result
        ]);
    }

}
