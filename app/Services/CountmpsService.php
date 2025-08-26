<?php

namespace App\Services;

use App\Models\Count;
use App\Helpers\Helper;

class CountmpsService
{
    /**
     * Menghitung parameter-parameter Bioflux MBR.
     *
     * @param float $COD
     * @param float $BOD
     * @param float $TSS
     * @param float $flow (m³/h)
     * @return array
     */
    public function calculate($COD, $BOD, $TSS, $flow, $uid, $system_name)
    {
        $constants = [
            'mc' => 0.80,
            'TSS_removal' => 90.4,
            'o_tipe' => 24,
        ];

        $tssRemove = $TSS * $constants['TSS_removal'] / 100;
        $tssOutput = $TSS - $tssRemove;

        $xiActual = ($TSS * $flow) / 1000;
        $xiActualHourly = $xiActual / $constants['o_tipe'];

        $xr = ($tssRemove * $flow) / 1000;
        $xrHourly = $xr / $constants['o_tipe'];

        $xo = ($tssOutput * $flow) / 1000;
        $xoHourly = $xo / $constants['o_tipe'];

        $ssyT = (1 / (1 - $constants['mc'])) * $xiActual;
        $qf = $flow - ($ssyT / 1000);
        $qss = $flow - $qf;

        $mps_types = [
            'FMP-101' => [5, 7],
            'FMP-102' => [6, 10],
            'FMP-131' => [6, 12],
            'FMP-132' => [12, 24],
            'FMP-201' => [15, 20],
            'FMP-202' => [30, 40],
            'FMP-203' => [45, 60],
            'FMP-301' => [50, 70],
            'FMP-302' => [100, 140],
            'FMP-303' => [150, 210],
            'FMP-304' => [200, 280],
            'FMP-401' => [130, 160],
            'FMP-402' => [260, 320],
            'FMP-403' => [390, 480],
            'FMP-404' => [520, 640],
        ];

        $xiActualHourly = (int) round($xiActualHourly);
        $selected_mps = [];
        $closest_mps = null;
        $closest_distance = null;

        foreach ($mps_types as $type => $range) {
            $min = $range[0];
            $max = $range[1];

            if ($xiActualHourly >= $min && $xiActualHourly <= $max) {
                // Jika dalam range, tambahkan langsung
                $selected_mps[] = $type;
            } else {
                // Hitung jarak terdekat ke batas bawah/atas
                $distance = min(abs($xiActualHourly - $min), abs($xiActualHourly - $max));

                // Simpan yang paling dekat
                if ($closest_distance === null || $distance < $closest_distance) {
                    $closest_distance = $distance;
                    $closest_mps = $type;
                }
            }
        }

        // Jika tidak ada yang dalam range, gunakan yang paling dekat
        if (empty($selected_mps) && $closest_mps !== null) {
            $selected_mps[] = $closest_mps;
        }
        
        $calculation = [
            'result_calculate_id' => $uid,
            'system_name'         => $system_name,
            'bod'                 => $BOD,
            'cod'                 => $COD,
            'tss'                 => $TSS,
            'q_flowrate'          => $flow,
            'tss_remove'          => Helper::decimalNumber($tssRemove),
            'tss_output'          => Helper::decimalNumber($tssOutput),
            'xi_actual'           => Helper::decimalNumber($xiActual),
            'xi_actual_hourly'    => Helper::decimalNumber($xiActualHourly),
            'xr'                  => Helper::decimalNumber($xr),
            'xr_hourly'           => Helper::decimalNumber($xrHourly),
            'xo'                  => Helper::decimalNumber($xo),
            'xo_hourly'           => Helper::decimalNumber($xoHourly),
            'ssy_t'               => Helper::decimalNumber($ssyT),
            'qf'                  => Helper::decimalNumber($qf),
            'qss'                 => Helper::decimalNumber($qss),
            'recommended_mps'     => $selected_mps,
        ];

        return $calculation;
    }
}
