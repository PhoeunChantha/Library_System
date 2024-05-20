<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $primaryKey = 'BookId';
    protected $guarded = [];
    
    public function catalog()
    {
        return $this->belongsTo(Catalog::class, 'CatalogId');
    }
    // public function borrowDetails()
    // {
    //     return $this->belongsToMany(BorrowDetail::class, 'BookId', 'BorrowId');
    // }
}
