<?php

namespace App\Http\Controllers;

use App\Helpers\ExternalApis;
use App\Models\StreamingService;
use Illuminate\Http\Request;

class StreamsController extends Controller
{
    public function getAllStreamsData() {
        //check if no streams data cached
       return StreamingService::with('data')->get();

//        foreach (ExternalApis::AVAILABLE_APIS as $api) {
//            return $api::getStreams();
//        }
    }
}
