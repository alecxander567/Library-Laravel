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
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
