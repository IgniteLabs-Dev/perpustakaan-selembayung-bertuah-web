<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanTransaction extends Model
{
    use HasFactory;
    protected $table = 'loan_transactions';
    protected $fillable = [
        'user_id',
        'book_id',
        'status',
        'borrowed_at',
        'returned_at',
        'due_date',
        'condition',
        'fine',
        'point'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
