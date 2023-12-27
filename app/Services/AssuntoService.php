<?php

namespace App\Services;

use App\Repositories\AssuntoRepository;
use App\Validators\AssuntoValidator;
use Illuminate\Validation\ValidationException;

class AssuntoService extends BaseService
{
    public function __construct(AssuntoRepository $assuntoRepository)
    {
        parent::__construct($assuntoRepository);
    }

    public function criar(array $dados)
    {
        $valid_data = $this->validarCampos($dados);

        $livro = parent::criar($valid_data);

        return $livro;
    }

    public function alterar($id, array $dados)
    {
        $valid_data = $this->validarCampos($dados);

        $livro = parent::alterar($id, $valid_data);

        return $livro;
    }

    protected function validarCampos(array $dados)
    {
        $assuntoValidator = new AssuntoValidator($dados);

        if (!$assuntoValidator->validate()) {
            throw ValidationException::withMessages($assuntoValidator->errors()->toArray());
        }

        return $assuntoValidator->validated();
    }
}
