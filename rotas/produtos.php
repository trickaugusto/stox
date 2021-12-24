<?php

$ctrl = Stox\Controllers\ProdutosController::class;

$auth->get('/home', "$ctrl::home");
$auth->get('/produtos', "$ctrl::produtos");

$auth->get('/produtos/cadastrar', "$ctrl::cadastrar");
$auth->post('/produtos/add', "$ctrl::add");

$auth->get('/produtos/retirar/{id}', "$ctrl::retirar");

$auth->get('/produtos/alterar/{id}', "$ctrl::alterar");
$auth->match('/produtos/update/{id}', "$ctrl::update")
        ->method('GET|POST');

$auth->get('/produtos/delete/{id}', "$ctrl::delete");

$auth->get('/relatorio', "$ctrl::relatorio");

unset($ctrl);