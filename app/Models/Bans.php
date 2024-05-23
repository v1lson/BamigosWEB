<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bans extends Model
{
    use HasFactory;
    protected $fillable=['id','estado','id_servidor','steam_id','nombre','razon','nombre_moderador','tiempo_inicio',"tiempo_final","nombre_panlizador"];
}
