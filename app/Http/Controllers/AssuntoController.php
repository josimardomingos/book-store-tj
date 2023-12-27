<?php

namespace App\Http\Controllers;

use App\Models\Assunto;
use App\Validators\AssuntoValidator;
use Illuminate\Http\Request;

use const App\Traits\RESPONSE_BAD_REQUEST;
use const App\Traits\RESPONSE_CREATED;

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
        $assuntos = Assunto::orderBy('descricao')->get();
        return $this->success($assuntos);
    }

    /**
     *  @OA\Get(
     *     tags={"Assuntos"},
     *     path="/assuntos/{id}",
     *     summary="Mostrar detalhes de um assunto específico",
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
        $assunto = Assunto::findOrFail($id);
        return $this->success($assunto);
    }

    /**
     * @OA\Post(
     *     tags={"Assuntos"},
     *     path="/assuntos",
     *     summary="Criar um novo assunto",
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
        try {
            $assuntoValidator = new AssuntoValidator($request->all());

            if (!$assuntoValidator->validate()) {
                return $this->alert($assuntoValidator->errors());
            }

            $valid_data = $assuntoValidator->validated();

            $assunto = Assunto::create($valid_data);

            return $this->success($assunto, __('assunto.create'), RESPONSE_CREATED);
        } catch (\Throwable $err) {
            return $this->error($err->getMessage(), RESPONSE_BAD_REQUEST);
        }
    }

    /**
     * @OA\Put(
     *     tags={"Assuntos"},
     *     path="/assuntos/{id}",
     *     summary="Atualizar os dados de um assunto",
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
        try {
            $assuntoValidator = new AssuntoValidator(array_merge($request->all(), ['id' => $id]));

            if (!$assuntoValidator->validate()) {
                return $this->alert($assuntoValidator->errors());
            }

            $valid_data = $assuntoValidator->validated();

            $assunto = Assunto::findOrFail($id);
            $assunto->update($valid_data);
            return $this->success($assunto, __('assunto.update'));
        } catch (\Throwable $err) {
            return $this->error($err->getMessage(), RESPONSE_BAD_REQUEST);
        }
    }

    /**
     * @OA\Delete(
     *     tags={"Assuntos"},
     *     path="/assuntos/{id}",
     *     summary="Excluir um assunto",
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
            $assunto = Assunto::findOrFail($id);
            $assunto->delete();
            return $this->no_content();
        } catch (\Throwable $err) {
            return $this->error($err->getMessage(), RESPONSE_BAD_REQUEST);
        }
    }
}
