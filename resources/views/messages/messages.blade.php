@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Messages</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="user-wrapper">
                    <ul class="users">
                        @foreach($users as $user)
                        <li class="user" id="{{ $user->id }}">
                            <span class="pending">1</span>
                            <div class="media">
                                <div class="media-left">
                                    <img src="{{ $user->profile_image }}" class="media-object">
                                </div>
                                <div class="media-body">
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

        $('.user').click(function () {
            $('.user').removeClass('active');
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
            var message = $(this).val();
            if(e.keyCode == 13 && message != '' && receiver_id != '') {
                $(this).val('');

                // var datastr = 'receiver_id=' + receiver_id + '&message=' + message;
                //console.log(datastr);
                $.ajax({
                    type: 'post',
                    url: 'sendMessage',
                    data: {receiver_id: receiver_id, message: message},
                    cache: false,
                    success: function (data) {
                        console.log(data);
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
