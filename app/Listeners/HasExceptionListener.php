<?php

namespace App\Listeners;

use App\Events\HasExceptionEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\HasExceptionNotification;
use Notification;
use Exception;
 
class HasExceptionListener
{
    public function handle(HasExceptionEvent $event)
    {
    	if(config('app.env') != 'production'){
    		return;
    	}
        $notify = new HasExceptionNotification($event);
        $slackWebHookUrl = config('logging.channels.slack.url'); // paste your webhook slack url here
        Notification::route('slack', $slackWebHookUrl)->notify($notify);
    }
}