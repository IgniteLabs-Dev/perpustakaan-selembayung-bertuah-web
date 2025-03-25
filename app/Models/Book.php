<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $fillable = ['cover', 'title', 'deskripsi', 'author', 'publisher', 'category_id', 'realese_date', 'stock', 'status', 'type'];

    public function category()
    {
        return $this->belongsTo(BookCategories::class);
    }
    public function transactions()
    {
        return $this->hasMany(LoanTransaction::class);
    }
    
}
