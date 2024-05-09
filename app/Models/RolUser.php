<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolUser extends Model
{
    use HasFactory;
    protected $table="rolUser"; // Tabla de base de datos
    protected $fillable=['id','nombre','flags'];
}
