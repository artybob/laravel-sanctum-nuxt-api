<?php
namespace App\Http\Services\StreamPlaces;

abstract class AbstractStreamService
{
    abstract public static function getStreams();
    abstract public static function makeStreamsCache();
}
