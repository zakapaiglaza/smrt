<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateTicketStatusRequest;
use App\Repositories\TicketRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TicketController extends Controller
{
    public function __construct(private TicketRepository $ticketRepository) {}

    public function index(Request $request): View
    {
        $filters = $request->only(['status', 'date', 'email', 'phone']);
        $tickets = $this->ticketRepository->getFiltered($filters);

        return view('admin.tickets.index', compact('tickets', 'filters'));
    }

    public function show(int $id): View
    {
        $ticket = $this->ticketRepository->findById($id);

        return view('admin.tickets.show', compact('ticket'));
    }

    public function updateStatus(UpdateTicketStatusRequest $request, int $id): RedirectResponse
    {
        $ticket = $this->ticketRepository->findById($id);
        $this->ticketRepository->updateStatus($ticket, $request->status);

        return redirect()->back()->with('success', 'Статус оновлено.');
    }
}
