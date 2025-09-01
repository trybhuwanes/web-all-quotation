<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Target;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
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
        
        // $totalSalesPerPic = Order::with('pic:id,name') // Mengambil nama PIC
        // ->select('pic_id', DB::raw('SUM(total_price - discount_amount) as total_sales'))
        // ->where('status', 'completed')
        // ->groupBy('pic_id')
        // ->get();

        // Mengambil data total sales berdasarkan bulan dan tahun

        // === JUMLAH USER PER STATUS ===
        $usersStatusCount = User::select('status', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('status')
            ->pluck('jumlah', 'status')
            ->toArray();

        $totalUsers = array_sum($usersStatusCount);

        // === JUMLAH QUOTATION PER STATUS ===
        $rfqStatusCount = Order::select('status', DB::raw('COUNT(*) as jumlah'))
                        ->groupBy('status')
                        ->pluck('jumlah', 'status')
                        ->toArray();

        $totalRFQ = array_sum($rfqStatusCount);

        // === JUMLAH ORDER PER STATUS ===
        $orderStatusCount = Order::select('status', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('status')
            ->pluck('jumlah', 'status')
            ->toArray();

        $totalOrders = array_sum($orderStatusCount);

        $totalSalesPerPic = Order::with('pic:id,name')
            ->select('pic_id', 
                    DB::raw('YEAR(created_at) as year'), 
                    DB::raw('MONTH(created_at) as month'), 
                    DB::raw('SUM(total_price) as total_sales'))
            ->where('status', 'completed')
            ->groupBy('pic_id', 'year', 'month')
            ->get();
            
            $piclist = User::select('id', 'name')
                    ->where('role', 'pic')
                    ->where('status', 'active')
                    ->get();


        
        return view('dashboard', compact(
            'usersStatusCount',
            'piclist',
            'totalUsers',
            'rfqStatusCount',
            'totalRFQ',
            'orderStatusCount',
            'totalOrders',
            'totalSalesPerPic'));
    }

    public function getSales()
    {
        // Mengambil total penjualan per hari
        $totalSalesPerDay = Order::select(
                DB::raw('DATE(created_at) as date'), 
                DB::raw('SUM(total_price) as total_sales'))
                ->where('status', 'completed')
                ->groupBy('date')
                ->orderBy('date', 'desc')
                ->get();

        

        // Format data sesuai kebutuhan
        $formattedSales = $totalSalesPerDay->map(function ($item) {
            return [
                'date' => $item->date,
                'value' => (int) $item->total_sales, // pastikan total_sales dalam format integer
            ];
        });



        // Mengembalikan response dalam format JSON
        return response()->json($formattedSales);
                
    }


    public function getSalesPic()
    {
        // Mengambil total penjualan per hari
        $totalSalesPerPic = Order::with('pic:id,name') // Mengambil nama PIC
                ->select('pic_id', DB::raw('SUM(total_price) as total_sales'))
                ->where('status', 'completed')
                ->groupBy('pic_id')
                ->get();

        // Format data sesuai kebutuhan
        $formatSales = $totalSalesPerPic->map(function ($item) {
            return [
                'date' => $item->pic->name,
                'value' => (int) $item->total_sales, // pastikan total_sales dalam format integer
            ];
        });

        // Mengembalikan response dalam format JSON
        return response()->json($formatSales);
                
    }


    public function getOrderStatus(Request $request)
    {

        // Ambil data jumlah order per produk & status
        $orders = DB::table('orders')
            ->join('detail_orders', 'orders.id', '=', 'detail_orders.order_id')
            ->join('products', 'detail_orders.product_id', '=', 'products.id')
            ->select(
                'products.nama_produk as product',
                'orders.status',
                DB::raw('COUNT(detail_orders.id) as total')
            )
            ->groupBy('products.nama_produk', 'orders.status')
            ->get();

        // Definisikan status yang kamu gunakan
        $statuses = ['cancelled', 'pending', 'submission', 'processing', 'completed'];

        // Susun hasil supaya rapi (product => status => total)
        $products = $orders->pluck('product')->unique();

        $result = $products->map(function($product) use ($orders, $statuses) {
            $item = ['product' => $product];
            foreach ($statuses as $status) {
                $item[$status] = $orders->where('product', $product)
                                        ->where('status', $status)
                                        ->sum('total');
            }
            return $item;
        });

        return response()->json($result);
    }



    public function getRevenuePic(Request $request)
    {

        // dd('test');
        // PIC yang dipilih dari dropdown (kalau kosong, default ID PIC 4)
        $picId = $request->input('pic_id', 4);
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
            // hasil: [1 => 5000000, 2 => 15000000, ...]

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

}
