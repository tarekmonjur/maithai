@extends('frontend.layouts.app')

@push('style')
    <link rel="stylesheet" href="{{asset('frontend/css/about.css')}}">
@endpush

@section('main_content')

    <!----------- Contact Section ----------->
    <section id="contact-us">
        <div id="add-restaurant" class="add-restaurant mb-5 mt-5 container">
            <form action="">
                <div class="row mb-5">
                    <div class="col-md-12 text-center mt-5 d-block">
                        <h2 class="text-capitalize contact-title">To Get contact with MaiThai add your message...</h2>
                        <p class="text-capitalize">come & contact with us</p>
                        <div class="underline mt-3 m-auto"
                             style="border-bottom: 4px solid tomato; width: 5rem; padding-top: 15px;"></div>
                    </div>
                </div>

                <!-- First Name, Last Name & Email -->
                <div class="row">
                    <div class="col-md-4 form-group">
                        <input type="text" class="form-control" placeholder="First Name">
                    </div>
                    <div class="col-md-4 form-group">
                        <input type="text" placeholder="Last Name" class="form-control">
                    </div>
                    <div class="col-md-4 form-group">
                        <input type="email" placeholder="Email" class="form-control">
                    </div>
                </div>

                <!-- Phone No, City, Address -->
                <div class="row">
                    <div class="col-md-4 form-group">
                        <input type="text" class="form-control" placeholder="Phone No.">
                    </div>
                    <div class="col-md-4 form-group">
                        <input type="text" placeholder="City" class="form-control">
                    </div>
                    <div class="col-md-4 form-group">
                        <input type="text" placeholder="Address" class="form-control">
                    </div>
                </div>

                <!-- Describe About Restaurant TextArea -->
                <div class="row">
                    <div class="col-md-12 form-group">
                        <textarea name="description" id="description" cols="" rows="10" placeholder="Your Message..."
                                  class="form-control"></textarea>
                    </div>
                </div>

                <!-- Submit Detail Button -->
                <div class="row d-flex justify-content-center">
                    <div>
                        <button type="submit" class="btn btn-lg text-light text-uppercase">submit your details</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <br>
    <hr>

    <!--------------- CONTACT US ---------------->
    <section class="jumbotron contact-jumbo mb-4">
        <div class="container">
            <!-- 1st Row -->
            <div class="row">
                <div class="col-md-12 text-center mb-5 d-block">
                    <h2 class="text-capitalize contact-title">contact us</h2>
                    <p class="text-capitalize">for any queries or concerns</p>
                    <div class="underline mt-3 m-auto"
                         style="border-bottom: 4px solid tomato; width: 5rem; padding-top: 15px;"></div>
                </div>
            </div>
            <!-- 2nd Row -->
            <div class="row text-center">
                <div class="col-md-4 d-block contact-col">
                    <div class="rounded-contact-icon m-auto">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h6 class="font-weight-bold">Address</h6>
                    <p class="text-muted">
                        37 High street Cheshunt, Waltham Cross, EN80BS, UK
                    </p>
                    <br>
                </div>
                <div class="col-md-4 d-block contact-col">
                    <div class="rounded-contact-icon m-auto">
                        <i class="fas fa-phone"></i>
                    </div>
                    <h6 class="font-weight-bold">Telephone</h6>
                    <p class="text-muted">
                        01992 641133
                    </p>
                    <br>
                </div>
                <div class="col-md-4 d-block contact-col">
                    <div class="rounded-contact-icon m-auto">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h6 class="font-weight-bold">Email</h6>
                    <p class="text-muted">
                        maithaikitchen@hotmail.com
                    </p>
                    <br>
                </div>
            </div>
        </div>
    </section>
    <br>

    <!-------------- Google Map API ---------->
    <div id="googleMap" class="map-container">
        <div id="map" style="height: 500px; width: 100%; overflow: hidden !important;"></div>
    </div>

@endsection

@push('script')
    <!--*********** FOR GOOOGLE MAP API ************-->
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtML-Aqf_jzSjvmI719z8OKabwtrWaW9Y&callback=initMap"></script>

    <!-- Map Initializing with javascript -->
    <script type="text/javascript">
      function initMap() {
        var location = {
          lat: 51.709474,
          lng: -0.036383
        };

        //Initialized map with latLng...
        var map = new google.maps.Map(document.getElementById("map"), {
          zoom: 20,
          center: location
        });

        //Fixed Marker for map on direction..
        var marker = new google.maps.Marker({
          position: location,
          map: map
        });
      }
    </script>
@endpush