<?php

namespace App\Http\Controllers\Pic;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Target;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PicController extends Controller
{
    //
    // public $productService;
    
    // public function __construct(ProductService $productService)
    // {
    //     $this->productService = $productService;
    // }
    //
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        //
        
        // dd($products);

        $picId = auth()->id();

        // Hitung jumlah customer unik yang dihandle PIC ini
        $totalCustomers = Order::where('pic_id', $picId)
            ->distinct('user_id')
            ->count('user_id');
            
        return view('dashboard', compact(
            'totalCustomers'
        ));
    }

    public function getSales()
    {
        // Mengambil total penjualan per hari yang ditangani oleh PIC yang sedang login
        $totalSalesPerDay = Order::select(
                DB::raw('DATE(created_at) as date'), 
                DB::raw('SUM(total_price) as total_sales'))
                ->where('status', 'completed')
                ->where('pic_id', Auth::id()) // PIC yang sedang login
                ->groupBy('date')
                ->orderBy('date', 'desc')
                ->get();

        // Format data sesuai kebutuhan
        $formattedSales = $totalSalesPerDay->map(function ($item) {
            return [
                'date' => $item->date,
                'value' => (int) $item->total_sales,
            ];
        });

        return response()->json($formattedSales);
                
    }

    
    public function getRevenuePic(Request $request)
    {

        // dd('test');
        // PIC yang dipilih dari dropdown (kalau kosong, default ID PIC 4)
        $picId = auth()->id();
        $year  = $request->input('year', now()->year);

        $monthNames = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];

        // === Ambil Target ===
        $targets = Target::where('pic_id', $picId)
            ->where('year', $year)
            ->pluck('target', 'month'); 
            // hasil: [1 => 50000000, 2 => 60000000, ...]

        // === Ambil Prospek Omzet (semua order) ===
        $prospek = Order::selectRaw('MONTH(created_at) as month, SUM(total_price) as total')
            ->where('pic_id', $picId)
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->pluck('total', 'month');
            // hasil: [1 => 10000000, 2 => 20000000, ...]

        // === Ambil Goal (hanya order complete) ===
        $goals = Order::selectRaw('MONTH(created_at) as month, SUM(total_price) as total')
            ->where('pic_id', $picId)
            ->whereYear('created_at', $year)
            ->where('status', 'completed')
            ->groupBy('month')
            ->pluck('total', 'month');

        // === Gabungkan per bulan ===
        $result = collect(range(1, 12))->map(function($m) use ($monthNames, $targets, $prospek, $goals) {
            return [
                'month'   => $monthNames[$m],
                'target'  => $targets[$m] ?? 0,
                'prospek' => $prospek[$m] ?? 0,
                'goal'    => $goals[$m] ?? 0,
            ];
        });

        return response()->json($result);
    }
    

    public function byDate($date)
    {

        $orders = Order::whereDate('created_at', $date)
                ->where('status', 'completed')
                ->get();
        // balikin HTML partial (biar bisa langsung masuk modal)
        $html = view('pic._list', compact('orders'))->render();
        return response()->json(['html' => $html]);
    }

}
