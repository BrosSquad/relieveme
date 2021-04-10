<?php

namespace App\Notifications;

use App\Models\Hazard;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\ExpoPushNotifications\ExpoChannel;
use NotificationChannels\ExpoPushNotifications\ExpoMessage;

class NotifyUserAboutHazard extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(private Hazard $hazard)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [ExpoChannel::class];
    }

    public function toExpoPush($notifiable)
    {
        return ExpoMessage::create()
            ->badge(1)
            ->enableSound()
            ->priority('high')
            ->title('Opasnost!!!')
            ->body($this->hazard->danger ?? 'U velikoj ste opasnosti')
            ->setJsonData(
                [
                    'id' => $this->hazard->id,
                    'type' => 'hazard',
                ]
            );
    }
}
