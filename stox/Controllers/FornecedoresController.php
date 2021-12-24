<?php
namespace Stox\Controllers;

use Stox\Models\Fornecedor;
use Silex\Application;

class FornecedoresController
{
    public function index()
    {
        $fornecedores = Fornecedor::all();
        return view()->render('fornecedores/index.twig', [
            'fornecedores' => $fornecedores
        ]);
    }
    
    public function add()
    {
        return view()->render('fornecedores/add.twig');
    }
    
    public function cadastrar(Application $app)
    {
        try {
            $forn = new Fornecedor;
            $forn->nome = $app['request']->request->get('nome');
            $forn->save();
            session()->set('success', 'Fornecedor cadastrado!');
            return $app->redirect(URL_AUTH . '/fornecedores');
        } catch (\Exception $exc) {
            return view()->render('fornecedores/add.twig', [
                'error' => $exc->getMessage()
            ]);
        }
    }
    
    public function delete(Application $app, $id)
    {
        if (!(int)$id) {
            session()->set('error', 'ID não informado');
            return $app->redirect(URL_AUTH . '/fornecedores');
        }
        (new Fornecedor)->delete($id);
        session()->set('success', 'Fornecedor excluido com sucesso');
        return $app->redirect(URL_AUTH . '/fornecedores');
    }
}
