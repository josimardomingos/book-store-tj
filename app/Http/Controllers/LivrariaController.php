<?php

namespace App\Http\Controllers;

use App\Models\Livraria;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;

class LivrariaController extends Controller
{
    function relatorio(Request $request)
    {
        $livraria = Livraria::all();

        $data = [
            'titulo' => config('app.name'),
            'data' => date('Y_m_d_-_H_i_s'),
            'livraria' => $livraria,
        ];

        if ($request->has('download')) {
            $pdf = PDF::loadView('pdf', compact('data'));
            $pdf->setPaper('a4', 'landscape');
            return $pdf->download(sprintf('%s_%s.pdf', $data['data'], $data['titulo']));
        }
        return view('pdf', compact('data'));
    }
}
