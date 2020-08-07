<?php

namespace App\Events;

use App\Checklist;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class ChecklistCreatedEvent
 *
 * @package App\Events
 */
class ChecklistCreatedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Checklist
     */
    public $checklist;

    /**
     * ChecklistCreatedEvent constructor.
     *
     * @param Checklist $checklist
     */
    public function __construct(Checklist $checklist)
    {
        $this->checklist = $checklist;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('project' . $this->checklist->project_id);
    }

    /**
     * @return string[]
     */
    public function broadcastWith()
    {
        return [
            'data' => $this->checklist,
        ];
    }
}
