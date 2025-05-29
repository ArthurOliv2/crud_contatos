<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    protected $fillable = [
        'nome',
        'idade',
        'telefone',
        'rua',
        'numero',
        'complemento',
        'cep',
        'cidade',
        'estado',
    ];
}