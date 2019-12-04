@extends('adminlte::page')

@section('title', 'AdminLTE')

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
                        @if(count($users) > 0)
                            @foreach($users as $user)
                            @csrf
                                @if(Auth::user()->id != $user->id and $user->id != 1)
                                    <li class="user-message" id="{{$user->id}}" >
                                        <a href="#"><span class="user-message-name">{{$user->first_name}} {{$user->last_name}}</span> </a>
                                        <span class="pending-message">1</span>
                                    </li>
                                @endif
                            @endforeach
                         @endif
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

            <div id="chatBox" class="col-md-9">

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


    <script type="text/javascript">
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
    </script>
@stop
