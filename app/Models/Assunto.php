<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Assunto",
 *     type="object",
 *     title="Assunto",
 *     @OA\Property(property="codas", type="integer", example="7"),
 *     @OA\Property(property="descricao", type="string", example="Descrição do assunto"),
 * )
 */
class Assunto extends Model
{
    protected $table = 'assunto';
    protected $primaryKey = 'codas';

    protected $fillable = [
        'descricao',
    ];
}
