@extends('layouts.front')
@section('title', 'Contact Us')
@section('content')
<section class="page-hero-section" style="background-image: url({{ asset('theme/images/contact.jpg') }});">
    <div class="page-hero-text-wrapper">
        <h2>Contact Us</h2>
    </div>
    <a href="#main" class="angle-scrolldown"><i class="fa fa-angle-down"></i></a>
</section>
<div id="main"></div>

<section class="send-us-message" style="background-image: url({{ asset('theme/images/bg-contact.jpg') }});">
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="send-us-message-form">
                    <h6 class="text-center">Contact Us</h6>
                    <h2 class="text-center mb-4">Send Us a <span style="color: #f26d64;">Message.</span></h2>
                    <p class="text-center mb-5">We’d love to hear from you and answer any questions you may have! Reach out to us using the form and we’ll respond as soon as we can.</p>
                    @if(Session::has('success'))
                        <p class="text-center mb-5">{{Session::get('success')}}</p>
                    @endif
                    <form action="" id="contact_form">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Your Name:</label>
                                    <input type="text" name="name" size="191" id="name" class="form-control valid-form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone_number">Phone Number:</label>
                                    <input type="text" name="phone_number" size="191" id="phone_number" class="form-control valid-form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email">Email Address:</label>
                                    <input type="email" name="email" size="191" id="student_name" class="form-control valid-form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="other_comments">Other Comments:</label>
                                    <textarea name="other_comments" id="other_comments" class="form-control valid-form-control" rows="7"></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-default btn-square contact_btn">Submit</button>
                    </form>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
        <div class="mt-5"></div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <div class="blue-box">
                    <div class="media">
                        <div class="media-left mr-4">
                            <i class="fa fa-envelope-o"></i>
                        </div>
                        <div class="media-body">
                            <h4>Email Us</h4>
                            <a href="mailto:contact@toontutors.ca">contact@toontutors.ca</a>
                            <div class="mb-4"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="blue-box">
                    <div class="media">
                        <div class="media-left mr-4">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="media-body">
                            <h4>Call Us</h4>
                            <a href="(780) 974-6481">(780) 974-6481</a>
                            <div class="mb-4"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
        <div class="mt-3"></div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="pink-box">
                    <div class="media">
                        <div class="media-left mr-4">
                            <i class="fa fa-home"></i>
                        </div>
                        <div class="media-body">
                            <h4>Our Location</h4>
                            <p>Headquartered in Edmonton. Serving students across Canada</p>
                            <div class="mb-4"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</section>

<section class="map">
    <div class="mapouter">
        <div class="gmap_canvas">
            <iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=university%20of%20san%20francisco&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
        </div>
    </div>
</section>

@include('front.components.contact')

@endsection

@section('js')
    <script>

        function validate() {
            var valid = true;
            $("form").find('.alert-warning').remove();
            $(".valid-form-control:visible").each(function () {
                if ($(this).val() == "") {
                    $(this).closest("div").find(".alert-danger").remove();
                    $(this) .closest("div")
                    .append('<div class="alert-danger mb-2">This filed is required</div>');
                    valid = false;
                } else {
                    $(this).closest("div").find(".alert-danger").remove();
                }
            });
            if (!valid) {
                $("html, body").animate(
                {
                    scrollTop: $(".alert-danger:first").offset().top-80,
                },
                100
              );
            }
            return valid;
        }

        $(document).on("click", '.contact_btn', function(){
          var form = $('#contact_form').serialize();
          if(validate())
          {
              $.ajax({
                  type: "POST",
                  url: "{{ route('contact_us') }}",
                  data: form,
                  success: function (response) {
                       window.location.reload(true);
                  },
              });
          }
        });
    </script>
@endsection
