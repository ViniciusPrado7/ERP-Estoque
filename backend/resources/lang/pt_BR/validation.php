<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    */

    'accepted'             => 'O campo :attribute deve ser aceito.',
    'active_url'           => 'O campo :attribute não é uma URL válida.',
    'after'                => 'O campo :attribute deve ser uma data posterior a :date.',
    'alpha'                => 'O campo :attribute pode conter apenas letras.',
    'alpha_dash'           => 'O campo :attribute pode conter letras, números, traços e underscores.',
    'array'                => 'O campo :attribute deve ser um array.',
    'before'               => 'O campo :attribute deve ser uma data anterior a :date.',
    'between'              => [
        'numeric' => 'O campo :attribute deve estar entre :min e :max.',
        'file'    => 'O campo :attribute deve ter entre :min e :max kilobytes.',
        'string'  => 'O campo :attribute deve ter entre :min e :max caracteres.',
        'array'   => 'O campo :attribute deve ter entre :min e :max itens.',
    ],
    'boolean'              => 'O campo :attribute deve ser verdadeiro ou falso.',
    'confirmed'            => 'A confirmação do :attribute não coincide.',
    'date'                 => 'O campo :attribute não é uma data válida.',
    'date_format'          => 'O campo :attribute não corresponde ao formato :format.',
    'different'            => 'Os campos :attribute e :other devem ser diferentes.',
    'digits'               => 'O campo :attribute deve ter :digits dígitos.',
    'digits_between'       => 'O campo :attribute deve ter entre :min e :max dígitos.',
    'email'                => 'O campo :attribute deve ser um e-mail válido.',
    'filled'               => 'O campo :attribute é obrigatório.',
    'exists'               => 'O :attribute selecionado é inválido.',
    'image'                => 'O campo :attribute deve ser uma imagem.',
    'in'                   => 'O :attribute selecionado é inválido.',
    'integer'              => 'O campo :attribute deve ser um número inteiro.',
    'ip'                   => 'O campo :attribute deve ser um IP válido.',
    'max'                  => [
        'numeric' => 'O campo :attribute não pode ser maior que :max.',
        'file'    => 'O campo :attribute não pode ter mais que :max kilobytes.',
        'string'  => 'O campo :attribute não pode ter mais que :max caracteres.',
        'array'   => 'O campo :attribute não pode ter mais que :max itens.',
    ],
    'mimes'                => 'O campo :attribute deve ser um arquivo do tipo: :values.',
    'min'                  => [
        'numeric' => 'O campo :attribute deve ser pelo menos :min.',
        'file'    => 'O campo :attribute deve ter pelo menos :min kilobytes.',
        'string'  => 'O campo :attribute deve ter pelo menos :min caracteres.',
        'array'   => 'O campo :attribute deve ter pelo menos :min itens.',
    ],
    'numeric'              => 'O campo :attribute deve ser um número.',
    'present'              => 'O campo :attribute deve estar presente.',
    'regex'                => 'O formato do campo :attribute é inválido.',
    'required'             => 'O campo :attribute é obrigatório.',
    'required_if'          => 'O campo :attribute é obrigatório quando :other for :value.',
    'required_with'        => 'O campo :attribute é obrigatório quando :values estiver presente.',
    'required_without'     => 'O campo :attribute é obrigatório quando :values não estiver presente.',
    'same'                 => 'Os campos :attribute e :other devem ser iguais.',
    'size'                 => [
        'numeric' => 'O campo :attribute deve ter :size.',
        'file'    => 'O campo :attribute deve ter :size kilobytes.',
        'string'  => 'O campo :attribute deve ter :size caracteres.',
        'array'   => 'O campo :attribute deve conter :size itens.',
    ],
    'string'               => 'O campo :attribute deve ser uma string.',
    'timezone'             => 'O campo :attribute deve ser uma zona válida.',
    'unique'               => 'O :attribute já está em uso.',
    'url'                  => 'O formato do :attribute é inválido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | Aqui você faz o mapeamento de nomes de campo para rótulos amigáveis.
    |
    */

    'attributes' => [
        'nome' => 'nome do produto',
        'preco_venda' => 'preço de venda',
        'fornecedor' => 'fornecedor',
        'cliente' => 'cliente',
        'produtos.*.id' => 'produto',
        'produtos.*.quantidade' => 'quantidade',
        'produtos.*.preco_unitario' => 'preço unitário',
    ],

];
