<?php

/*
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class CourseCommentEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $courseId;

    public $commentId;

    /**
     * CourseCommentEvent constructor.
     * @param int $courseId
     * @param int $commentId
     */
    public function __construct(int $courseId, int $commentId)
    {
        $this->courseId = $courseId;
        $this->commentId = $commentId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     *
     * @codeCoverageIgnore
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
