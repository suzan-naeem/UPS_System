<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemTransportation extends Model
{
    use HasFactory;
    protected $fillable = [
        'shipped_item_id',
        'transportation_event_schedule_num',
    ];
}
