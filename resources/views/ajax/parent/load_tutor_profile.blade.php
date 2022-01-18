<div class="modal-body p-0">
    <button type="button" class="position-absolute" style="z-index: 99; right:0px; border: 0px; background: transparent;" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <div class="card position-relative">
        <img src="{{ asset($tutor->tutor_profile->profile_photo) }}" class="card-img" alt="">
        <div class="card-body">
            <div class="coach-detail">
                <div class="clearfix">
                    <div class="float-left">
                        <h5 class="mb-0">{{ $tutor->name }}</h5>
                        <small class="text-muted">{{ $tutor->tutor_profile->subjects }}</small>
                    </div>
                    <div class="float-right">
                        <h5>${{ $tutor->tutor_profile->hourly_rate }}</h5>
                    </div>
                </div>
                <p class="mt-2" style="min-height: 70px;">
                   {{ $tutor->tutor_profile->bio }}
                </p>
                <div class="rating text-right m-auto">
                    {{-- <span>4.7</span> --}}
                    <a href=""><i class="fa fa-star"></i></a>
                    <a href=""><i class="fa fa-star"></i></a>
                    <a href=""><i class="fa fa-star"></i></a>
                    <a href=""><i class="fa fa-star"></i></a>
                    <a href=""><i class="fa fa-star-half-o"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

