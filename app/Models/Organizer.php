<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizer extends Model
{
    use HasFactory;

    protected $table = 'organizer';
    protected $fillable = [
        'userId',
        'name',
        'rate',
        'hired',
        'location',
        'specialist',
        'services',
    ];
}
