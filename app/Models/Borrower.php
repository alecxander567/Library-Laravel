<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrower extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone_number',
        'payment_method',
        'book_id', 
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class); 
    }
}
