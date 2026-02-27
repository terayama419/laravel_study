<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods';

    protected $fillable = [
        'productCode',
        'name',
        'manufacturerId',
        'supplierId',
        'purchasePrice',
        'sellingPrice',
        'stock',
        'expirationDate',
        'arrivalDate',
        'lotNumber',
        'janCode',
        'storageMethod',
        'category',
        'minimumStock',
        'deleteTimestamp',
    ];

    public function addStock(int $quantity): void
    {
        $this->stock += $quantity;
        $this->save();
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class, 'manufacturerId');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplierId');
    }
}
