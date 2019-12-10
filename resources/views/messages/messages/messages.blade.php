            <!-- DIRECT CHAT PRIMARY -->
            <div class="box table-responsive direct-chat direct-chat-primary">
                <div id='h3name' class="box-header with-border">
                <h3 id='h3name' class="box-title">Direct Chat</h3>
    
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages">
                    
                </div>
                <!--/.direct-chat-messages-->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div id="typingStatus" class="col-lg-12" style="padding: 15px"></div>
                    <div class="input-group">                    
                        <input id="text" type="text" name="message" placeholder="Type Message ..." class="form-control">
                            <span class="input-group-btn">
                                <button type="reset" onClick="sendMessage()" class="btn btn-primary btn-flat">Send</button>
                            </span>
                    </div>
                </div>
                <!-- /.box-footer-->
            </div>