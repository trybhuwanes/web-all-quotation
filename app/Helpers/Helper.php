<?php

namespace App\Helpers;

use Carbon\Carbon;
use ReflectionClass;
use App\Enums\ShuDistributionStatus;
use Illuminate\Support\Facades\File;
use App\Models\SavingsAndLoan\MasterPph;
use Spatie\StructureDiscoverer\Discover;
use App\Models\SavingsAndLoan\TieringShu;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Broadcast;
use GuzzleHttp\Exception\ConnectException;
use App\Models\SavingsAndLoan\ShuDistribution;
use App\Models\SavingsAndLoan\ShuDistributionReserveSaving;
use App\Models\SavingsAndLoan\CalculationOfTieringShuSaving;

class Helper
{

    public static function dateFormat($date, $format = 'd F Y')
    {
        if (is_null($date)) {
            return '-';
        }

        if (! $date instanceof Carbon) {
            $date = Carbon::parse($date);
        }

        return $date->translatedFormat($format);
    }

    public static function numberFormat($number = 0, $decimals = 0, $currency = true)
    {
        return ($currency ? 'Rp' : '') . number_format($number, $decimals, ',', '.');
    }

    public static function decimalNumber($number, $decimals = 2) {
        return number_format($number, $decimals, '.', '');
    }

    public static function getQueries(Builder $builder)
    {
        $addSlashes = str_replace('?', "'?'", $builder->toSql());

        return vsprintf(str_replace('?', '%s', $addSlashes), $builder->getBindings());
    }

    public static function checkBroadcastChannel($channel)
    {
        try {
            $pusher   = Broadcast::driver('pusher')->getPusher();
            $response = $pusher->getChannelInfo($channel->name);

            return $response;
        } catch (\Throwable $th) {
            return $th instanceof ConnectException ? 'disconnected' : 'unoccupied';
        }
    }

    public static function roundingPerThousand($amount)
    {
        $amount = floor($amount / 1000) * 1000;

        return $amount;
    }

    public static function roundingPerHundred($amount)
    {
        $amount = round($amount / 100) * 100;

        return $amount;
    }

    public static function getModelList(): array
    {
        $models     = [];
        $modelsPath = app_path('Models');
        $modelFiles = File::allFiles($modelsPath);
        foreach ($modelFiles as $modelFile) {
            $models[] = 'App\Models\\' . str_replace('.php', '', $modelFile->getRelativePathname());
        }

        return $models;
    }


    public static function getMethodList($class)
    {
        $methods = (new ReflectionClass($class))->getMethods();
        $methods = collect($methods)->filter(function ($m) {
            return ! $m->isConstructor() && str_starts_with($m->name, 'get');
        })->values()->toArray();

        return $methods;
    }

    public static function splitRangeDate($dateRange)
    {
        try {
            if (! $dateRange) {
                return;
            }

            if ($dateRange && ! str_contains(urldecode($dateRange), 'to')) {
                $date = Carbon::parse($dateRange)->format('Y-m-d');

                return [$date, $date];
            }

            return collect(explode('to', urldecode($dateRange)))->transform(function ($item) {
                return trim($item);
            })->toArray();
        } catch (\Throwable $th) {
            return;
        }
    }

    public static function generateTransactionCode($model, string $transaction = '')
    {
        $getRowNumber     = $model::whereMonth('created_at', now()->format('m'))->whereYear('created_at', now()->format('Y'))->count();
        $sequence         = $getRowNumber + 1;
        $firstSegmentCode = str_pad($sequence, 5, '0', STR_PAD_LEFT) . '/';
        // $code             = ($model == Presensi::class ? now()->format('d/') : $firstSegmentCode) . now()->format('m/Y/') . $transaction;

        // return $code;
    }

    public static function handleEmptyVarCalculation($var)
    {
        return $var ? $var : 0;
    }

    public static function yesNoLabel($value)
    {
        $result['label'] = $value ? 'badge badge badge-light-primary fs-7 m-1' : 'badge badge badge-light-danger fs-7 m-1';
        $result['text']  = $value ? __('common.yes') : __('common.no');

        return $result;
    }

    // public static function set_active($route, $output = 'active')
    // {
    //     return request()->routeIs($route) ? $output : '';
    // }


}

// // Penempatan fungsi set_active di luar kelas Helper
// if (!function_exists('set_active')) {
    
// }
