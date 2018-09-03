<?php

namespace App\Listeners;

use App\Events\PushEvent;
use GuzzleHttp\Client;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class FirebaseListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PushEvent $event
     * @return void
     */
    public function handle(PushEvent $event)
    {
        $sourceToken = config('broadcast.connections.firebase.secret_key');
        $headers = [
            'Authorization' => 'key=' . $sourceToken,
            'Content-type' => 'application/json'
        ];

        $body = [
            'data' => [
                'title' => 'Hi',
                'body' => 'Welcome to laravel course'
            ],
            'notification' => [
                'title' => 'Hi',
                'body' => 'Welcome to laravel course'
            ],
            'to' => $sourceToken
        ];

        $client = new Client([
            'headers' => $headers
        ]);
        $response = $client->post(config('broadcast.connections.firebase.url'), [
            'body' => json_encode($body)
        ]);

        $finalResponse = json_decode($response->getBody());
        if ($finalResponse->success == 1)
            echo 'sent successfully';
        else
            echo 'send faild';

    }
}
