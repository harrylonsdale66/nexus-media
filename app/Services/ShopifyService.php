<?php

namespace App\Services;

class ShopifyService
{
    private string $apiUrl = 'https://099252c5f4bc43cd5d673f94338cb992:807c8caaf04ae7a79d863297769747a5@shortcodesdev.myshopify.com';
    public CurlService $curlService;

    public function __construct(CurlService $curlService)
    {
        $this->curlService = $curlService;
    }

    /**
     * @param array $fields
     * @return array
     */
    public function getCustomers(array $fields = ['id', 'first_name', 'last_name', 'email']): array
    {
        return $this->curlService->get($this->apiUrl . '/admin/customers.json?fields=' . implode(',', $fields));
    }

    /**
     * @param array $fields
     * @return array
     */
    public function getOrders(array $fields = ['id', 'financial_status', 'fulfillment_status', 'total_price', 'customer']): array
    {
        return $this->curlService->get($this->apiUrl . '/admin/orders.json?fields=' . implode(',', $fields));
    }

}
