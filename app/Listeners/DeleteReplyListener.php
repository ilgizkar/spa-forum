<?php

namespace App\Listeners;

use App\Events\DeleteReply;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeleteReplyListener
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
     * @param  DeleteReply  $event
     * @return void
     */
    public function handle(DeleteReply $event)
    {
        //
    }
}
