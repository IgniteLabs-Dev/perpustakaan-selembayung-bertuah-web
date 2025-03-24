<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookAuthors extends Model
{
    use HasFactory;
    protected $table = 'book_authors';
    protected $fillable = ['book_id', 'author_id'];
    
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

}
