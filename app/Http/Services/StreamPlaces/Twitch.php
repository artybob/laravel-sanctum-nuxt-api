<?php

namespace App\Http\Services\StreamPlaces;

use App\Http\Resources\StreamCollection;
use App\Models\StreamingService;
use App\Models\StreamingServicesData;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class Twitch extends AbstractStreamService
{
    const API_BASE_URL = 'https://api.twitch.tv';
    //'application/vnd.twitchtv.v5+json'
    //https://static-cdn.jtvnw.net/previews-ttv/live_user_jasper7se-200x200.jpg static cdn

    public static function getStreams()
    {
        $headers =
            [
                'headers' => [
                    'Client-Id' => env('TWITCH_CLIENT_ID'),
                    'Authorization' => 'Bearer ' . env('TWITCH_ACCESS_TOKEN'),
                ]
            ];
        $client = new Client(['base_uri' => self::API_BASE_URL]);

        $response = $client->get('/helix/streams', $headers);

        $result = json_decode($response->getBody(), true);

        if (!$result) {
            return 'no data from api';
        }
        DB::table('streaming_services_data')->delete();

        $service = StreamingService::firstOrCreate(['name' => 'twitch'],
            ['name' => 'twitch', 'logo' => 'https://logos-download.com/wp-content/uploads/2016/05/Twitch_logo.png']);

        foreach ($result['data'] as $stream) {
            $newThumbnailUrl = str_replace(["{width}", "{height}"], "400", $stream['thumbnail_url']);

            $service->data()->create([
                'service_id' => 1,
                'user_name' => $stream['user_name'],
                'user_login' => $stream['user_login'],
                'stream_user_id' => $stream['user_id'],
                'viewer_count' => $stream['viewer_count'],
                'game_name' => $stream['game_name'],
                'title' => $stream['title'],
                'started_at' => \Carbon\Carbon::parse($stream['started_at'])->format('H:i:s'),
                'thumbnail_url' => $newThumbnailUrl,
            ]);
        }

        return 'ok';
    }

    public static function makeStreamsCache()
    {

    }
}
