<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
            'name' ,
            'type',
            'email',
            'address',
            'city' ,
            'state' ,
            'country' ,
            'postalCode',

        ];
    //declaring relationship (One -> Many)

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
