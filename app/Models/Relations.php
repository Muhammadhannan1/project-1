<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relations extends Model
{
    use HasFactory;
    protected $fillable = [
        'careTakerId',
        'patientId',
        'relationName',
        'otp',
        'status',
    ];
}
