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
     * @return void
     */
    public function importCustomers(): void
    {
        $data = $this->shopifyService->getCustomers();
        if(isset($data['customers']) && count($data['customers'])) {
            Customer::truncate();
            foreach ($data['customers'] as $customer) {
                Customer::create([
                    'external_id' => $customer['id'] ?? null,
                    'first_name' => $customer['first_name'],
                    'last_name' => $customer['last_name'],
                    'email' => $customer['email']
                ]);
            }
        }
    }

    /**
     * @return void
     */
    public function importOrders(): void
    {
        $data = $this->shopifyService->getOrders();
        if(isset($data['orders']) && count($data['orders'])) {
            Order::truncate();
            foreach ($data['orders'] as $order) {
                Order::create([
                    'external_id' => $order['id'],
                    'customer_id' => $order['customer']['id'] ?? null,
                    'financial_status' => $order['financial_status'],
                    'fulfillment_status' => $order['fulfillment_status'],
                    'total_price' => $order['total_price'],
                ]);
                if(isset($order['customer'])) {
                    Customer::firstOrCreate([
                        'external_id' => $order['customer']['id'],
                    ],[
                        'external_id' => $order['customer']['id'] ?? null,
                        'first_name' => $order['customer']['first_name'] ?? null,
                        'last_name' => $order['customer']['last_name'] ?? null,
                        'email' => $order['customer']['email'] ?? null,
                    ]);
                }
            }
        }
    }
}
