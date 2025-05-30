@extends('layouts.frontend.app')
@section('body')

    <!-- Contact Start -->
    <div class="contact">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="contact-form">
                        <form action="{{route('frontend.contact.store')}}" method="POST">
                          @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input name="name" type="text" class="form-control" placeholder="Your Name" />
                                    @error('name')
                                     <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="email" name="email" class="form-control" placeholder="Your Email" />
                                    @error('email')
                                     <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                  <input type="text" name="title" class="form-control" placeholder="title" />
                                  @error('title')
                                  <strong class="text-danger">{{ $message }}</strong>
                                  @enderror
                                </div>

                                <div class="form-group col-md-6">
                                  <input type="text" name="phone" class="form-control" placeholder="Your Phone" />
                                  @error('phone')
                                     <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                              </div>

                            </div>
                            <div class="form-group">
                                <textarea name="body" class="form-control" rows="5" placeholder="Message"></textarea>
                            </div>

                             @error('body')
                                  <strong class="text-danger">{{ $message }}</strong>
                                 @enderror
                            <div>
                                <button class="btn" type="submit">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-info">
                        <h3>Get in Touch</h3>
                        <p class="mb-4">
                            The contact form is currently inactive. Get a functional and
                            working contact form with Ajax & PHP in a few minutes. Just copy
                            and paste the files, add a little code and you're done.
                            <a href="https://htmlcodex.com/contact-form">Download Now</a>.
                        </p>
                        <h4><i class="fa fa-map-marker"></i>{{ $getSetting->street }} , {{ $getSetting->city }} ,
                            {{ $getSetting->country }}</h4>
                        <h4><i class="fa fa-envelope"></i>{{ $getSetting->email }}</h4>
                        <h4><i class="fa fa-phone"></i>+{{ $getSetting->phone }}</h4>
                        <div class="social">
                            <a href="{{ $getSetting->twitter }}"><i class="fab fa-twitter"></i></a>
                            <a href="{{ $getSetting->facebook }}"><i class="fab fa-facebook-f"></i></a>
                            <a href="{{ $getSetting->instagram }}"><i class="fab fa-instagram"></i></a>
                            <a href="{{ $getSetting->youtupe }}"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
