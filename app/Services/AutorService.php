<?php

namespace App\Services;

use App\Repositories\AutorRepository;
use App\Validators\AutorValidator;
use Illuminate\Validation\ValidationException;

class AutorService extends BaseService
{
    public function __construct(AutorRepository $autorRepository)
    {
        parent::__construct($autorRepository);
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
        $autorValidator = new AutorValidator($dados);

        if (!$autorValidator->validate()) {
            throw ValidationException::withMessages($autorValidator->errors()->toArray());
        }

        return $autorValidator->validated();
    }
}
