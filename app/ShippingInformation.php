<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingInformation extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'company_name',
        'address_1',
        'address_2',
        'city',
        'state',
        'zip',
        'country',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
