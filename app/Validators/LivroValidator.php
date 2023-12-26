<?php

namespace App\Validators;

class LivroValidator extends BaseValidator
{
    public function rules()
    {
        // $id = array_key_exists('id', $this->data) ? $this->data['id'] : '';
        return [
            // 'titulo' => ['required', 'string', 'min:3', 'max:40', 'unique:livro,titulo' . ($id ? ",$id" : '')],
            // 'titulo' => ['required', 'string', 'min:3', 'max:40', 'unique:livro,titulo'],
            'titulo' => ['required', 'string', 'min:3', 'max:40'],
            'editora' => ['string', 'min:3', 'max:40'],
            'edicao' => ['integer'],
            'anopublicacao' => ['string', 'size:4'],
            'valor' => ['numeric'],
            'autores' => ['array'],
            'assuntos' => ['array'],
        ];
    }
}
