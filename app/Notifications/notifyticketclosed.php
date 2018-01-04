<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;

class notifyticketclosed extends Notification
{
    use Queueable;

    public $notificationby;

    public $notifavatar;

    public $ticketid;

    public $notifissue;

    public $notifpriority;

    public $userid;

    public $notiftype;

    public $ticketno;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($notificationby,$notifavatar,$ticketid,$notifissue,$notifpriority,$userid,$notiftype,$ticketno)
    {
      $this->notificationby = $notificationby;
      $this->notifavatar = $notifavatar;
      $this->ticketid = $ticketid;
      $this->notifissue = $notifissue;
      $this->notifpriority = $notifpriority;
      $this->userid = $userid;
      $this->notiftype = $notiftype;
      $this->ticketno = $ticketno;
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

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */

     public function toBroadcast($notifiable)
     {
         return new BroadcastMessage([
             'user' => $notifiable
         ]);
     }

    public function toDatabase($notifiable)
    {
        return [
            'notificationby' => $this->notificationby,
            'avatar' => $this->notifavatar,
            'ticketid' => $this->ticketid,
            'notifissue' => $this->notifissue,
            'user' => $notifiable,
            'priority' => $this->notifpriority,
            'userid' => $this->userid,
            'notiftype' => $this->notiftype,
            'ticketno' => $this->ticketno
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
