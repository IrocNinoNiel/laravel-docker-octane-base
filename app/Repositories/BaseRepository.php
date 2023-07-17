<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements RepositoryInterface
{
    public function __construct(protected Model $model)
    {
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function paginate(int $perPage = 10, array $columns = ['*']): mixed
    {
        return $this->model->paginate($perPage, $columns);
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id, $attribute = 'id'): Model
    {
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    public function delete(string $id): int
    {
        return $this->model->destroy($id);
    }

    public function findById(string $id, $columns = ['*']): Model
    {
        return $this->model->find($id, $columns);
    }

    public function findBy(string $attribute, $value, $columns = ['*']): Collection
    {
        return $this->model->where($attribute, '=', $value)->first($columns);
    }
}
