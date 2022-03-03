@extends('admin._layout.layout')

@section('seo_title', __('Dodaj novu reklamu'))

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>@lang('Dodaj novu reklamu')</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.index.index')}}">@lang('Početna')</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.ads.index')}}">@lang('Reklame')</a></li>
                    <li class="breadcrumb-item active">@lang('Dodaj novu reklamu')</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">@lang('Dodaj novu reklamu')</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="entity-form" role="form" action="{{route('admin.ads.insert')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>@lang("Ime")</label>
                                <input 
                                    name="title"
                                    value="{{old('title')}}"
                                    type="text" 
                                    class="form-control @if($errors->has('title')) is-invalid @endif" 
                                    placeholder="{{__('Ime')}}"
                                    >
                                @include('admin._layout.partials.form_errors', ['fieldName' => 'title'])
                            </div>
                            <div class="form-group">
                                <label>@lang("URL")</label>
                                <input 
                                    name="url"
                                    value="{{old('url')}}"
                                    type="text" 
                                    class="form-control @if($errors->has('url')) is-invalid @endif" 
                                    placeholder="{{__('Enter url')}}"
                                    >
                                @include('admin._layout.partials.form_errors', ['fieldName' => 'url'])
                            </div>
                            <div class="form-group">
                                <label>@lang("Naziv dugmeta")</label>
                                <input 
                                    name="button_title"
                                    value="{{old('button_title')}}"
                                    type="text" 
                                    class="form-control @if($errors->has('button_title')) is-invalid @endif" 
                                    placeholder="{{__('Naziv dugmeta')}}"
                                    >
                                @include('admin._layout.partials.form_errors', ['fieldName' => 'button_title'])
                            </div>
                            <div class="form-group">
                                <label>@lang("Izaberi novu fotografiju")</label>
                                <input 
                                    name="photo" 
                                    type="file" 
                                    class="form-control @if($errors->has('photo')) is-invalid @endif"
                                    >
                                @include('admin._layout.partials.form_errors', ['fieldName' => 'photo'])
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
            }
    url: {
    required: true,
            email: true,
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
</script>
@endpush