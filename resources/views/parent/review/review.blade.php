@extends('layouts.parent')
@section('title', 'Rate your session')
@section('content')
<section class="dashboard-header" style="background-image: url({{ asset('theme/images/bg-contact.jpg') }});">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2><span style="color: #f26d64;">Rate your session</span></h2>
                <h6>How was the session?</h6>
            </div>
        </div>
    </div>
</section>
<section class="give-review-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h2>Rate your session!</h2>
                <form action="{{ route('parent.review.save') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $id }}">
                    <fieldset class="rating-stars">
                        <input type="radio" id="star5" name="rating" value="5"/><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                        <input type="radio" id="star4half" name="rating" value="4.5"/><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                        <input type="radio" id="star4" name="rating" value="4"/><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                        <input type="radio" id="star3half" name="rating" value="3.5"/><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                        <input type="radio" id="star3" name="rating" value="3"/><label class = "full" for="star3" title="Meh - 3 stars"></label>
                        <input type="radio" id="star2half" name="rating" value="2.5"/><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                        <input type="radio" id="star2" name="rating" value="2"/><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                        <input type="radio" id="star1half" name="rating" value="1.5"/><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                        <input type="radio" id="star1" name="rating" value="1"/><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                    </fieldset>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <label for="review">Review</label>
                        <textarea name="review" id="review" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-default btn-square">Submit</button>
                    </div>
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</section>
@endsection
