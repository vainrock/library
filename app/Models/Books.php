<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    public function Books()
    {
        return $this->hasMany(Books::class);
    }

}
