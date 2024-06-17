<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'event';
    protected $fillable = [
        'date',
        'name',
        'initiator',
        'organizer',
        'location',
        'category',
        'theme',
        'description',
        'scale',
        'price',
        'rate',
        'app',
        'budget',
        'public',
        'done',
        'taken',
        'doneByInit',
        'rateForOrg',
        'doneByOrg',
        'rateForInit',
    ];
}
