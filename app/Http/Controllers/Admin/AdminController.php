<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Target;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

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
    public function dashboard(Request $request)
    {
        $startDate = $request->start_date;
        $endDate   = $request->end_date;

        $usersQuery  = User::query()->where('role', '!=', 'admin');
        $ordersQuery = Order::query();

        if ($startDate && $endDate) {
            $usersQuery->whereBetween('created_at', [$startDate, $endDate]);
            $ordersQuery->whereBetween('created_at', [$startDate, $endDate]);
        }

        $usersStatusCount = $usersQuery->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $totalUsers = array_sum($usersStatusCount);

        $rfqStatusCount = $ordersQuery->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $totalRFQ = array_sum($rfqStatusCount);

        // === JUMLAH ORDER PER STATUS ===
        $orderStatusCount = (clone $ordersQuery)->select('status', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('status')
            ->pluck('jumlah', 'status')
            ->toArray();
        $totalOrders = array_sum($orderStatusCount);

        $totalSalesPerPic = (clone $ordersQuery)
            ->with('pic:id,name')
            ->select(
                'pic_id',
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total_price) as total_sales')
            )
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
            'rfqStatusCount',
            'totalRFQ',
            'orderStatusCount',
            'totalOrders',
            'totalSalesPerPic'
        ));
    }

    public function getSales()
    {
        // Mengambil total penjualan per hari
        $totalSalesPerDay = Order::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total_price) as total_sales')
        )
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

    public function getSalesPic(Request $request)
    {
        $query = Order::with('pic:id,name')
            ->select('pic_id', DB::raw('SUM(total_price) as total_sales'))
            ->where('status', 'completed');

        // Filter bulan
        if ($request->start_date && $request->end_date) {
            $start = Carbon::parse($request->start_date)->startOfMonth();
            $end   = Carbon::parse($request->end_date)->endOfMonth();
            $query->whereBetween('created_at', [$start, $end]);
        }

        $totalSalesPerPic = $query->groupBy('pic_id')->get();

        $formatSales = $totalSalesPerPic->map(function ($item) {
            return [
                'date'  => $item->pic->name,
                'value' => (int) $item->total_sales,
            ];
        });

        return response()->json($formatSales);
    }


    public function getOrderStatus(Request $request)
    {
        $startMonth = $request->input('start_date');
        $endMonth   = $request->input('end_date');

        $ordersQuery = DB::table('orders')
            ->join('detail_orders', 'orders.id', '=', 'detail_orders.order_id')
            ->join('products', 'detail_orders.product_id', '=', 'products.id');

        // Filter bulan kalau ada input
        if ($startMonth && $endMonth) {
            $start = \Carbon\Carbon::parse($startMonth)->startOfMonth();
            $end   = \Carbon\Carbon::parse($endMonth)->endOfMonth();

            $ordersQuery->whereBetween('orders.created_at', [$start, $end]);
        }

        $orders = $ordersQuery
            ->select(
                'products.nama_produk as product',
                'orders.status',
                DB::raw('COUNT(detail_orders.id) as total')
            )
            ->groupBy('products.nama_produk', 'orders.status')
            ->get();

        $statuses = ['cancelled', 'pending', 'submission', 'processing', 'completed'];

        $products = $orders->pluck('product')->unique();

        $result = $products->map(function ($product) use ($orders, $statuses) {
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
        $picId = $request->input('pic_id', 4);
        $year  = $request->input('year', now()->year);

        $startMonth = $request->input('start_date');
        $endMonth   = $request->input('end_date');

        $monthNames = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        // === Ambil Target ===
        $targets = Target::where('pic_id', $picId)
            ->where('year', $year)
            ->pluck('target', 'month');

        // === Ambil Prospek Omzet ===
        $prospek = Order::selectRaw('MONTH(created_at) as month, SUM(total_price) as total')
            ->where('pic_id', $picId)
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->pluck('total', 'month');

        // === Ambil Goal ===
        $goals = Order::selectRaw('MONTH(created_at) as month, SUM(total_price) as total')
            ->where('pic_id', $picId)
            ->whereYear('created_at', $year)
            ->where('status', 'completed')
            ->groupBy('month')
            ->pluck('total', 'month');

        // === Tentukan range bulan ===
        $start = $startMonth ? (int) \Carbon\Carbon::parse($startMonth)->format('m') : 1;
        $end   = $endMonth ? (int) \Carbon\Carbon::parse($endMonth)->format('m') : 12;

        // === Gabungkan per bulan hanya di range ===
        $result = collect(range($start, $end))->map(function ($m) use ($monthNames, $targets, $prospek, $goals) {
            return [
                'month'   => $monthNames[$m],
                'target'  => $targets[$m] ?? 0,
                'prospek' => $prospek[$m] ?? 0,
                'goal'    => $goals[$m] ?? 0,
            ];
        });

        return response()->json($result);
    }

    public function getOrdersByDate(Request $request)
    {
        $picId = $request->pic_id;
        [$year, $month] = explode('-', $request->month);

        $orders = Order::where('pic_id', $picId)
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();

        $html = view('admin._list', compact('orders'))->render();

        return response()->json(['html' => $html]);
    }
}
