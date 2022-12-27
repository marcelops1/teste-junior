<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PessoaStoreRequest;
use App\Http\Requests\PessoaUpdateRequest;
use App\Services\PessoaService;
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
        $people = $this->pessoaService->all();
        if ($people) {
            return response()->json(['sucess' => true, 'payload' => $people], Response::HTTP_OK);
        }
        return response()->json($people, Response::HTTP_NOT_FOUND);
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
        $pessoa = $this->pessoaService->find($id);
        if ($pessoa) {
            return response()->json(['sucess' => true, 'payload' => $pessoa], Response::HTTP_OK);
        }
        return response()->json($pessoa, Response::HTTP_BAD_REQUEST);
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
