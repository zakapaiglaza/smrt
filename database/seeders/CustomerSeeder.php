<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            ['name' => 'Алексей', 'phone' => '+380991112233', 'email' => 'alexey@gmail.com'],
            ['name' => 'Михаил', 'phone' => '+380992223344', 'email' => 'misha@gmail.com'],
            ['name' => 'Стэпан', 'phone' => '+380993334455', 'email' => 'stepan@gmail.com'],
        ];

        foreach ($customers as $data) {
            Customer::firstOrCreate(['email' => $data['email']], $data);
        }
    }
}