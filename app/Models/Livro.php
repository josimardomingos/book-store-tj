<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @OA\Schema(
 *     schema="Livro",
 *     type="object",
 *     title="Livro",
 *     @OA\Property(property="codl", type="integer", example="17"),
 *     @OA\Property(property="titulo", type="string", example="Titulo de teste"),
 *     @OA\Property(property="editora", type="string", example="Editora de teste"),
 *     @OA\Property(property="edicao", type="integer", example="2"),
 *     @OA\Property(property="anopublicacao", type="integer", example="2023"),
 *     @OA\Property(property="valor", type="number", example="20.00"),
 *     @OA\Property(
 *          property="autores",
 *          type="array",
 *          @OA\Items(ref="#/components/schemas/Autor")
 *     ),
 *     @OA\Property(
 *          property="assuntos",
 *          type="array",
 *          @OA\Items(ref="#/components/schemas/Assunto")
 *     ),
 * )
 */
class Livro extends Model
{
    use HasFactory;

    protected $table = 'livro';
    protected $primaryKey = 'codl';

    protected $fillable = [
        'titulo',
        'editora',
        'edicao',
        'anopublicacao',
        'valor',
    ];

    // protected $with = ['autores', 'assuntos'];

    public function autores(): BelongsToMany
    {
        return $this->belongsToMany(Autor::class, 'livro_autor', 'livro_codl', 'autor_codau');
    }

    public function assuntos(): BelongsToMany
    {
        return $this->belongsToMany(Assunto::class, 'livro_assunto', 'livro_codl', 'assunto_codas');
    }
}
