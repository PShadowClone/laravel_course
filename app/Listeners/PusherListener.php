<?php

namespace App\Listeners;

use App\Events\PushEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Pusher\Pusher;

class PusherListener
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
        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
        );
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data['message'] = 'hello world';
        $data['users'] = '{lksdfl}';
        $pusher->trigger('library-channel', 'event-' . $event->user->id, $data);


    }
}
