<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'reference', 'rastreio','pagseguro_transaction_code', 'qtde','frete','preco_livro','taxa_pagseguro','preco_total','status', 'forma_pagto','url_boleto'
    ];
    
    public function getUserName($user_id){
    	$user = new User;
    	return $user->select('name')->where('id', $user_id)->first();
    }

    public function getSomaTotal(){
    	return $this->sum('preco_total');
    }

    public function getSomaTotalPago(){
    	return $this->where('status','3')->sum('preco_total');
    }
	
	public function getSomaTotalPendente(){
    	return $this->where('status','<>','3')->where('status','<>','4')->where('status','<>','7')->sum('preco_total');
    }
    
    	public function getSomaTotalCancelado(){
    	return $this->where('status','7')->sum('preco_total');
    }
}
