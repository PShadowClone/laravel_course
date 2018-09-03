<?php

namespace App\Listeners;

use App\Events\PushEvent;
use App\Mail\PrettyWelcome;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class MailListener
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
        Mail::to($event->user)->send(new PrettyWelcome($event->user));
    }
}
