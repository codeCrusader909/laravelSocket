<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;


class BidPlaced implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $bid;
    public $auctionId;

    public function __construct($bid, $auctionId)
    {
        $this->bid = $bid;
        $this->auctionId = $auctionId;
    }

    public function broadcastOn()
    {
        return new Channel('auction.' . $this->auctionId);
    }

    public function broadcastWith()
    {
        return [
            'bid' => $this->bid,
        ];
    }
}
