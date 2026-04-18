<?php

namespace App\Services;

use App\Models\Ticket;
use App\Repositories\CustomerRepository;
use App\Repositories\TicketRepository;
use Illuminate\Support\Carbon;

class TicketService
{
    public function __construct(
        private TicketRepository $ticketRepository,
        private CustomerRepository $customerRepository,
    ) {}

    public function create(array $data): Ticket
    {
        $customer = $this->customerRepository->firstOrCreate(
            ['email' => $data['email']],
            [
                'name' => $data['name'],
                'phone' => $data['phone'],
            ]
        );

        $ticket = $this->ticketRepository->create([
            'customer_id' => $customer->id,
            'subject' => $data['subject'],
            'body' => $data['body'],
            'status' => 'new',
        ]);

        $ticket->load('customer');

        return $ticket;
    }

    public function isLimitReached(string $phone, string $email): bool
    {
        return $this->ticketRepository->existsTodayByPhoneOrEmail($phone, $email);
    }

    public function getStatistics(): array
    {
        $now = Carbon::now();

        return [
            'day' => $this->ticketRepository->countByDay($now->copy()),
            'week' => $this->ticketRepository->countByWeek($now->copy()),
            'month' => $this->ticketRepository->countByMonth($now->copy()),
        ];
    }
}