<section class="callus-section" style="background-image: url({{ asset('theme/images/bg.jpg') }});">
    <div class="container text-center">
        <div class="row">
            <div class="col-12">
                <h4>Email Us: {{$setting['call_us'] ?? ""}}</h4>
                <h2>{{$setting['question'] ?? ""}}</h2>
                <p>{{$setting['question_sub_heading'] ?? ""}}</p>
                <a href="{{route('join_team')}}" class="btn btn-bordered-danger btn-large btn-primary-rounded">Join Our Team Now</a>
            </div>
        </div>
    </div>
</section>
