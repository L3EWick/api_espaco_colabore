<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $table = "form";

    protected $fillable = [
        'nome',
        'idade',
        'profissao',
        'finalidade',
        'photo',
    ];
}
