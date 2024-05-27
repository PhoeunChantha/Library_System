<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowDetail extends Model
{
    use HasFactory;
    protected $primaryKey = 'BorrowDetailId';
    protected $table = 'borrowdetails';
    protected $guarded = [];

    public function borrow()
    {

        return $this->belongsTo(Borrow::class, 'BorrowId');
    }
    public function book()
    {
        return $this->belongsTo(Book::class, 'BookId');
    }
    public function catalog()
    {

        return $this->belongsTo(Catalog::class, 'CatalogId');
    }
}
