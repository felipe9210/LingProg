<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produto extends Model

{
    protected $filiable = [
        'nome',
        'categoria_id',
        'quantidade',
    ];



    public function categoria(){
        return $this-> bellongsTo(Categoria::class);
    }
};
