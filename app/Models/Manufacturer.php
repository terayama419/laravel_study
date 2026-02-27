<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $fillable = [
        'name',
        'address',
        'businessHours',
        'phoneNumber',
        'representativeName',
        'deleteTimestamp',
    ];

    public function foods()
    {
        return $this->hasMany(Food::class, 'manufacturerId');
    }
}
