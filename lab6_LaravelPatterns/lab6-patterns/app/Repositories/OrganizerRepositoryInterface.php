<?php

namespace App\Repositories;

use App\Models\Organizer;
use Illuminate\Database\Eloquent\Collection;

interface OrganizerRepositoryInterface
{
    public function all(): Collection;

    public function find(int $id): Organizer;

    public function create(array $data): Organizer;

    public function update(Organizer $order, array $data): Organizer;

    public function delete(Organizer $order): bool;
}
