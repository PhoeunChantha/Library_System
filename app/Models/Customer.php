<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $primaryKey = 'CustomerId';
    protected $guarded = [];

    public function customerType()
    {
        return $this->belongsTo(CustomerType::class, 'CustomerTypeId');
    }
}
