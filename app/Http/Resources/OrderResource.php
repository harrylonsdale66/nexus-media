<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       return [
            'customer_name' => ($this->customer->first_name ?? '–') . ' ' . ($this->customer->last_name ?? ''),
            'customer_email' => $this->customer->email ?? '–',
            'total_price' => $this->total_price ?? '–',
            'financial_status' => $this->financial_status ?? '–',
            'fulfillment_status' => $this->fulfillment_status ?? '–'
       ];
    }
}
