<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PessoaStoreRequest;
use App\Http\Requests\PessoaUpdateRequest;
use App\Services\PessoaService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PessoaController extends Controller
{
    /**
     * @var PessoaService
     */
    private $pessoaService;

    public function __construct(PessoaService $pessoaService)
    {
        $this->pessoaService = $pessoaService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $people = $this->pessoaService->all();
            return response()->json(['sucess' => true, 'payload' => $people], Response::HTTP_OK);
        } catch (\Exception $err) {
            return response()->json(['sucess' => false, 'message' => $err->getMessage()], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PessoaStoreRequest $request)
    {
        $pessoa = $this->pessoaService->create($request->all());
        if ($pessoa) {
            return response()->json(['sucess' => true, 'message' => 'Pessoa created successfully!', 'payload' => $pessoa], Response::HTTP_CREATED);
        }
        return response()->json($pessoa, Response::HTTP_BAD_REQUEST);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $pessoa = $this->pessoaService->find($id);
            return response()->json(['sucess' => true, 'payload' => $pessoa], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json(['sucess' => false, 'message' => "Person with ID $id not found!"], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PessoaUpdateRequest $request, $id)
    {
        $this->pessoaService->find($id);

        $pessoaUpdate = $this->pessoaService->update($request->all(), $id);

        return response()->json(['sucess' => true, 'message' => 'Pessoa updated successfully', 'payload' => $pessoaUpdate], Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->pessoaService->delete($id);
        return response()->json(['sucess' => true, 'message' => 'Person deleted with ID ' . $id], Response::HTTP_OK);
    }
}
