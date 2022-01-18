@extends('layouts.student')
@section('title', 'Chat')
@section('css')
    <link rel="stylesheet" href="{{ asset('theme/css/chatbox.css') }}">
    <style>
        .msger-chat {
            background-color: #fcfcfe;
            background-image: url("{{ asset('theme/images/feather-long-bg.jpg') }}");
        }
    </style>
@endsection
@section('content')
<section class="dashboard-header" style="background-image: url({{ asset('theme/images/feather-long-bg.jpg') }});">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2><span style="color: #f26d64;">Chat</span></h2>
                <h6>Here you can chat with your tutors</h6>
            </div>
        </div>
    </div>
</section>
<section class="chat-section">
    <div class="container">
        <div class="row">
            @if (count($converstaions) > 0)
                <div class="col-12">
                    <div class="conversation">
                        <div class="sidepanel">
                            <button class="btn btn-lg" id="toggle-chat-sidebar">
                                <i class="fa fa-arrow-right"></i>
                            </button>
                            <div class="search">
                                <input type="text" placeholder="Search Tutors...">
                            </div>
                            <div class="contacts">

                                <ul>
                                    @foreach($converstaions as $item)
                                    <li class="contact" data-convo_id="{{ $item->id }}">
                                        <div class="wrap">
                                            <img src="{{ asset($item->tutor_user->tutor_profile->profile_photo ?? 'default.png') }}" alt="" />
                                            <div class="meta">
                                                <p class="name">{{ $item->tutor_user->name }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="msger">
                            <header class="msger-header"><meta charset="windows-1252">
                                <div class="clearfix">
                                    <div class="float-left">
                                        <div class="msger-header-title">
                                            <img src="{{ asset($converstaions[0]->tutor_user->tutor_profile->profile_photo ?? 'default.png') }}" width="40px" style="border-radius: 100%;" alt="">
                                            <h5 class="d-inline m-0">{{ $converstaions[0]->tutor_user->name }}</h5>
                                        </div>
                                    </div>
                                    {{-- <div class="float-right">
                                        <a href="" class="btn btn-default btn-small mt-1"><i class="fa fa-eye"></i> View Session</a>
                                    </div> --}}
                                </div>
                            </header>

                            <main class="msger-chat">

                            </main>

                            <form class="msger-inputarea" method="POST">
                                <input type="text" name="content" class="msger-input" placeholder="Enter your message..." autocomplete="off">
                                <button type="submit" class="btn msger-send-btn btn-sm "><i class="fa fa-paper-plane m-0 pl-2 pr-2 pt-0 pb-0" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-12 text-center pt-4 pb-4">
                    <img src="{{ asset('theme/images/no_messsage.png') }}" alt="">
                    <h3 class="text-dark">No Messages Yet</h3>
                    <p>Looks like you haven't initiated a conversation <br> with any of student</p>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
@section('js')
    <script src="https://www.gstatic.com/firebasejs/4.9.1/firebase.js"></script>
    @if (count($converstaions) > 0)
        <script>
            var convo_id = <?php echo $converstaions[0]->id ?>;
            var user_id = <?php echo auth()->user()->id ?>;
            $(document).ready(function () {
                $(document).on('click', '.contact', function(){
                    convo_id = $(this).data('convo_id');
                    $('.msger-header-title img').attr('src', $(this).find('img').attr('src'));
                    $('.msger-header-title h5').text($(this).find('p.name').text());
                    $('.msger-chat').html('<h5 class="text-center text-dark">Loading chat...</h5>');
                    //
                    initFirebase();
                    reloadConversation();
                });

                $('.conversation .search input').on('keyup', function(){
                    var q = $(this).val();
                    $.get("{{ route('student.contacts') }}?q="+q,function(contacts){
                        console.log(contacts);
                        $('.contacts ul').html(contacts);
                    })
                });
            });

            var config = {
                apiKey: "{{config('services.firebase.api_key')}}",
                authDomain: "{{config('services.firebase.auth_domain')}}",
                databaseURL: "{{config('services.firebase.database_url')}}",
                projectId: "{{config('services.firebase.project_id')}}",
                storageBucket: "{{config('services.firebase.storage_bucket')}}",
                messagingSenderId: "{{config('services.firebase.messaging_sender_id')}}"
            };
            firebase.initializeApp(config);

            var initFirebase = function(){
                // member_id = member_id.toString();
                firebase.database().ref("/messages").orderByChild("conversation_id").equalTo(convo_id).on("value", function(snapshot) {
                    reloadConversation();
                });
            }

            var scroll_bottom = function() {
                var card_height = 0;
                $('.msger-chat .msg').each(function() {
                    card_height += $(this).outerHeight();
                });
                $("main.msger-chat").scrollTop(card_height);
            }
            var reloadConversation = function(){
                $.get("{{ route('student.get.chat') }}?id="+convo_id, function(messages){
                    $('.msger-chat').html(messages);
                    scroll_bottom();
                });
            }
            $("form.msger-inputarea").submit(function(e) {
                e.preventDefault();
                var me = $(this), chat_content = me.find('[name=content]');
                // if the value of chat_content is empty
                if(chat_content.val().trim().length <= 0) {
                    chat_content.focus();
                }else{ // if the chat_content value is not empty
                    $.ajax({
                        url: '{{ route("student.save.messsage") }}',
                        data: {
                            message: chat_content.val().trim(),
                            convo_id: convo_id
                        },
                        method: 'post',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        beforeSend: function() {
                            chat_content.attr('disabled', true);
                        },
                        complete: function() {
                            chat_content.attr('disabled', false);
                        },
                        success: function() {
                            chat_content.val('');
                            chat_content.focus();
                            scroll_bottom();
                        }
                    });
                }
                return false;
            });
            initFirebase();
            reloadConversation();
        </script>
    @endif
@endsection
