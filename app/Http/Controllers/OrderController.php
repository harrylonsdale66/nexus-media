<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\ImportService;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    public ImportService $importService;

    public function __construct(ImportService $importService)
    {
        $this->importService = $importService;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $orders = Order::with('customer')->where('total_price', '>', 100)->get();
        return response()->json([
            'recordsTotal' => $orders->count(),
            'recordsFiltered' => $orders->count(),
            'data' => OrderResource::collection($orders),
        ]);
    }

}
