<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servidor extends Model
{
    use HasFactory;
    protected $table="servidores"; // Tabla de base de datos
    protected $fillable=['ip','nombre','create_by']; // Sirve para mandar un array para no ir campo a campo
}
