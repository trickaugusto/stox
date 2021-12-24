<?php
namespace Stox\Controllers;

use Silex\Application;
use Stox\Models\Usuario;
use Stox\Auth\BaseAuth;

class LoginController
{
    public function index()
    {
        return view()->render('login/login.twig', [
            'token' => BaseAuth::tokenGen()
        ]);
    }
    
    public function cadastrar()
    {
        return view()->render('login/cadastrar.twig');
    }

    public function save(Application $app)
    {
        $req = $app['request']->request;

        $nome = $req->get('nome');
        $email = $req->get('email');
        $senha = $req->get('senha');

        $usuario = new Usuario($nome, $email, $senha);

        if ($usuario->save()) {
            session()->set('success', 'Usuario cadastrado com sucesso');
            return $app->redirect(URL_BASE . '/login/cadastrar');
        }

        session()->set('error', 'Erro ao cadastrar usuario');
        return $app->redirect(URL_BASE . '/login/cadastrar');
    }
    
    public function login(Application $app)
    {
        // Obj req que pega valores do POST
        $req = $app['request']->request;
        $auth = new BaseAuth;
        
        // Anti CSRF
        if (false === $auth->tokenVerify($req->get('_token'))) {
            return $app->redirect(URL_BASE);
        }
        
        if ($auth->login($req->get('email'), $req->get('senha'))) {
            $auth->grant();
            return $app->redirect(URL_AUTH . '/home');
        }
        
        session()->set('error', 'Usuário ou senha inválido');
        return $app->redirect(URL_BASE);
    }
}

