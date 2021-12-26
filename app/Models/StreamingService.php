<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StreamingService extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function data()
    {
        return $this->belongsToMany(StreamingServicesData::class, 'streaming_service_has_data', 'streaming_service_id','streaming_service_data_id');
    }
}
