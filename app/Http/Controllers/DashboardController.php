<?php

namespace App\Http\Controllers;

use App\Models\Assunto;
use App\Models\Autor;
use App\Models\Livro;

class DashboardController extends Controller
{
    public function index()
    {
        $counts = [
            "livros" => Livro::count(),
            "autores" => Autor::count(),
            "assuntos" => Assunto::count()
        ];
        return $this->success($counts);
    }
}
