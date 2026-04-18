<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Resources\StatisticsResource;
use App\Http\Resources\TicketResource;
use App\Services\TicketService;
use Illuminate\Http\JsonResponse;

class TicketController extends Controller
{
    public function __construct(private TicketService $ticketService) {}

    public function store(StoreTicketRequest $request): JsonResponse
    {
        $data = $request->validated();

        if ($this->ticketService->isLimitReached($data['phone'], $data['email'])) {
            return response()->json(['message' => 'Ліміт , 1 заявка на день',], 429);
        }

        $ticket = $this->ticketService->create($data);

        return response()->json(new TicketResource($ticket), 201);
    }

    public function statistics(): JsonResponse
    {
        return response()->json($this->ticketService->getStatistics());
    }
}
