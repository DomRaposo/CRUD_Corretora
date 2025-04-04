<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corretor extends Model
{
    use HasFactory;

    protected $table = 'corretores'; // Nome correto da tabela

    protected $fillable = [
        'nome', 'cpf', 'creci'
    ];
}
