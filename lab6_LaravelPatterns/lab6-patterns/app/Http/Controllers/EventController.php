<?php

namespace App\Http\Controllers;

use App\Http\Requests\Event\EventStoreRequest;
use App\Http\Requests\Event\EventUpdateRequest;
use App\Http\Resources\OrganizerResource;
use App\Models\Event;
use App\Models\Organizer;
use App\Repositories\EventRepositoryInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\EventResource;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected EventRepositoryInterface $eventRepository;

    public function __construct(EventRepositoryInterface $eventRepository){
        $this->eventRepository = $eventRepository;
    }

    public function index(): AnonymousResourceCollection
    {
        $events = $this->eventRepository->all();

        return EventResource::collection($events);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Factory|Application
    {
        $organizers = Organizer::query()
            ->get();

        return view('events/create', compact('organizers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): EventResource
    {
        $data = $request->all();
        $event = $this->eventRepository->create($data);

        return EventResource::make($event);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): EventResource
    {
        $event = $this->eventRepository->find($id);

        return EventResource::make($event);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event): View|Factory|Application
    {
        $organizers = Organizer::query()
            ->get();

        return view('events/edit', compact('event', 'organizers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): EventResource
    {
        $data = $request->all();
        $event = $this->eventRepository->find($id);
        $event = $this->eventRepository->update($event, $data);

        return EventResource::make($event);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $event = $this->eventRepository->find($id);
        $this->eventRepository->delete($id);

        return response()->json(null, 204);
    }
}
