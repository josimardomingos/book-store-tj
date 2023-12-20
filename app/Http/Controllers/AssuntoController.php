<?php

namespace App\Http\Controllers;

use App\Models\Assunto;
use App\Models\Autor;
use Illuminate\Http\Request;

class AssuntoController extends Controller
{
    /**
     *  @OA\Get(
     *     tags={"Assuntos"},
     *     path="/assuntos",
     *     summary="Listar todos os assuntos",
     *     @OA\Response(
     *          response="200",
     *          description="successful",
     *          @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Assunto")
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
        $assuntos = Assunto::all();
        return response()->json($assuntos);
    }

    /**
     *  @OA\Get(
     *     tags={"Assuntos"},
     *     path="/assuntos/{id}",
     *     summary="Mostrar detalhes de um autor específico",
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
     *          @OA\JsonContent(ref="#/components/schemas/Assunto")
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $autor = Assunto::findOrFail($id);
        return response()->json($autor);
    }

    /**
     * @OA\Post(
     *     tags={"Assuntos"},
     *     path="/assuntos",
     *     summary="Criar um novo autor",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Assunto")
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="successful",
     *          @OA\JsonContent(ref="#/components/schemas/Assunto")
     *      ),
     * )
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $autor = Assunto::create($request->all());
        return response()->json($autor, 201);
    }

    /**
     * @OA\Put(
     *     tags={"Assuntos"},
     *     path="/assuntos/{id}",
     *     summary="Atualizar os dados de um autor",
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
     *         @OA\JsonContent(ref="#/components/schemas/Assunto")
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="successful",
     *          @OA\JsonContent(ref="#/components/schemas/Assunto")
     *      ),
     * )
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $autor = Assunto::findOrFail($id);
        $autor->update($request->all());
        return response()->json($autor, 200);
    }

    /**
     * @OA\Delete(
     *     tags={"Assuntos"},
     *     path="/assuntos/{id}",
     *     summary="Excluir um autor",
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
        $autor = Assunto::findOrFail($id);
        $autor->delete();
        return response()->json(null, 204);
    }
}
