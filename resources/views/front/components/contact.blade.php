<section class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h4>Contact Info</h4>
                <p class="phone">Phone: {{$setting['phone'] ?? ""}}</p>
                <p class="email">Email: <a href="mailto:{{$setting['email']}}">{{$setting['email'] ?? ""}}</a></p>
                <p class="web">Web: <a href="http://{{$setting['email']}}">{{$setting['web'] ?? ""}}</a></p>
            </div>
            <div class="col-md-4">
                <h4>Get In Touch</h4>
                <form action="">
                    <div class="form-group">
                        <input type="text" name="name" size="40" placeholder="Your Name" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" name="email" size="40" placeholder="Your Email" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" name="phone" size="40" placeholder="Your Phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" name="message" size="40" placeholder="Your Message" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-default btn-square">Send Now</button>
                </form>
            </div>
            <div class="col-md-4">
                <h4>Quick Links</h4>
                <ul class="menu-footer">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about_us') }}">About Us</a></li>
                    <li><a href="{{ route('our_services') }}">Our Services</a></li>
                    <li><a href="{{ route('join_team') }}">Join Our Team</a></li>
                    <li><a href="{{ route('contact_us') }}">Contact Us</a></li>
                    <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
