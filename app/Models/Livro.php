<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Livro",
 *     type="object",
 *     title="Livro",
 *     @OA\Property(property="codl", type="integer", example="17"),
 *     @OA\Property(property="titulo", type="string", example="Titulo de teste"),
 *     @OA\Property(property="editora", type="string", example="Editora de teste"),
 *     @OA\Property(property="edicao", type="integer", example="2"),
 *     @OA\Property(property="anopublicacao", type="integer", example="2023")
 * )
 */
class Livro extends Model
{
    protected $table = 'livro';
    protected $primaryKey = 'codl';

    protected $fillable = [
        'titulo',
        'editora',
        'edicao',
        'anopublicacao',
    ];
}
