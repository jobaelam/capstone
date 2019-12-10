@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Messages</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="user-wrapper-message">
                    <ul class="users">
                        @foreach($users as $user)
                        <li class="user-message" id="{{ $user->id }}">
                            <span class="pending-message">1</span>
                            <div class="media">
                                <div class="media-left-message">
                                    <img src="{{ $user->profile_image }}" class="media-object">
                                </div>
                                <div class="media-body-message">
                                    <p class="name">{{ $user->first_name }} {{ $user->last_name }}</p>
                                    <p class="email">{{ $user->email }}</p>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-8" id="messages">

            </div>
        </div>
    </div>
<script type="text/javascript">
    var reveiver_id = '';
    var my_id = '{{Auth::id()}}';
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('4ce59a8acebdae2c292c', {
            cluster: 'ap1',
            forceTLS: true
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            alert(JSON.stringify(data));
        });

        channel.bind('pusher:subscription_succeeded', function(members) {
            alert('successfully subscribed!');
        });

        $('.user-message').click(function () {
            $('.user-message').removeClass('active');
            $(this).addClass('active');

            receiver_id = $(this).attr('id');
            $.ajax({
                type:"get",
                url: "message/" + receiver_id,
                data: "",
                cache: false,
                success: function (data) {
                    $('#messages').html(data);
                }
            })
        });

        $(document).on('keyup', '.input-text input', function(e){
            alert('ayay');
            var message = $(this).val();
            if(e.keyCode == 13 && message != '' && receiver_id != '') {
                $(this).val('');
                alert('ayay');      

                $.ajax({
                    type: 'post',
                    url: '/sendMessage',
                    data: {receiver_id: receiver_id, message: message},
                    cache: false,
                    success: function (data) {
                        //alert(data);
                    },
                    error: function (jqXHR, status, err) {

                    },
                    complete: function () {

                    }
                })
            }
        })
    })
</script>
@stop
