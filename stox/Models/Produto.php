<?php

namespace Stox\Models;

use Illuminate\Database\Capsule\Manager as DB;

class Produto
{
    public function table()
    {
        return DB::table('produtos');
    }
    
    public function set(array $post)
    {
        $this->produto = $post['produto'];
        $this->descricao = $post['descricao'];
        $this->estoque = $post['estoque'];
        $this->fornecedor_id = $post['fornecedor_id'];
    }
    
    protected function mount($obj)
    {
        foreach($obj as $key => $val) {
            $this->$key = $val;
        }
    }
    
    public function save()
    {
        return $this->table()->insert((array)$this);
    }
    
    public function update()
    {
        $prod_up = (array)$this;
        return DB::table('produtos')
                ->where('id', $this->id)
                ->update($prod_up);
    }
    
    public static function delete($id)
    {
        return DB::table('produtos')
                ->where('id', $id)
                ->delete();
    }
    
    public static function all()
    {
        return DB::table('produtos')
                ->join('fornecedores', 'fornecedores.id', '=', 'produtos.fornecedor_id')
                ->select('produtos.*', 'fornecedores.nome as fornecedor')
                ->orderBy('produtos.id')
                ->get();
    }
    
    public static function byId($id)
    {
        $prodDB = DB::table('produtos')
                ->where('id', $id)
                ->first();
        $produto = new Produto;
        $produto->mount($prodDB);
        return $produto;
    }
    
    public static function retirar($id)
    {
        $prod = static::byId($id);
        if (is_object($prod) && $prod->estoque > 0) {
            $prod->estoque -= 1;
            $prod->update();
            return true;
        }
        return false;
    }
}

