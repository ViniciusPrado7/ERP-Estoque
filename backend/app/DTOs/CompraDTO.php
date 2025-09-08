<?php

namespace App\DTOs;

class CompraDTO
{
    public string $fornecedor;
    public array $produtos;

    public function __construct(array $dados)
    {
        $this->fornecedor = $dados['fornecedor'];
        $this->produtos = $dados['produtos'];
    }
}
