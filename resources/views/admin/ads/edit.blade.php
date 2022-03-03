@extends('admin._layout.layout')

@section('seo_title', __('Izmeni reklamu'))

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>@lang('Izmeni reklamu')</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.index.index')}}">@lang('Početna')</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.ads.index')}}">@lang('Reklame')</a></li>
                    <li class="breadcrumb-item active">@lang('Izmeni reklamu')</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">@lang("Promena reklame"): #{{$ad->id}} - {{$ad->title}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="entity-form" role="form" action="{{route('admin.ads.update', ['ad' => $ad->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang("Naziv")</label>
                                        <input 
                                            name="title"
                                            value="{{old('title', $ad->title)}}"
                                            type="text" 
                                            class="form-control @if($errors->has('title')) is-invalid @endif" 
                                            placeholder="{{__('Naziv')}}"
                                            >
                                        @include('admin._layout.partials.form_errors', ['fieldName' => 'title'])
                                    </div>
                                    <div class="form-group">
                                        <label>@lang("URL")</label>
                                        <input 
                                            name="url"
                                            value="{{old('url', $ad->url)}}"
                                            type="text" 
                                            class="form-control @if($errors->has('url')) is-invalid @endif" 
                                            placeholder="{{__('Url')}}"
                                            >
                                        @include('admin._layout.partials.form_errors', ['fieldName' => 'url'])
                                    </div>
                                    <div class="form-group">
                                        <label>@lang("Naziv dugmeta")</label>
                                        <input 
                                            name="button_title"
                                            value="{{old('button_title', $ad->button_title)}}"
                                            type="text" 
                                            class="form-control @if($errors->has('button_title')) is-invalid @endif" 
                                            placeholder="{{__('Naziv dugmeta')}}"
                                            >
                                        @include('admin._layout.partials.form_errors', ['fieldName' => 'button_title'])
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('Izaberi fotografiju')</label>
                                        <input 
                                            name="photo" 
                                            type="file" 
                                            class="form-control @if($errors->has('photo')) is-invalid @endif"
                                            >
                                        @include('admin._layout.partials.form_errors', ['fieldName' => 'photo'])
                                    </div>
                                </div>
                                <div class="offset-md-1 col-md-5">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>@lang("Fotografija")</label>

                                                <div class="text-right">
                                                    <button 
                                                        type="button" 
                                                        class="btn btn-sm btn-outline-danger"
                                                        data-action="delete_photo"
                                                        >
                                                        <i class="fas fa-remove"></i>
                                                        @lang("Obriši fotografiju")
                                                    </button>
                                                </div>
                                                <div class="text-center">
                                                    <img 
                                                        src="{{url($ad->getPhotoUrl())}}" 
                                                        alt="" 
                                                        class="img-fluid"
                                                        data-container='photo-preview'
                                                        >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">@lang('Sačuvaj')</button>
                            <a href="{{route('admin.ads.index')}}" class="btn btn-outline-secondary">@lang('Prekini')</a>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@push('script_tags')
<script type="text/javascript">

    $('#entity-form').validate({
        rules: {
            title: {
                required: true,
                maxlength: 50
            },
            button_title: {
                required: true,
                minlength: 2,
                maxlength: 20
            },
            url: {
                required: true,
                url: true,
                maxlength: 255
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });






    $('#entity-form').on('click', '[data-action="delete_photo"]', function (e) {
        e.preventDefault();
        $.ajax({
            "url": "{{route('admin.ads.delete_photo', ['ad' => $ad->id])}}",
            "type": "post",
            "data": {
                "_token": "{{csrf_token()}}"
            }
        }).done(function (response) {
            toastr.success(response.system_message);
            $("[data-container='photo-preview']").attr('src', response.photo);
        }).fail(function () {
            toastr.error('Something is wrong');
        });
    });
</script>
@endpush