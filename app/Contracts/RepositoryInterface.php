<?php

declare(strict_types=1);

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function all(): Collection;

    public function paginate(int $perPage = 10, array $columns = ['*']): mixed;

    public function create(array $data): Model;

    public function update(array $data, $id, $attribute = 'id'): Model;

    public function delete(string $id): int;

    public function findById(string $id, $columns = ['*']): Model;

    public function findBy(string $attribute, $value, $columns = ['*']): Collection;
}
