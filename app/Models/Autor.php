<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @OA\Schema(
 *     schema="Autor",
 *     type="object",
 *     title="Autor",
 *     @OA\Property(property="codau", type="integer", example="12"),
 *     @OA\Property(property="nome", type="string", example="Autor de teste"),
 * )
 */
class Autor extends Model
{
    use HasFactory;

    protected $table = 'autor';
    protected $primaryKey = 'codau';

    protected $fillable = [
        'nome',
    ];

    public function livros(): BelongsToMany
    {
        return $this->belongsToMany(Livro::class, 'livro_autor', 'autor_codau', 'livro_codl');
    }
}
