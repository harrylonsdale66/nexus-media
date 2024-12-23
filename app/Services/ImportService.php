<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Order;

class ImportService
{
    public ShopifyService $shopifyService;

    public function __construct(ShopifyService $shopifyService)
    {
        $this->shopifyService = $shopifyService;
    }

    /**
     * @return int
     */
    public function importCustomers(): int
    {
        $customers = $this->shopifyService->getCustomers();
        if(count($customers)) {
            Customer::truncate();
            foreach ($customers as $customer) {
                Customer::create([
                    'external_id' => $customer['id'] ?? null,
                    'first_name' => $customer['first_name'],
                    'last_name' => $customer['last_name'],
                    'email' => $customer['email']
                ]);
            }
        }
        return count($customers);
    }

    /**
     * @return int
     */
    public function importOrders(): int
    {
        $orders = $this->shopifyService->getOrders();
        if(count($orders)) {
            Order::truncate();
            foreach ($orders as $order) {
                Order::create([
                    'external_id' => $order['id'],
                    'customer_id' => $order['customer']['id'] ?? null,
                    'financial_status' => $order['financial_status'],
                    'fulfillment_status' => $order['fulfillment_status'],
                    'total_price' => $order['total_price'],
                ]);
            }
        }
        return count($orders);
    }
}
