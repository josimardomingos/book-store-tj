<?php

namespace App\Services;

use App\Repositories\LivroRepository;
use App\Validators\LivroValidator;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

class LivroService extends BaseService
{
    public function __construct(LivroRepository $livroRepository)
    {
        parent::__construct($livroRepository);
    }

    public function criar(array $dados)
    {
        $valid_data = $this->validarCampos($dados);

        $livro = parent::criar($valid_data);

        if (Arr::has($valid_data, 'autores')) {
            $livro->autores()->sync($valid_data['autores']);
        }

        if (Arr::has($valid_data, 'assuntos')) {
            $livro->assuntos()->sync($valid_data['assuntos']);
        }

        return $livro;
    }

    public function alterar($livroId, array $dados)
    {
        $valid_data = $this->validarCampos($dados);

        $livro = parent::alterar($livroId, $valid_data);

        if (Arr::has($valid_data, 'autores')) {
            $livro->autores()->sync($valid_data['autores']);
        }

        if (Arr::has($valid_data, 'assuntos')) {
            $livro->assuntos()->sync($valid_data['assuntos']);
        }

        return $livro;
    }

    protected function validarCampos(array $dados)
    {
        $livroValidator = new LivroValidator($dados);

        if (!$livroValidator->validate()) {
            throw ValidationException::withMessages($livroValidator->errors()->toArray());
        }

        return $livroValidator->validated();
    }
}
