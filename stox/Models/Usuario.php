<?php

namespace Stox\Models;

use Illuminate\Database\Capsule\Manager as DB;

class Usuario
{
    public $nome;
    public $email;
    protected $senha;
    
    public function __construct($nome, $email, $senha) 
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->setSenha($senha);
    }
    
    protected function table()
    {
        return DB::table('usuarios');
    }
    
    public function setSenha($senha)
    {
        $this->senha = password_hash($senha, PASSWORD_BCRYPT);
    }
    
    public function getSenha()
    {
        return $this->senha;
    }
    
    public function save()
    {
        return $this->table()->insert([
            'nome' => $this->nome,
            'email' => $this->email,
            'senha' => $this->senha
        ]);
    }
    
    public static function byEmail($email)
    {
        return DB::table('usuarios')
                ->where('email', '=', $email)
                ->first();
    }
}

