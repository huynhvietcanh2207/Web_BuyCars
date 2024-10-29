<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $table = 'vouchers';

    protected $primaryKey = 'VoucherId';

    public $timestamps = true; // Kích hoạt timestamps

    protected $fillable = [
        'VoucherCode',
        'DiscountPercentage',
        'ExpirationDate',
        'IsActive',
    ];

    protected $casts = [
        'DiscountPercentage' => 'decimal:2', // Định dạng giá trị là số thập phân với 2 chữ số thập phân
        'ExpirationDate' => 'datetime', // Định dạng là datetime
        'IsActive' => 'boolean', // Định dạng là boolean
    ];
}
