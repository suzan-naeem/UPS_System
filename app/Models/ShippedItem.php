<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippedItem extends Model
{
    use HasFactory;
    protected $table = 'shipped_items';
    protected $fillable = [
        'weight',
        'dimension',
        'insurance_amt',
        'destination',
        'final_delivery_date',
        'retail_center_id',
    ];

    public function retailCenterRelation() //foreign key retail_center_id
    {
        return $this->belongsTo(RetailCenter::class,'retail_center_id');
    }
    
    public function transEventRelation() //foreign key retail_center_id
    {
        return $this->belongsToMany(TransportationEvent::class,'item_transportations','shipped_item_id','transportation_event_schedule_num','id','schedule_number');
    }

}
