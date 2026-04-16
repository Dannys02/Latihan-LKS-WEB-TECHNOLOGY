<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    protected $fillable = ['name_tag', 'user_id'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function agendas()
    {
        return $this->belongsToMany(Agenda::class);
    }
}
