x`<footer class="main-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="logo">
                    <h6 class="text-white">{{__("SOLARIFY")}}</h6>
                </div>
                <div class="contact-details">
                    <p>@lang("14 Aleksandra Medvedeva, Niš, Serbia")</p>
                    <p>@lang("Phone: (060) 4 94 22 08")</p>
                    <p>@lang("Email:") <a href="mailto:info@company.com">danilo.strahinovic@elfak.com</a></p>
                    <ul class="social-menu">
                        <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-behance"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="menus d-flex">
                    <ul class="list-unstyled">
                        <li> <a href="{{route('front.index.index')}}">{{__("Home")}}</a></li>
                        <li> <a href="{{route('front.measurements.index')}}">{{__("Measurements")}}</a></li>
                        <li> <a href="{{route('front.contact.index')}}">{{__("Contact")}}</a></li>
                        <li> <a href="{{route('login')}}">{{__("Login")}}</a></li>
                    </ul>
                    <ul class="list-unstyled">

                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="latest-posts">
                    @foreach($footerMeasurements as $measurement)
                    <li> <a href="{{$measurement->getFrontUrl()}}">{{$measurement->title}}</a></li>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="copyrights">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>&copy;{{__("2021. All rights reserved. Your great site.")}}</p>
                </div>
                <div class="col-md-6 text-right">
                    <p>{{__("Template By")}} | <a href="https://bootstrapious.com/p/bootstrap-carousel" class="text-white">{{__("SOLARIFY")}}</a>
                        <!-- Please do not remove the backlink to Bootstrap Temple unless you purchase an attribution-free license @ Bootstrap Temple or support us at http://bootstrapious.com/donate. It is part of the license conditions. Thanks for understanding :)                         -->
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>