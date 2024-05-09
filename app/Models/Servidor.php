<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servidor extends Model
{
    use HasFactory;
    protected $table="servidores"; // Tabla de base de datos
    protected $fillable=['ip','puerto','nombre','create_by', 'categoria'];
}
