<?php

namespace App\Http\Controllers;

use App\Services\LivroService;
use Illuminate\Http\Request;

use const App\Traits\RESPONSE_BAD_REQUEST;
use const App\Traits\RESPONSE_CREATED;

class LivroController extends Controller
{
    private $livroService;

    public function __construct(LivroService $livroService)
    {
        $this->livroService = $livroService;
    }

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
        $livros = $this->livroService->listar('titulo');
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
        $livro = $this->livroService->obter($id);
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
            $livro = $this->livroService->criar($request->all());

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
            $livro = $this->livroService->alterar($id, $request->all());

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
            $this->livroService->excluir($id);
            return $this->no_content();
        } catch (\Throwable $err) {
            return $this->error($err->getMessage(), RESPONSE_BAD_REQUEST);
        }
    }
}
