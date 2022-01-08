<?php

namespace App\Http\Controllers\Socials;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Utils;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VkController extends Controller
{
    public function saveLastConversationPhotos()
    {
        $vvk = '5.131';
        $client = new Client(['base_uri' => 'https://api.vk.com']);
        $yesterdayUnix = Carbon::yesterday()->timestamp;

        $kmToken = env('KITE_MOBILE_VK_TOKEN');

        $albumId = env('VK_ALBUM_ID');
        $groupId = env('VK_GROUP_ID');
        $peerId = env('VK_PEER_ID');

        $count = 3;

        $params = [
            'query' => [
                'peer_id' => $peerId,
                'media_type' => 'photo',
                'count' => $count,
                'random_id' => microtime(true),
                'v' => $vvk,
                'access_token' => $kmToken,
            ]
        ];
        $r = $this->getVkResponse('/method/messages.getHistoryAttachments', $params, $client);
        $r = $r['items'];

        foreach ($r as $key => $value) {
            $photoUrl = '';
            $sizes = new Collection($value['attachment']['photo']['sizes']);
            //max size of photo
            $max = $sizes->where('width', $sizes->max('width'))->pluck('url');
            $photoUrl = $max->all()[0];

            //save img
            $tempImage = tempnam(Storage::path('public'), '');

            copy($photoUrl, $tempImage);

            $params = [
                'query' => [
                    'album_id' => $albumId,
                    'group_id' => $groupId,
                    'v' => $vvk,
                    'access_token' => $kmToken,
                ]
            ];

            //get upload url
            $r = $this->getVkResponse('/method/photos.getUploadServer', $params, $client);

            $params = [
                'multipart' => [
                    [
                        'name' => 'file1',
                        'contents' => Utils::tryFopen($tempImage, 'r'),
                        'filename' => 'file1.jpg',
                    ],

                ],
            ];
            //upload pic
            $r = $this->getVkResponse($r['upload_url'], $params, $client, 'post');

            $params = [
                'query' => [
                    'album_id' => $r['aid'],
                    'group_id' => $groupId,
                    'photos_list' => $r['photos_list'],
                    'hash' => $r['hash'],
                    'server' => $r['server'],
                    'v' => $vvk,
                    'access_token' => $kmToken,
                ]
            ];
            $r = $this->getVkResponse('/method/photos.save', $params, $client, 'post');
            unlink($tempImage);

        }
        echo 'ok';
    }

    public function getVkResponse($url, $params, $client, $qType = 'get')
    {
        try {
            $r = $client->$qType($url, $params);
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            return $response->getBody()->getContents();
        }

        $r = json_decode($r->getBody(), true);

        if (isset($r['error'])) {
            throw new \Exception($r['error']['error_msg']);
        }

        return $r['response'] ?? $r;
    }
}
