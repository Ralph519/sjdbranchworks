<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;

class notifyticketassigned extends Notification
{
    use Queueable;

    public $notificationby;

    public $notifavatar;

    public $ticketid;

    public $notifissue;

    public $notifpriority;

    public $userid;

    public $notiftype;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($notificationby,$notifavatar,$ticketid,$notifissue,$notifpriority,$userid,$notiftype)
    {
        $this->notificationby = $notificationby;
        $this->notifavatar = $notifavatar;
        $this->ticketid = $ticketid;
        $this->notifissue = $notifissue;
        $this->notifpriority = $notifpriority;
        $this->userid = $userid;
        $this->notiftype = $notiftype;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
    }

    public function toBroadcast($notifiable)
    {
      return new BroadcastMessage([
          'ticket' => $this->ticketid,
          'user' => Auth::user()
      ]);
    }

    public function toDatabase($notifiable)
    {
      return [
          'notificationby' => $this->notificationby,
          'avatar' => $this->notifavatar,
          'ticketid' => $this->ticketid,
          'notifissue' => $this->notifissue,
          'priority' => $this->notifpriority,
          'user' => $notifiable,
          'userid' => $this->userid,
          'notiftype' => $this->notiftype
      ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
