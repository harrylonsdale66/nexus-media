<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class CurlService
{

    /**
     * @param string $url
     * @param array $headers
     * @return array
     */
    public function get(string $url, array $headers): array
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        if($headers){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $headerText = substr($response, 0, $headerSize);
        $body = substr($response, $headerSize);

        if ($httpCode !== 200) {
            die("Error: HTTP $httpCode\n$body");
        }

        $headersOut = [];
        foreach (explode("\r\n", $headerText) as $headerLine) {
            if (str_contains($headerLine, ": ")) {
                [$key, $value] = explode(": ", $headerLine, 2);
                $headersOut[$key] = trim($value);
            }
        }
        curl_close($ch);
        return [
            'headers' => $headersOut,
            'body' => json_decode($body, true)
        ];
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
