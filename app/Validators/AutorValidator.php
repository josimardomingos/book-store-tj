<?php

namespace App\Validators;

class AutorValidator extends BaseValidator
{
    public function rules()
    {
        // $id = array_key_exists('id', $this->data) ? $this->data['id'] : '';
        return [
            // 'titulo' => ['required', 'string', 'min:3', 'max:40', 'unique:livro,titulo' . ($id ? ",$id" : '')],
            // 'titulo' => ['required', 'string', 'min:3', 'max:40', 'unique:livro,titulo'],
            'nome' => ['required', 'string', 'min:3', 'max:40'],
        ];
    }
}
