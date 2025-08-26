<?php

namespace App\Services;

use App\Models\Count;
use App\Helpers\Helper;

class CountfasService
{
    /**
     *
     * @param float $kedalaman (m)
     * @param float $panjang (m)
     * @param float $lebar (m)
     * @return array
     */
    public function calculate($kedalaman, $panjang, $lebar, $system_name)
    {
        $lebar = $lebar;
        $panjang = $panjang;
        $kedalaman = $kedalaman;

        $diameter = max($lebar, $panjang);

        $aerator_types = [
            'FAS 302' => ['D' => [2, 3], 'MZ' => 12],
            'FAS 303' => ['D' => [3, 4], 'MZ' => 18],
            'FAS 305' => ['D' => [3, 4], 'MZ' => 24],
            'FAS 307' => ['D' => [3, 4], 'MZ' => 32],
            'FAS 310' => ['D' => [3, 4], 'MZ' => 38],
            'FAS 315' => ['D' => [3, 4], 'MZ' => 54],
            'FAS 320' => ['D' => [3, 4], 'MZ' => 64],
            'FAS 325' => ['D' => [3, 4], 'MZ' => 72],
            'FAS 330' => ['D' => [3, 4], 'MZ' => 80],
            'FAS 340' => ['D' => [5, 6], 'MZ' => 90],
            'FAS 350' => ['D' => [5, 6], 'MZ' => 100],
            'FAS 360' => ['D' => [5, 6], 'MZ' => 112],
            'FAS 375' => ['D' => [5, 6], 'MZ' => 125],
            'FAS 3100' => ['D' => [5, 6], 'MZ' => 140],
        ];

        $selected_aerator = null;

        foreach ($aerator_types as $type => $details) {
            if ($kedalaman >= $details['D'][0] && $kedalaman <= $details['D'][1]) {
                if ($diameter <= $details['MZ']) {
                    $selected_aerator = $type;
                    break;
                }
            }
        }

        if ($selected_aerator === null) {
            $selected_aerator = 'FAS 303';  
        }
        
        $calculation = [
            'panjang'         => $panjang,
            'kedalaman'       => $kedalaman,
            'lebar'           => $lebar,
            'recommended_fas' => $selected_aerator,
        ];

        return $calculation;
    }
}
