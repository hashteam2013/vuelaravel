<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EventType;
class Event extends Model
{
    use HasFactory;
    protected $table="events";
    protected $guarded=[];

    public function eventtype(){
      return  $this->belongsTo(EventType::class,'type_id','id');
    }
}
