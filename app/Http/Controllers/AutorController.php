<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Validators\AutorValidator;
use Illuminate\Http\Request;

use const App\Traits\RESPONSE_BAD_REQUEST;
use const App\Traits\RESPONSE_CREATED;

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
        $autores = Autor::orderBy('nome')->get();
        return $this->success($autores);
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
        return $this->success($autor);
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
        try {
            $autorValidator = new AutorValidator($request->all());

            if (!$autorValidator->validate()) {
                return $this->alert($autorValidator->errors());
            }

            $valid_data = $autorValidator->validated();

            $autor = Autor::create($valid_data);
            return $this->success($autor, __('autor.create'), RESPONSE_CREATED);
        } catch (\Throwable $err) {
            return $this->error($err->getMessage(), RESPONSE_BAD_REQUEST);
        }
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
        try {
            $autorValidator = new AutorValidator($request->all());

            if (!$autorValidator->validate()) {
                return $this->alert($autorValidator->errors());
            }

            $valid_data = $autorValidator->validated();

            $autor = Autor::findOrFail($id);
            $autor->update($valid_data);
            return $this->success($autor, __('autor.update'));
        } catch (\Throwable $err) {
            return $this->error($err->getMessage(), RESPONSE_BAD_REQUEST);
        }
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
        try {
            $autor = Autor::findOrFail($id);
            $autor->delete();
            return $this->no_content();
        } catch (\Throwable $err) {
            return $this->error($err->getMessage(), RESPONSE_BAD_REQUEST);
        }
    }
}
