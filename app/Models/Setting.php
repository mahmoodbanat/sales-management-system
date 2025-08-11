<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'store_name',
        'currency',
        'tax_percentage',  // أو 'tax_rate' حسب اسم الحقل في الداتا بيز
        'store_logo',
        // أضف أي حقول أخرى في جدول الإعدادات تحتاج تسمح لها بالملئ الجماعي
    ];
}
