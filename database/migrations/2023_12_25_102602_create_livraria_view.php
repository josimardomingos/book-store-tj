<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("CREATE OR REPLACE VIEW vLivraria AS
            SELECT
                autor.nome
                , livro.titulo, livro.editora, livro.edicao, livro.anopublicacao, livro.valor
                , GROUP_CONCAT(descricao ORDER BY descricao SEPARATOR ', ') assuntos
            FROM autor
            LEFT JOIN livro_autor la
                ON la.autor_codau = autor.codau
            LEFT JOIN livro
                ON livro.codl = la.livro_codl
            LEFT JOIN livro_assunto la2
                ON la2.livro_codl = livro.codl
            LEFT JOIN assunto a2
                ON a2.codas = la2.assunto_codas
            GROUP BY 1,2,3,4,5,6
            ORDER BY autor.nome, livro.titulo
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP VIEW book_store.vlivraria;');
    }
};
