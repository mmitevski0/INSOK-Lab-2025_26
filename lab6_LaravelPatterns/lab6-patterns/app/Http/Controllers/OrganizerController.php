<?php

namespace App\Http\Controllers;

use App\Repositories\OrganizerRepositoryInterface;
use App\Http\Requests\Organizer\OrganizerStoreRequest;
use App\Http\Requests\Organizer\OrganizerUpdateRequest;
use App\Models\Organizer;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\OrganizerResource;

class OrganizerController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected OrganizerRepositoryInterface $organizerRepository;

    public function __construct(OrganizerRepositoryInterface $organizerRepository){
        $this->organizerRepository = $organizerRepository;
    }

    public function index(): AnonymousResourceCollection
    {
        $organizers = $this->organizerRepository->all();

        return OrganizerResource::collection($organizers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Factory|Application
    {
        return view('organizers/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): OrganizerResource
    {
        $data = $request->all();
        $organizer = $this->organizerRepository->create($data);

        return OrganizerResource::make($organizer);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): OrganizerResource
    {
        $organizer = $this->organizerRepository->find($id);

        return OrganizerResource::make($organizer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Organizer $organizer): View|Factory|Application
    {
        return view('organizers/edit', compact('organizer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): OrganizerResource
    {
        $data = $request->all();
        $organizer = $this->organizerRepository->find($id);
        $organizer = $this->organizerRepository->update($organizer, $data);

        return OrganizerResource::make($organizer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $organizer = $this->organizerRepository->find($id);
        $this->organizerRepository->delete($id);

        return response()->json(null, 204);
    }
}
