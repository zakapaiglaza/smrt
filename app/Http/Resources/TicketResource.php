<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'subject' => $this->subject,
            'body' => $this->body,
            'status' => $this->status,
            'manager_response_at' => $this->manager_response_at,
            'created_at' => $this->created_at,
            'customer' => [
                'name' => $this->customer->name,
                'phone' => $this->customer->phone,
                'email' => $this->customer->email,
            ],
        ];
    }
}
