<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        $alexey = Customer::where('email', 'alexey@gmail.com')->first();
        $misha = Customer::where('email', 'misha@gmail.com')->first();
        $stepan = Customer::where('email', 'stepan@gmail.com')->first();

        $tickets = [
            [
                'customer_id' => $alexey->id,
                'subject' => 'проблема з доставкою',
                'body' => 'де замовлення',
                'status' => 'new',
                'manager_response_at' => null,
            ],
            [
                'customer_id' => $alexey->id,
                'subject' => 'проблема з оплатою',
                'body' => 'не прохожить оплата',
                'status' => 'in_progress',
                'manager_response_at' => null,
            ],
            [
                'customer_id' => $misha->id,
                'subject' => 'консультацію',
                'body' => 'потрібна консультація ',
                'status' => 'processed',
                'manager_response_at' => now(),
            ],
            [
                'customer_id' => $stepan->id,
                'subject' => 'проблема з якістю товару',
                'body' => 'товар не не якісний',
                'status' => 'new',
                'manager_response_at' => null,
            ],
            [
                'customer_id' => $stepan->id,
                'subject' => 'сео не виконуть свою роботу',
                'body' => 'погана робота сео',
                'status' => 'processed',
                'manager_response_at' => now()->subDays(2),
            ],
        ];

        foreach ($tickets as $data) {
            Ticket::create($data);
        }
    }
}