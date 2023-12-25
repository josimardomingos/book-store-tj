<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Validators\LivroValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

use const App\Traits\RESPONSE_BAD_REQUEST;
use const App\Traits\RESPONSE_CREATED;
use const App\Traits\RESPONSE_NOT_ACCEPTABLE;

class LivroController extends Controller
{
    /**
     *  @OA\Get(
     *     tags={"Livros"},
     *     path="/livros",
     *     summary="Listar todos os livros",
     *     @OA\Response(
     *          response="200",
     *          description="successful",
     *          @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Livro")
     *          ),
     *      ),
     * )
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $livros = Livro::all();
        return $this->success($livros);
    }

    /**
     *  @OA\Get(
     *     tags={"Livros"},
     *     path="/livros/{id}",
     *     summary="Mostrar detalhes de um livro específico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="successful",
     *          @OA\JsonContent(ref="#/components/schemas/Livro")
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $livro = Livro::findOrFail($id);
        return $this->success($livro);
    }

    /**
     * @OA\Post(
     *     tags={"Livros"},
     *     path="/livros",
     *     summary="Criar um novo livro",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Livro")
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="successful",
     *          @OA\JsonContent(ref="#/components/schemas/Livro")
     *      ),
     * )
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $livroValidator = new LivroValidator($request->all());

            if (!$livroValidator->validate()) {
                return $this->alert($livroValidator->errors());
            }

            $valid_data = $livroValidator->validated();
            $livro = Livro::create($valid_data);

            if (Arr::has($valid_data, 'autores')) {
                $livro->autores()->sync($valid_data['autores']);
            }

            if (Arr::has($valid_data, 'assuntos')) {
                $livro->assuntos()->sync($valid_data['assuntos']);
            }

            return $this->success($livro, __('livro.create'), RESPONSE_CREATED);
        } catch (\Throwable $err) {
            return $this->error($err->getMessage(), RESPONSE_BAD_REQUEST);
        }
    }

    /**
     * @OA\Put(
     *     tags={"Livros"},
     *     path="/livros/{id}",
     *     summary="Atualizar os dados de um livro",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Livro")
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="successful",
     *          @OA\JsonContent(ref="#/components/schemas/Livro")
     *      ),
     * )
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $livroValidator = new LivroValidator(array_merge($request->all(), ['id' => $id]));

            if (!$livroValidator->validate()) {
                return $this->alert($livroValidator->errors());
            }

            $valid_data = $livroValidator->validated();

            $livro = Livro::findOrFail($id);
            $livro->update($valid_data);

            if (Arr::has($valid_data, 'autores')) {
                $livro->autores()->sync($valid_data['autores']);
            }

            if (Arr::has($valid_data, 'assuntos')) {
                $livro->assuntos()->sync($valid_data['assuntos']);
            }

            return $this->success($livro, __('livro.update'));
        } catch (\Throwable $err) {
            return $this->error($err->getMessage(), RESPONSE_BAD_REQUEST);
        }
    }

    /**
     * @OA\Delete(
     *     tags={"Livros"},
     *     path="/livros/{id}",
     *     summary="Excluir um livro",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *          response="204",
     *          description="successful",
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $livro = Livro::findOrFail($id);
            $livro->delete();
            return $this->no_content();
        } catch (\Throwable $err) {
            return $this->error($err->getMessage(), RESPONSE_BAD_REQUEST);
        }
    }
}
