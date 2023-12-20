<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    protected $table = 'autor';
    protected $primaryKey = 'codau';

    protected $fillable = [
        'nome',
    ];
}
