@extends('admin._layout.layout')

@section('seo_title', __('Edit Measurement'))

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>@lang('Edit Measurement')</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.index.index')}}">@lang('Home')</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.measurements.index')}}">@lang('Measurements')</a></li>
                    <li class="breadcrumb-item active">@lang('Promena merenih vrednosti')</li>
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
                        <h3 class="card-title">@lang("Promena merenih vrednosti"): #{{$measurement->id}} - {{$measurement->title}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="entity-form" role="form" action="{{route('admin.measurements.update', ['measurement' => $measurement->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                        <div class="card-body">
                            <div class="form-group">
                                <label>@lang("Naziv")</label>
                                <input 
                                    name="title"
                                    value="{{old('title', $measurement->title)}}"
                                    type="text" 
                                    class="form-control @if($errors->has('title')) is-invalid @endif" 
                                    placeholder="{{__('Naziv')}}"
                                    >
                                @include('admin._layout.partials.form_errors', ['fieldName' => 'title'])
                            </div>
                            <div class="form-group">
                                <label>@lang("Gornji levi senzor")</label>
                                <input 
                                    name="top_left_sensor"
                                    value="{{old('top_left_sensor', $measurement->top_left_sensor)}}"
                                    type="text" 
                                    class="form-control @if($errors->has('top_left_sensor')) is-invalid @endif" 
                                    placeholder="{{__('Gornji levi senzor')}}"
                                    >
                                @include('admin._layout.partials.form_errors', ['fieldName' => 'top_left_sensor'])
                            </div>
                            <div class="form-group">
                                <label>@lang("Gornji desni senzor")</label>
                                <input 
                                    name="top_right_sensor"
                                    value="{{old('top_right_sensor', $measurement->top_right_sensor)}}"
                                    type="text" 
                                    class="form-control @if($errors->has('top_right_sensor')) is-invalid @endif" 
                                    placeholder="{{__('Gornji desni senzor')}}"
                                    >
                                @include('admin._layout.partials.form_errors', ['fieldName' => 'top_right_sensor'])
                            </div>
                            <div class="form-group">
                                <label>@lang("Donji levi senzor")</label>
                                <input 
                                    name="bottom_left_sensor"
                                    value="{{old('bottom_left_sensor', $measurement->bottom_left_sensor)}}"
                                    type="text" 
                                    class="form-control @if($errors->has('bottom_left_sensor')) is-invalid @endif" 
                                    placeholder="{{__('Donji levi senzor')}}"
                                    >
                                @include('admin._layout.partials.form_errors', ['fieldName' => 'bottom_left_sensor'])
                            </div>
                            <div class="form-group">
                                <label>@lang("Donji desni senzor")</label>
                                <input 
                                    name="bottom_right_sensor"
                                    value="{{old('bottom_right_sensor', $measurement->bottom_right_sensor)}}"
                                    type="text" 
                                    class="form-control @if($errors->has('bottom_right_sensor')) is-invalid @endif" 
                                    placeholder="{{__('Donji desni senzor')}}"
                                    >
                                @include('admin._layout.partials.form_errors', ['fieldName' => 'bottom_right_sensor'])
                            </div>
                            <div class="form-group">
                                <label>@lang('Autori')</label>
                                <select name="user_id" class="form-control @if($errors->has('user_id')) is-invalid @endif">
                                    <option value="">-- Izaberi autora --</option>
                                    @foreach($authors as $author)
                                    <option 
                                        value="{{$author->id}}"
                                        @if($author->id == old('user_id', $measurement->    user_id))
                                        selected
                                        @endif
                                        >{{$author->name}}</option>
                                    @endforeach
                                </select>
                                @include('admin._layout.partials.form_errors', ['fieldName' => 'user_id'])
                            </div>
                            <div class="form-group">
                                <label>@lang("Status")</label>
                                <p></p>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input 
                                        type="radio" 
                                        id="status-no" 
                                        name="status" 
                                        class="custom-control-input"
                                        value="0"
                                        @if(0 == old('status', $measurement->status))
                                        checked
                                        @endif
                                        >
                                    <label class="custom-control-label" for="status-no">@lang("Greška")</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input 
                                        type="radio" 
                                        id="status-yes" 
                                        name="status" 
                                        value="1"
                                        class="custom-control-input"
                                        @if(1 == old('status', $measurement->status))
                                        checked
                                        @endif
                                        >
                                    <label class="custom-control-label" for="status-yes">@lang("OK")</label>
                                </div>
                                <div style="display: none;" class="form-control @if($errors->has('status')) is-invalid @endif">
                                </div>
                                @include('admin._layout.partials.form_errors', ['fieldName' => 'status'])
                            </div>
                            <div class="form-group">
                                <label>@lang("Vertikalni motor")</label>
                                <input 
                                    name="vertical_engine"
                                    value="{{old('vertical_engine', $measurement->vertical_engine)}}"
                                    type="text" 
                                    class="form-control @if($errors->has('vertical_engine')) is-invalid @endif" 
                                    placeholder="{{__('Vertikalni motor')}}"
                                    >
                                @include('admin._layout.partials.form_errors', ['fieldName' => 'vertical_engine'])
                            </div>
                            <div class="form-group">
                                <label>@lang("Horizontalni motor")</label>
                                <input 
                                    name="horizontal_engine"
                                    value="{{old('horizontal_engine', $measurement->horizontal_engine)}}"
                                    type="text" 
                                    class="form-control @if($errors->has('horizontal_engine')) is-invalid @endif" 
                                    placeholder="{{__('Horizontalni motor')}}"
                                    >
                                @include('admin._layout.partials.form_errors', ['fieldName' => 'horizontal_engine'])
                            </div>
                        </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">@lang('Sačuvaj')</button>
                            <a href="{{route('admin.measurements.index')}}" class="btn btn-outline-secondary">@lang('Prekini')</a>
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
</script>
@endpush