<?php

namespace App\Services;

use App\Entities\Pessoa;
use App\Repositories\PessoaRepository;
use App\Services\ValidatorService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class PessoaService implements PessoaServiceInterface
{
    /**
     * @var PessoaRepository
     */
    private $pessoaRepo;
    private $validateService;

    public function __construct(PessoaRepository $pessoaRepository, ValidatorService $validatorService)
    {
        $this->pessoaRepo = $pessoaRepository;
        $this->validateService = $validatorService;
    }

    /**
     * @inheritDoc
     */
    public function find(int $id): ?Model
    {
        return $this->pessoaRepo->find($id);
    }

    /**
     * @inheritDoc
     */
    public function all(): ?Collection
    {
        return $this->pessoaRepo->all();
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): ?Model
    {
        $this->validateService->validateCpfOrFail($data['cpf']);
        $this->validateService->validateCepOrFail($data['cep']);
        return $this->pessoaRepo->create($data);
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): ?bool
    {
        return $this->pessoaRepo->delete($id);
    }

    /**
     * @inheritDoc
     */
    public function update(array $data, int $id): ?Model
    {
        if(isset($data['cpf'])){
            $this->validateService->validateCpfOrFail($data['cpf']);
            $this->validateCpfAlreadyExists($data['cpf'], $id);
        }
        if(isset($data['cep'])){
            $this->validateService->validateCepOrFail($data['cep']);
        }
        return $this->pessoaRepo->update($data, $id);
    }

    private function validateCpfAlreadyExists(string $cpf, int $id){
        $people = Pessoa::where('id', '!=', $id)->get();
        $subset = $people->map(function ($pessoa) {
            return collect($pessoa->toArray())
                ->only(['cpf'])
                ->all();
        });
        foreach($subset as $pessoaCpf){
            if($pessoaCpf['cpf'] === $cpf){
                throw new \Exception('Cpf already registered in another pessoa', 409);
            };
        }
    }
}
