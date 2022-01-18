@foreach($list->messages as $item)
<div class="msg {{ $item->user_id == $user->id ? 'right-msg' : 'left-msg'}} ">
    @if ($item->user->role == "tutor")
        <div class="msg-img" style="background-image: url({{ asset($item->user->tutor_profile->profile_photo ?? 'default.png') }})"></div>
    @elseif ($item->user->role == "student")
        <div class="msg-img" style="background-image: url({{ asset($item->user->student_profile->profile_photo ?? 'default.png') }})"></div>
    @endif

    <div class="msg-bubble">
        <div class="msg-info">
            <div class="msg-info-name">{{ $item->user->name }}</div>
            <div class="msg-info-time">{{ $item->created_at->diffForHumans() }}</div>
        </div>

        <div class="msg-text">
            {{ $item->message }}
        </div>
    </div>
</div>
@endforeach
