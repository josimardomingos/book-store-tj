<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    /**
     *  @OA\Get(
     *     tags={"Autores"},
     *     path="/autores",
     *     summary="Listar todos os autores",
     *     @OA\Response(
     *          response="200",
     *          description="successful",
     *          @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Autor")
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
        $autores = Autor::all();
        return response()->json($autores);
    }

    /**
     *  @OA\Get(
     *     tags={"Autores"},
     *     path="/autores/{id}",
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
     *          @OA\JsonContent(ref="#/components/schemas/Autor")
     *      ),
     * )
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $autor = Autor::findOrFail($id);
        return response()->json($autor);
    }

    /**
     * @OA\Post(
     *     tags={"Autores"},
     *     path="/autores",
     *     summary="Criar um novo autor",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Autor")
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="successful",
     *          @OA\JsonContent(ref="#/components/schemas/Autor")
     *      ),
     * )
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $autor = Autor::create($request->all());
        return response()->json($autor, 201);
    }

    /**
     * @OA\Put(
     *     tags={"Autores"},
     *     path="/autores/{id}",
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
     *         @OA\JsonContent(ref="#/components/schemas/Autor")
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="successful",
     *          @OA\JsonContent(ref="#/components/schemas/Autor")
     *      ),
     * )
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $autor = Autor::findOrFail($id);
        $autor->update($request->all());
        return response()->json($autor, 200);
    }

    /**
     * @OA\Delete(
     *     tags={"Autores"},
     *     path="/autores/{id}",
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
        $autor = Autor::findOrFail($id);
        $autor->delete();
        return response()->json(null, 204);
    }
}
