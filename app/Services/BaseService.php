<?php

namespace App\Services;

use App\Repositories\BaseRepository;

class BaseService
{
    protected $repository;

    public function __construct(BaseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function listar(string $orderBy = null)
    {
        return $this->repository->FindAll($orderBy);
    }

    public function obter($id)
    {
        return $this->repository->find($id);
    }

    public function criar(array $dados)
    {
        return $this->repository->create($dados);
    }

    public function alterar($id, array $dados)
    {
        $registro = $this->repository->find($id);
        $registro->update($dados);
        return $registro;
    }

    public function excluir($id)
    {
        return $this->repository->find($id)->delete();
    }
}
