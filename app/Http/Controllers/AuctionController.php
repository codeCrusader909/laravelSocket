<?php

namespace App\Http\Controllers;
use App\Models\Auction;
use App\Models\Bid;
use App\Events\BidPlaced;
use Illuminate\Http\Request;

class AuctionController extends Controller
{
   
    
    public function placeBid(Request $request, $auctionId)
    {
        $auction = Auction::findOrFail($auctionId);
        $bid = new Bid();
        $bid->auction_id = $auctionId;
        $bid->amount = $request->amount;
        $bid->save();
    
        // Update auction with the new highest bid
        $auction->current_bid = $request->amount;
        $auction->save();
    
        // Dispatch the event
        broadcast(new BidPlaced($bid, $auction->id));
    
        return response()->json(['success' => true]);
    }
    public function show($id)
    {
        // Retrieve the auction by ID
        $auction = Auction::findOrFail($id);

        // Pass the auction data to the view
        return view('auction', compact('auction'));
    }
}
