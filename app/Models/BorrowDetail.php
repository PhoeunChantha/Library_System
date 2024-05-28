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


    protected $fillable = ['book_ids', 'IsReturn'];

    protected static function boot()
    {
        parent::boot();

        static::saved(function ($borrowDetail) {
            // Decode book IDs from the current BorrowDetail instance
            $bookIds = json_decode($borrowDetail->book_ids, true);

            // Update the IsHidden status for books based on IsReturn value
            if ($borrowDetail->IsReturn == 0) {
                Book::whereIn('BookId', $bookIds)->update(['IsHidden' => 0]);
            } elseif ($borrowDetail->IsReturn == 1) {
                Book::whereIn('BookId', $bookIds)->update(['IsHidden' => 1]);
            }

            // Ensure books that are not borrowed by any other borrow details are set to IsHidden = 1
            $allBorrowedBookIds = BorrowDetail::where('IsReturn', 0)
                ->pluck('book_ids')
                ->map(function ($bookIds) {
                    return json_decode($bookIds, true);
                })
                ->flatten()
                ->unique()
                ->toArray();
            Book::whereNotIn('BookId', $allBorrowedBookIds)->update(['IsHidden' => 1]);
        });
    }



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
