<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estadistica extends Model
{
    use HasFactory;
    protected $fillable=['id','steam','name','value','rank','kills','deaths',"shoots","hits","headshots","assits","round_win","round_lose","playtime","lastconncet"];
}
