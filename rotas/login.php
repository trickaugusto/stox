<?php

$ctrl = Stox\Controllers\LoginController::class;

$app->get('/', "$ctrl::index");
$app->get('/login/cadastrar', "$ctrl::cadastrar");
$app->post('/login/save', "$ctrl::save");
$app->post('/login/verify', "$ctrl::login");

unset($ctrl);