<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'phone', 'address']; // عدل الأعمدة حسب جدولك

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

}
