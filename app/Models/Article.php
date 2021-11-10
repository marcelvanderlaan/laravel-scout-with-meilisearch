<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Article extends Model
{
    use HasFactory, Searchable;

//    public function shouldBeSearchable(): bool
//    {
//        return $this->published == true;
//    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }



}
