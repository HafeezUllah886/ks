<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class production extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(products::class, 'productID');
    }

    public function account()
    {
        return $this->belongsTo(accounts::class, 'accountID');
    }

    public function details()
    {
        return $this->belongsToMany(productiondetails::class, 'productiondetails', 'productionID', 'productID')->withPivot('qty', 'refID');
    }

    public function warehouse()
    {
        return $this->belongsTo(warehouses::class, 'warehouseID');
    }
}
