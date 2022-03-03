@extends('front._layout.layout')

@section('seo_title', __('Blogs'))
@section('seo_description', __('Welcome to our blogs page, enjoy in our blogs!'))

@section('content')
<div class="container">
    <div class="row">
        <!--Posts -->
        <main class="posts-listing col-lg-8">
            <div class="container">
                @include('front.measurements.partials.measurements', ['measurements' => $measurements])
            </div>
        </main>
        @include('front._layout.partials.aside')
    </div>
</div>
@endsection