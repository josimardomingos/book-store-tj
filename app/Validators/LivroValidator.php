<?php

namespace App\Validators;

class LivroValidator extends BaseValidator
{
    public function rules()
    {
        // $id = array_key_exists('id', $this->data) ? $this->data['id'] : '';
        return [
            // 'titulo' => ['required', 'string', 'min:3', 'max:40', 'unique:livro,titulo' . ($id ? ",$id" : '')],
            'titulo' => ['required', 'string', 'min:3', 'max:40', 'unique:livro,titulo'],
            'editora' => ['required', 'string', 'min:3', 'max:40'],
            'edicao' => ['required', 'integer'],
            'anopublicacao' => ['required', 'string', 'size:4'],
            'valor' => ['required', 'numeric'],
            'autores' => ['array'],
            'assuntos' => ['array'],
        ];
    }
}
