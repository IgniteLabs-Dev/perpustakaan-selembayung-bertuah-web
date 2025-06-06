<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;
    protected $table = 'bookmark';
    protected $fillable = ['user_id', 'book_id'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }


}
