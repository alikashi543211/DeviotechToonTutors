@foreach($converstaions as $item)
<li class="contact" data-convo_id="{{ $item->id }}">
    <div class="wrap">
        <img src="{{ asset($item->student_user->student_profile->profile_photo ?? 'default.png') }}" alt="" />
        <div class="meta">
            <p class="name">{{ $item->student_user->name }}</p>
        </div>
    </div>
</li>
@endforeach
