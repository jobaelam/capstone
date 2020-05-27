<div class="message-wrapper-message">
    <ul class="messages-message">
        @foreach($messages as $message)    
            <li class="message-message clearfix">
                <div class="{{($message->from == Auth::id()) ? 'sent-message' : 'received-message'}}">
                    <p>{{ $message->message }}</p>
                    <p class="date-message">{{ date('d M y, h:i:a', strtotime($message->created_at)) }}</p>
                </div>
            </li>
        @endforeach
    </ul>
</div>

<div class="input-text">
    <input type="text" name="message" class="submit" placeholder="Type a message..."
</div>