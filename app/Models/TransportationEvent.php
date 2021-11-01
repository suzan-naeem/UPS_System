<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportationEvent extends Model
{
    use HasFactory;
    protected $table = 'transportation_events';
    protected $primaryKey= 'schedule_number';
    protected $fillable = [
        'schedule_number',
        'type',
        'delivery_route',
    ];

    public function shippedItemRelation() //foreign key retail_center_id
    {
        return $this->belongsToMany(ShippedItem::class,'item_transportations','transportation_event_schedule_num','shipped_item_id','schedule_number','id');
    }
}
