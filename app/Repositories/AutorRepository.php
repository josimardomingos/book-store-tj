<?php

namespace App\Repositories;

use App\Models\Autor;

final class AutorRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new Autor());
    }
}
