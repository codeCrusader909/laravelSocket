<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auction</title>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/pusher@7.0.3/dist/web/pusher.min.js"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    
</head>
<body>
    <h1>Auction</h1>
    <div id="auction">
        <h2>Item: <span id="item-name">{{ $auction->item }}</span></h2>
        <p>Current Bid: $<span id="current-bid">{{ $auction->current_bid }}</span></p>
        <input type="number" id="bid-amount" placeholder="Enter your bid">
        <button onclick="placeBid()">Place Bid</button>
    </div>
    <script>
        Pusher.logToConsole = true;
        // Replace with your Pusher key
        const pusher = new Pusher('XXXXXXXXX', {
            cluster: 'mt1',
            encrypted: true
        });
        const channel = pusher.subscribe('auction.{{ $auction->id }}');

        channel.bind('App\\Events\\BidPlaced', function(data) {
            console.log('New bid placed:', data.bid);

            document.getElementById('current-bid').textContent = data.bid.amount;
        });

        function placeBid() {
            const amount = document.getElementById('bid-amount').value;
            fetch(`/auctions/{{ $auction->id }}/bids`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ amount })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Bid placed successfully');
                }
            });
        }
    </script>
</body>
</html>
