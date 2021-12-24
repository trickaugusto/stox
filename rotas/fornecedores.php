<?php

// $auth é montada na url "auth/.." será adicionado verificação de autenticidade
// em todas todas pertencentes a $auth

// Retorna string completa do namespace e classe
$ctrl = Stox\Controllers\FornecedoresController::class;

$auth->get('fornecedores', "$ctrl::index");
$auth->get('fornecedores/add', "$ctrl::add");
$auth->post('fornecedores/cadastrar', "$ctrl::cadastrar");
$auth->get('fornecedores/delete/{id}', "$ctrl::delete");

unset($ctrl);
