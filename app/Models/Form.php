<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $table = "form";

    protected $fillable = [
        'user_id',
        'nome',
        'telefone',
        'idade',
        'profissao',
        'finalidade',
        'photo',
    ];
}
