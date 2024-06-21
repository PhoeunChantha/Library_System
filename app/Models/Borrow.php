<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Borrow extends Model
{
    use HasFactory;
  
    protected $primaryKey = 'BorrowId';
    protected $guarded = [];

    public function customer()
    {

        return $this->belongsTo(Customer::class, 'CustomerId');
    }
    public function librarian()
    {
        return $this->belongsTo(Librarian::class, 'LibrarianId');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'UserId');
    }
    public function book()
    {

        return $this->belongsTo(Book::class, 'BookId');
    }
    public function borrowDetails()
    {
        return $this->hasMany(BorrowDetail::class, 'BorrowId');
    }
}
