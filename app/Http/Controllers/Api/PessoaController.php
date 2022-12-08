<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PessoaStoreRequest;
use App\Http\Requests\PessoaUpdateRequest;
use App\Services\PessoaServiceInterface;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class PessoaController extends Controller
{
    /**
     * @var PessoaServiceInterface
     */
    private $pessoaService;

    public function __construct(PessoaServiceInterface $pessoaService)
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
        $pessoa = $this->pessoaService->all();
        if ($pessoa) {
            return response()->json($pessoa, Response::HTTP_OK);
        }
        return response()->json($pessoa, Response::HTTP_BAD_REQUEST);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

     public function cepValidation($cep) {
        echo "$cep";
      }

    public function store(PessoaStoreRequest $request)
    {
        DB::beginTransaction();
        $pessoa = $this->pessoaService->create($request->validated());
        if ($pessoa) {

            DB::commit();
            return response()->json($pessoa, Response::HTTP_OK);
        }

        DB::rollBack();
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
            return response()->json($pessoa, Response::HTTP_OK);
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
        DB::beginTransaction();
        $pessoa = $this->pessoaService->update($request->validated(), $id);
        if ($pessoa) {

            DB::commit();
            return response()->json($pessoa, Response::HTTP_OK);
        }
        
        DB::rollBack();
        return response()->json($pessoa, Response::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pessoa = $this->pessoaService->delete($id);
        if ($pessoa) {
            return response()->json($pessoa, Response::HTTP_OK);
        }
        return response()->json($pessoa, Response::HTTP_BAD_REQUEST);
    }
}
