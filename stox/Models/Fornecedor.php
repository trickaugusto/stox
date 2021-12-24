<?php

namespace Stox\Models;

use Illuminate\Database\Capsule\Manager as DB;

class Fornecedor
{
    public function table()
    {
        return DB::table('fornecedores');
    }
    
    public static function all()
    {
        return DB::table('fornecedores')
                ->orderBy('id')
                ->get();
    }
    
    public function save()
    {
        $this->validate();
        return $this->table()->insert([
            'nome' => $this->nome
        ]);
    }
    
    public function validate()
    {
        if (empty($this->nome)) {
            throw new \Exception('Nome vazio!', 500);
        }
    }
    
    public function delete($id) 
    {
        return $this->table()->where([
                'id' => $id
        ])->delete();
    }
}

