<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['customer_name', 'date', 'total'];

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

}
