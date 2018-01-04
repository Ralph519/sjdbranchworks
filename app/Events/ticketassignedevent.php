<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ticketassignedevent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $username;

    public $message;

    public $userpix;

    public $eventticketid;

    public $issue;

    public $priority;

    public $userid;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($username,$userpix,$eventticketid,$issue,$priority,$userid)
    {
      $this->username = $username;
      $this->message  = "{$username} assigned you a ticket";
      $this->userpix  = "{$userpix}";
      $this->eventticketid = "$eventticketid";
      $this->issue    = $issue;
      $this->priority = $priority;
      $this->userid = $userid;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
          return ['ticket-assigned'];
    }
}
