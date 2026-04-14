<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = "agendas";
    protected $fillable = ["user_id", "image", "title", "description", "date", "status"];
}
