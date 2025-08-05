<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
Use App\Models\BirthCertificate;
use Log;


class NewBirthCertificateCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $birthCertificate;

    public function __construct(BirthCertificate $birthCertificate)
    {
        $this->birthCertificate = $birthCertificate;
         // 🔍 Log ici pour t'assurer que l'événement est déclenché
        Log::info('Event broadcasted to SuperAdmin', ['data' => $birthCertificate]);

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('super-admin'),
        ];
    }

    public function broadcastWith()
    {
        return [
            'message' => 'Nouvel extrait ajouté',
            'id' => $this->birthCertificate->id,
            'name' => $this->birthCertificate->child_name,
        ];
    }

}
