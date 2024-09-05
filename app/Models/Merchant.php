<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'company_name', 'email', 'phone_number', 'address', 'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
