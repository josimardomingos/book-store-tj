<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use Illuminate\Http\Request;

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
        return response()->json($livros);
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
        return response()->json($livro);
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
        $livro = Livro::create($request->all());
        return response()->json($livro, 201);
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
        $livro = Livro::findOrFail($id);
        $livro->update($request->all());
        return response()->json($livro, 200);
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
        $livro = Livro::findOrFail($id);
        $livro->delete();
        return response()->json(null, 204);
    }
}
