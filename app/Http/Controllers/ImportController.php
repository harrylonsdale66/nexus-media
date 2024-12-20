<?php

namespace App\Http\Controllers;

use App\Services\ImportService;
use Illuminate\Http\RedirectResponse;

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
        $this->importService->importCustomers();
        $this->importService->importOrders();
        // обработку ошибок сделать не успел
        return redirect()->route('index')->with('success', 'Import done!');
    }
}
