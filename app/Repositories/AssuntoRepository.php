<?php

namespace App\Repositories;

use App\Models\Assunto;

final class AssuntoRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new Assunto());
    }
}
