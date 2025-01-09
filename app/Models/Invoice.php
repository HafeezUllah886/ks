<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function details()
    {
        return $this->hasMany(InvoiceContainers::class, 'invoiceID');
    }

    public function product()
    {
        return $this->belongsTo(products::class, 'productID');
    }

    public function customer()
    {
        return $this->belongsTo(accounts::class, 'customerID');
    }

    public function account()
    {
        return $this->belongsTo(accounts::class, 'accountID');
    }
}
