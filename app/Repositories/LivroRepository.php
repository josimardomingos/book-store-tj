<?php

namespace App\Repositories;

use App\Models\Livro;

final class LivroRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new Livro());
    }
}
