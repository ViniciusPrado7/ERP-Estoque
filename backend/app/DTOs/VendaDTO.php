<?php

namespace App\DTOs;

class VendaDTO
{
    public string $cliente;
    public array $produtos; 

    public function __construct(array $dados)
    {
        $this->cliente = $dados['cliente'];
        $this->produtos = $dados['produtos'];
    }
}
