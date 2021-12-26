<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StreamingServicesData extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function service()
    {
        return $this->hasOneThrough(StreamingService::class, 'streaming_service_has_data', 'streaming_service_data_id', 'streaming_service_id');
    }
}
