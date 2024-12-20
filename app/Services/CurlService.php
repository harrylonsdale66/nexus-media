<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class CurlService
{

    /**
     * @param $url
     * @return array
     */
    public function get($url): array
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        if(curl_errno($ch)) {
            Log::error('cURL error: ' . curl_error($ch));
        }
        curl_close($ch);
        return json_decode($response, true);
    }

    /**
     * @param $url
     * @param $data
     * @return array
     */
    public function post($url, $data): array
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        if(curl_errno($ch)) {
            Log::error('cURL error: ' . curl_error($ch));
        }
        curl_close($ch);
        return json_decode($response, true);
    }
}
