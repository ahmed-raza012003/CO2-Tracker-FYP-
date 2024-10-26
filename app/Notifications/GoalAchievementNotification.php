<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class GoalAchievementNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $goal;

    public function __construct($goal)
    {
        $this->goal = $goal;
    }

    public function via($notifiable)
    {
        return ['database']; // Storing in the database
    }

    public function toArray($notifiable)
    {
        return [
            'goal' => $this->goal->goal,
            'target_co2' => $this->goal->target_co2,
            'current_co2' => $this->goal->current_co2,
            'message' => 'You have reached your goal!',
        ];
    }
}
