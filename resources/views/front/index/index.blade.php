@extends('front._layout.layout')

@section('seo_title', 'Home')
@section('seo_description', __('Welcome to our home page, enjoy in our posts!'))

@section('content')
<!-- Hero Section-->
<div id="index-slider" class="owl-carousel">
    @foreach($ads as $ad)
    <section style="background: url({{$ad->getPhotoUrl()}}); background-size: cover; background-position: center center; height: 550px" class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-10">
                    <h1>{{$ad->title}}</h1>
                    <a href="{{$ad->url}}" class="hero-link" target="_blank">{{$ad->button_title}}</a>
                </div>
            </div>
        </div>
    </section>
    @endforeach
</div>
<!-- Latest Posts -->
<section class="latest-posts">
    <div class="container">
        <header>
            <h2>Latest from the measurements</h2>
        </header>
        <div class="owl-carousel" id="latest-posts-slider">
            @foreach($latestMeasurements as $measurement)
            <div class="post col-md-4">
                <div class="post-meta d-flex justify-content-between">
                    <div class="date">{{$measurement->datePresenter()}}</div>
                </div>
                <a href="{{$measurement->getFrontUrl()}}">
                    <h3 class="h4">{{$measurement->title}}</h3>
                </a>
                <div>
                    @if($measurement->status)
                    <p class="text-muted text-success">OK</p>
                    @else
                    <p class="text-muted text-danger">ERROR</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Divider Section-->
<section style="background: url(/themes/front/contac-us.jpg); background-size: cover; background-position: center bottom" class="divider">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Welcome to our contact page. Have an interesting news or idea? Do not hesitate to contact us!</h2>
                <a href="{{route('front.contact.index')}}" class="hero-link">Contact Us</a>
            </div>
        </div>
    </div>
</section>
<!-- Intro Section-->
<section class="intro">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h2 class="h3">Some great intro here</h2>
                <p class="text-big">Place a nice <strong>introduction</strong> here <strong>to catch reader's attention</strong>.</p>
            </div>
        </div>
    </div>
</section>
<!-- Gallery Section-->
<section class="gallery no-padding">
    <div class="row">
        <div class="mix col-lg-3 col-md-3 col-sm-6">
            <div class="item">
                <a href="{{url('/themes/front/img/gallery-1.jpg')}}" data-fancybox="gallery" class="image">
                    <img src="{{url('/themes/front/img/gallery-1.jpg')}}" alt="gallery image alt 1" class="img-fluid" title="gallery image title 1">
                    <div class="overlay d-flex align-items-center justify-content-center"><i class="icon-search"></i></div>
                </a>
            </div>
        </div>
        <div class="mix col-lg-3 col-md-3 col-sm-6">
            <div class="item">
                <a href="{{url('/themes/front/img/gallery-2.jpg')}}" data-fancybox="gallery" class="image">
                    <img src="{{url('/themes/front/img/gallery-2.jpg')}}" alt="gallery image alt 2" class="img-fluid" title="gallery image title 2">
                    <div class="overlay d-flex align-items-center justify-content-center"><i class="icon-search"></i></div>
                </a>
            </div>
        </div>
        <div class="mix col-lg-3 col-md-3 col-sm-6">
            <div class="item">
                <a href="{{url('/themes/front/img/gallery-3.jpg')}}" data-fancybox="gallery" class="image">
                    <img src="{{url('/themes/front/img/gallery-3.jpg')}}" alt="gallery image alt 3" class="img-fluid" title="gallery image title 3">
                    <div class="overlay d-flex align-items-center justify-content-center"><i class="icon-search"></i></div>
                </a>
            </div>
        </div>
        <div class="mix col-lg-3 col-md-3 col-sm-6">
            <div class="item">
                <a href="{{url('/themes/front/img/gallery-4.jpg')}}" data-fancybox="gallery" class="image">
                    <img src="{{url('/themes/front/img/gallery-4.jpg')}}" alt="gallery image alt 4" class="img-fluid" title="gallery image title 4">
                    <div class="overlay d-flex align-items-center justify-content-center"><i class="icon-search"></i></div>
                </a>
            </div>
        </div>

    </div>
</section>
@endsection

@push('links')
<!-- owl carousel 2 stylesheet-->
<link rel="stylesheet" href="{{url('/themes/front/plugins/owl-carousel2/assets/owl.carousel.min.css')}}" id="theme-stylesheet">
<link rel="stylesheet" href="{{url('/themes/front/plugins/owl-carousel2/assets/owl.theme.default.min.css')}}" id="theme-stylesheet">
@endpush

@push('scripts')
<script src="{{url('/themes/front/plugins/owl-carousel2/owl.carousel.min.js')}}" type="text/javascript"></script>
<script>
    $("#index-slider").owlCarousel({
        "items": 1,
        "loop": true,
        "autoplay": true,
        "autoplayHoverPause": true
    });

    $("#latest-posts-slider").owlCarousel({
        "items": 3,
        "loop": true,
        "autoplay": true,
        "autoplayHoverPause": true
    });
</script>
@endpush