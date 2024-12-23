<?php

namespace App\Http\Controllers;

use App\Services\ImportService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;

class ImportController extends Controller
{
    public ImportService $importService;
    public function __construct(ImportService $importService)
    {
        $this->importService = $importService;
    }

    /**
     * @return RedirectResponse
     */
    public function index(): RedirectResponse
    {
        Cache::forget('orders');
        $customersCount = $this->importService->importCustomers();
        $ordersCount = $this->importService->importOrders();
        return redirect()->route('index')->with('success', "Imported $customersCount customers and $ordersCount orders.");
    }
}
