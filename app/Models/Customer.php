<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id', 'name', 'contact_person', 'email', 'phone_number', 'address', 'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}   
