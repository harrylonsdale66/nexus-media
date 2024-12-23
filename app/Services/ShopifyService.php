<?php

namespace App\Services;

class ShopifyService
{
    private string $apiUrl;
    private string $apiKey;
    public CurlService $curlService;

    public function __construct(CurlService $curlService)
    {
        $this->apiUrl = config('shopify.api_url');
        $this->apiKey = config('shopify.api_key');
        $this->curlService = $curlService;
    }

    /**
     * @param array $fields
     * @param int $limit
     * @return array
     */
    public function getCustomers(array $fields = ['id', 'first_name', 'last_name', 'email'], int $limit = 250): array
    {
        $data = [];
        $url = $this->apiUrl . "/customers.json?" . http_build_query([
            'limit' => $limit,
            'fields' => implode(',', $fields)
        ]);

        do {
            $nextUrl = null;
            $response = $this->curlService->get(
                $url,
                ["X-Shopify-Access-Token: {$this->apiKey}"]
            );
            $data = array_merge($data, $response['body']['customers']);

            if (!empty($response['headers']['link'])) {
                if (preg_match('/<([^>]+)>;\s*rel="next"/', $response['headers']['link'], $matches)) {
                    $nextUrl = $matches[1];
                }
            }
            $url = $nextUrl;
        } while ($url);

        return $data;
    }


    /**
     * @param array $fields
     * @param string $status
     * @param int $limit
     * @return array
     */
    public function getOrders(array $fields = ['id', 'financial_status', 'fulfillment_status', 'total_price', 'customer'], string $status = 'any', int $limit = 250): array
    {
        $data = [];
        $url = $this->apiUrl . "/orders.json?" . http_build_query([
            'limit' => $limit,
            'status' => $status,
            'fields' => implode(',', $fields)
        ]);

        do {
            $nextUrl = null;
            $response = $this->curlService->get(
                $url,
                ["X-Shopify-Access-Token: {$this->apiKey}"]
            );
            $data = array_merge($data, $response['body']['orders']);

            if (!empty($response['headers']['link'])) {
                if (preg_match('/<([^>]+)>;\s*rel="next"/', $response['headers']['link'], $matches)) {
                    $nextUrl = $matches[1];
                }
            }
            $url = $nextUrl;
        } while ($url);

        return $data;
    }

}
