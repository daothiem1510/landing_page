<div id="chat-message">
    <div class="chat-box">
        <div class="chat-head">
            <span class="status f-online"></span>
            <h6>Admin</h6>
            <div class="more">
                <span class="close-mesage"><i class="fa fa-times"></i></span>
            </div>
        </div>
        <div class="chat-list">
            <ul class="ps-container ps-theme-default ps-active-y">

                <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div>
                <div class="ps-scrollbar-y-rail" style="top: 0px; height: 290px; right: 0px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 215px;"></div></div>
            </ul>
            <div class="text-box">
                <input type='hidden' name='receiver_id' value='' id="receiver_id" />
                <input type='file' name='file' >
                <textarea placeholder="{!!trans('base.send_message')!!}..." name='message' id='content_message'></textarea>
            </div>
        </div>
    </div>
</div>
<input type='hidden' value='{{isset(\Auth::user()->id)? \Auth::user()->id : ''}}' id="private_id" />
<input type='hidden' value='' id="receiver" />
<script src="{!! asset('assets/global_assets/js/main/jquery.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/main/bootstrap.bundle.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/validation/validate.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/styling/uniform.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/loaders/blockui.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/visualization/d3/d3.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/visualization/d3/d3_tooltip.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/styling/switchery.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/bootbox/bootbox.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/uploaders/fileinput/fileinput.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/demo_pages/uploader_bootstrap.js') !!}"></script>
<script src="{!! asset('assets/backend/js/toastr.min.js') !!}"></script>
<script src="{!! asset('assets/js/app.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/visualization/echarts/echarts.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/plugins/media/fancybox.min.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/demo_pages/dashboard.js') !!}"></script>
<script src="{!! asset('assets/global_assets/js/demo_pages/gallery.js') !!}"></script>
<script src="{!! asset('assets/backend/js/jquery.lighter.js') !!}"></script>
<script src="{!! asset('assets/backend/ckeditor/ckeditor.js') !!}"></script>

<script src="https://js.pusher.com/4.4/pusher.min.js"></script>
<script>
    // make a function to scroll down auto
        function scrollToBottomFunc() {
            $('.ps-container').animate({
                scrollTop: $('.ps-container').get(0).scrollHeight
            }, 50);
        }
        var my_id = $('#private_id').val();
        var receiver = '';
        Pusher.logToConsole = true;
        var pusher = new Pusher('5f3ce4afb73cda497160', {
            cluster: 'ap2',
            forceTLS: true
        });
        var channel = pusher.subscribe('chat-message');
        channel.bind('send-message', function (data) {
            // alert(JSON.stringify(data));
            if (my_id === data.from) {
                $('.ps-container').append(`
                    <li class="me">
                        <div class="chat-thumb"><img src="{{asset('/img/img_avatar.png')}}" alt="" class="avatar-img"></div>
                        <div class="notification-event">
                            <span class="chat-message-item">
                                `+data.message+`
                            </span>
                            <span class="notification-date"><time datetime="2004-07-24T18:18" class="entry-date updated">{{ date('d m, h:i a') }}</time></span>
                        </div>
                    </li>
                `);
            }else if(my_id === data.to && receiver == data.from ){
                $('.ps-container').append(`
                    <li class="you">
                        <div class="chat-thumb"><img src="{{asset('/img/img_avatar.png')}}" alt="" class="avatar-img"></div>
                        <div class="notification-event">
                            <span class="chat-message-item">
                                `+data.message+`
                            </span>
                            <span class="notification-date"><time datetime="2004-07-24T18:18" class="entry-date updated">{{ date('d m, h:i a') }}</time></span>
                        </div>
                    </li>
                `);
            }else if(my_id === data.to && receiver != data.from){
                if($('#count-message').html() === ''){
                     $('#count-message').html(1);
                }else{
                     $('#count-message').html(parseInt($('#count-message').html()) + 1);
                }
            }
            scrollToBottomFunc()
        });
        var channels = pusher.subscribe('chat-group-message');
        channels.bind('send-group-message', function (data) {
            if (my_id === data.from) {
                $('.ps-container').append(`
                    <li class="me">
                        <div class="chat-thumb"><img src="{{asset('/img/img_avatar.png')}}" alt="" class="avatar-img"></div>
                        <div class="notification-event">
                            <span class="chat-message-item">
                                `+data.message+`
                            </span>
                            <span class="notification-date"><time datetime="2004-07-24T18:18" class="entry-date updated">{{ date('d m, h:i a') }}</time></span>
                        </div>
                    </li>
                `);
            }else if(data.to.includes(parseInt(my_id)) == true && receiver == data.group_id){
                $('.ps-container').append(`
                    <li class="you">
                        <div class="chat-thumb"><img src="{{asset('/img/img_avatar.png')}}" alt="" class="avatar-img"></div>
                        <div class="notification-event">
                            <span class="notification-date">`+data.user_name+`</span>
                            <span class="chat-message-item">
                                `+data.message+`
                            </span>
                            <span class="notification-date"><time datetime="2004-07-24T18:18" class="entry-date updated">{{ date('d m, h:i a') }}</time></span>
                        </div>
                    </li>
                `);
            }else if(Array(data.to).indexOf(my_id) == -1 && receiver != data.group_id){
                if($('#count-message').html() === ''){
                     $('#count-message').html(1);
                }else{
                     $('#count-message').html(parseInt($('#count-message').html()) + 1);
                }
            }
            scrollToBottomFunc()
        });
        $('body').delegate('.message','click',function(){
            var from = $(this).data('from');
            var to = $(this).data('to');
            receiver = $(this).data('to');
            $('.tab-message').removeClass('show');
            $.ajax({
                url: '/api/get-message',
                method: 'POST',
                data: {from: from,to:to},
                success: function (response) {
                    if (response.error === false) {
                        $('#chat-message').html(response.html);
                        scrollToBottomFunc();
                    }
                }
            });
        })
        $('body').delegate('.group-message','click',function(){
            var from = $(this).data('from');
            var to = $(this).data('to');
            receiver = $(this).data('to');
            $('.tab-message').removeClass('show');
            $.ajax({
                url: '/api/get-group-message',
                method: 'POST',
                data: {from: from,to:to},
                success: function (response) {
                    if (response.error === false) {
                        $('#chat-message').html(response.html);
                        scrollToBottomFunc();
                    }
                }
            });
        })
        $('body').delegate('.close-mesage','click',function(){
            $('.chat-box').removeClass("show");
            return false;
        });
        $(document).on('keyup', '#content_message', function (e) {
            e.preventDefault();
            var message = $(this).val();
            var receiver_id = $('#receiver_id').val();
            var my_id = $('#my_id').val();
            var type = $('#type_message').val();
            if (e.keyCode == 13 && message != '' && receiver_id != '') {
                $(this).val('');
                $.ajax({
                    url: '/api/send-message',
                    method: 'POST',
                    data: {message:message,receiver_id:receiver_id,my_id:my_id,type:type},
                    success: function (data) {
                        scrollToBottomFunc();
                    }
                })
            }
        });
        $('.setting-area > li > a').on("click",function(){
             var $parent = $(this).parent('li');
             $(this).addClass('active').parent().siblings().children('a').removeClass('active');
             $parent.siblings().children('div').removeClass('active');
             $(this).siblings('div').toggleClass('active');
                    return false;
      });
      $('body').delegate('.upload-file','change', function(){
            var file_data = $(this).prop('files')[0];
            var receiver_id = $('#receiver_id').val();
            var my_id = $('#my_id').val();
            var type = $('#type_message').val();
            var form_data = new FormData();
            form_data.append('file', file_data);
            form_data.append('_token','{{ csrf_token() }}');
            form_data.append('receiver_id',receiver_id);
            form_data.append('type',type);
            form_data.append('my_id',my_id);
            $.ajax({
                url: '/api/send-file-message',
                method: 'POST',
                data: form_data,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response){
                    if(response.success == true){
                        $input.val(response.image);
                    }
                }
             });
    });
    $('#seen-chat').click(function(){
        $.ajax({
            url: '/api/get-all-message',
            method: 'POST',
            data: {id:'{{\Auth::user()->id}}'},
            success: function (data) {
                $('#list-message').html(data.html);
            }
        })
    });
</script>
<script> CKEDITOR.replace('editor'); </script>
