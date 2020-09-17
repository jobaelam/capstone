@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('css')
        <!-- Messages -->
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/message.css') }}">
@stop

@section('content_header')
    <h1>Messages</h1>
@stop

@section('content')
        <div class="row">
            <div class="col-md-3">
            <div class="box box-solid">
                <div class="user-wrapper-message">
                    <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        @foreach($users as $user)
                        @csrf
                            @if(Auth::user()->id != $user->id and $user->id != 1)
                                <li class="user-message" id="{{$user->id}}" >

                                    <a href="#"><span class="user-message-name">{{$user->first_name}} {{$user->last_name}}</span> </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    </div>
                </div>
            {{-- <div class="box box-solid collapsed-box"> --}}
                {{-- <div class="box-header with-border">
                <h3 class="box-title">All Contacts</h3>
                <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                    </div> --}}

                <!-- /.box-body -->
            </div>
            </div>
            <!-- /.col -->

            <div id="message" class="col-md-9">

            <!--/.direct-chat -->
            </div>

            <div class="col-md-2">


            </div>
            <!-- /.col -->

            </div>
            <!-- /.col -->
        </div>
{{--         <div class="box">
            <div class="col-lg-4 col-lg-offset-4">
                <h1 id="greeting">Hello, <span id="username">{{Auth::user()->id}}</span></h1>

                <div id="chat-window" class="col-lg-12">

                </div>
                <div class="col-lg-12">
                    <div id="typingStatus" class="col-lg-12" style="padding: 15px"></div>
                    <input type="text" id="text" class="form-control col-lg-12" autofocus="" onblur="notTyping()">
                </div>
            </div>
        </div> --}}
   {{--  </section>
    /.content
    </div> --}}


    {{-- <script type="text/javascript">
    	var reveiver_id = '';
    	var my_id = '{{Auth::id()}}';
    	$(document).ready(function() {
            function updateScroll(){
                // var element = document.getElementById("message-wrapper-message");
                $('message-wrapper-message').scrollTop() = 9999;
            }
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
	                    $('#chatBox').html(data);
                        $('message-wrapper-message').scrollTop();
	                }
	            })
	        });
	    });
        $(document).on('keyup', '.input-text input', function(e){
            var message = $(this).val();
            if(e.keyCode == 13 && message != '' && receiver_id != '') {
                $(this).val('');
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
        });
    </script> --}}

@section('js')
<script src="https://js.pusher.com/6.0/pusher.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
    var receiver_id = '';
    var my_id = "{{ Auth::id() }}";
    $(document).ready(function () {
        // ajax setup form csrf token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('4ce59a8acebdae2c292c', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function (data) {
            // alert(JSON.stringify(data));
            if (my_id == data.from) {
                $('#' + data.to).click();
            } else if (my_id == data.to) {
                if (receiver_id == data.from) {
                    // if receiver is selected, reload the selected user ...
                    $('#' + data.from).click();
                } else {
                    // if receiver is not seleted, add notification for that user
                    var pending = parseInt($('#' + data.from).find('.pending-message').html());

                    if (pending) {
                        $('#' + data.from).find('.pending-message').html(pending + 1);
                    } else {
                        $('#' + data.from).append('<span class="pending-message">1</span>');
                    }
                }
            }
        });

        $('.user-message').click(function () {
            $('.user-message').removeClass('active');
            $(this).addClass('active');
            $(this).find('.pending-messages').remove();

            receiver_id = $(this).attr('id');
            $.ajax({
                type: "get",
                url: "message/" + receiver_id, // need to create this route
                data: "",
                cache: false,
                success: function (data) {
                    $('#message').html(data);
                    scrollToBottomFunc();
                }
            });
        });

        $(document).on('keyup', '.input-text input', function (e) {
            var message = $(this).val();

            // check if enter key is pressed and message is not null also receiver is selected
            if (e.keyCode == 13 && message != '' && receiver_id != '') {
                $(this).val(''); // while pressed enter text box will be empty

                var datastr = "receiver_id=" + receiver_id + "&message=" + message;
                $.ajax({
                    type: "post",
                    url: "sendMessage", // need to create this post route
                    data: datastr,
                    cache: false,
                    success: function (data) {

                    },
                    error: function (jqXHR, status, err) {
                    },
                    complete: function () {
                        scrollToBottomFunc();
                    }
                })
            }
        });
    });

    // make a function to scroll down auto
    function scrollToBottomFunc() {
        $('.message-wrapper-message').animate({
            scrollTop: $('.message-wrapper-message').get(0).scrollHeight
        }, 50);
    }
</script>
@endsection
@stop
