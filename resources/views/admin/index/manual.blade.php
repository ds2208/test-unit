@extends('admin._layout.layout')

@section('seo_title', "Korisnik")

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <h3 class="m-0 text-dark">{{__("Dobrodošli u Solarify internet aplikaciju, gde možete upravljati Vašim solarnim sistemom.")}}</h3>
            </div><!-- /.col -->
            <div class="col-sm-2">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.index.index')}}" style="color: blanchedalmond;">{{__("Početna")}}</a></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- /.card -->
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <!-- general form elements disabled -->
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Forma za optimizaciju</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div style="display: inline-block;">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                <label class="custom-control-label" for="customSwitch1">Optimizuj svoj solarni sistem i sačuvaj izmerene vrednosti u ovom momentu.</label>
                            </div>
                        </div>
                        <button type="button" id="manual-now-trigger" class="btn btn-info" style="display: inline-block; margin-left: 600px;">Izvrši</button>
                        <hr>
                        <div id="forms-container" style="display: none;">
                            <div class="row">
                                <div id="chose-form" class="col-lg-10">
                                    <!-- radio -->
                                    <div class="form-group">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio1" name="customRadio" checked>
                                            <label for="customRadio1" class="custom-control-label">Koristi vrednosti merenja iz baze</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio2" name="customRadio">
                                            <label for="customRadio2" class="custom-control-label">Direktno postavi vrednosti motora</label>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <form action="{{route('admin.index.manual_set_old_values')}}" method="post" id="old-params-form">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label>Custom Select</label>
                                            <select id="meast-select" class="custom-select">
                                                @foreach($meastruments as $meastrument)
                                                <option data-value-first="{{$meastrument->top_left_sensor}}" data-value-second="{{$meastrument->top_right_sensor}}" data-value-third="{{$meastrument->bottom_left_sensor}}" data-value-fourth="{{$meastrument->bottom_right_sensor}}">{{$meastrument->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="sensors-container" class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <input type="text" placeholder="Gornji levi" value="" name="top_left_sensor">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <input type="text" placeholder="Gornji desni" value="" name="top_right_sensor">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <input type="text" placeholder="Donji levi" value="" name="bottom_left_sensor">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <input type="text" placeholder="Donji desni" value="" name="bottom_right_sensor">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-1"></div>
                                    <button type="submit" id="old-params-trigger" class="btn btn-info col-sm-10">Izvrši</button>
                                </div>
                            </form>
                            <form method="post" action="{{route('admin.index.manual_set_engine_positions')}}" role="form" id="range-picker-form" style="display: none;">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input id="servo-engine-first" type="text" placeholder="Vertikalni motor" name="vertical_engine" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input id="servo-engine-second" type="text" placeholder="Horizontalni motor" name="horizontal_engine" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="customRange2" class="form-label">Vertikalni Motor</label>
                                            <input type="range" class="form-range" min="60" max="120" id="customRange1">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="customRange2" class="form-label">Horizontalni Motor</label>
                                            <input type="range" class="form-range" min="60" max="120" id="customRange2">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-1"></div>
                                    <button type="submit" id="range-picker-trigger" class="btn btn-info col-sm-10">Izvrši</button>
                                </div>
                            </form>
                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-lg-1"></div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection

@push('head_links')
<link href="{{url('/themes/admin/plugins/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('/themes/admin/plugins/jquery-ui/jquery-ui.theme.min.css')}}" rel="stylesheet" type="text/css" />
<!-- iCheck -->
<link rel="stylesheet" href="{{url('/themes/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<!-- JQVMap -->
<link rel="stylesheet" href="{{url('/themes/admin/plugins/jqvmap/jqvmap.min.css')}}">
<!-- Theme style -->
<link rel="stylesheet" href="{{url('/themes/admin/dist/css/adminlte.min.css')}}">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{url('/themes/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{url('/themes/admin/plugins/daterangepicker/daterangepicker.css')}}">
<!-- summernote -->
<link rel="stylesheet" href="{{url('/themes/admin/plugins/summernote/summernote-bs4.css')}}">


<link rel="stylesheet" href="{{url('/themes/admin/dist/css/adminlte.min.css')}}" type="text/css">
@endpush

@push('script_tags')
<script src="{{url('/themes/admin/plugins/jquery-ui/jquery-ui.min.js')}}" type="text/javascript"></script>
<!-- Bootstrap 4 -->
<script src="{{url('/themes/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{url('/themes/admin/plugins/moment/moment.min.js')}}"></script>
<script src="{{url('/themes/admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{url('/themes/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{url('/themes/admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{url('/themes/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('/themes/admin/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{url('/themes/admin/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('/themes/admin/dist/js/demo.js')}}"></script>

<script type="text/javascript">
    let automaticaly = $('#customSwitch1');
    let formContainer = $('#forms-container');
    let choseFormButton = $('#chose-form');
    //forms
    let formOldParams = $('#old-params-form');
    let formRangePicker = $('#range-picker-form');
    //trigger buttons
    let manualNowTriggerButton = $('#manual-now-trigger');

    if (automaticaly.is(':checked')) {
        formContainer.attr('style', 'display:block;');
        manualNowTriggerButton.attr('disabled', 'disabled');
    } else {
        formContainer.attr('style', 'display:none;');
        manualNowTriggerButton.removeAttr('disabled');
    }


    automaticaly.on('change', function(e) {
        if (automaticaly.is(':checked')) {
            formContainer.attr('style', 'display:block;');
            manualNowTriggerButton.attr('disabled', 'disabled');
        } else {
            formContainer.attr('style', 'display:none;');
            manualNowTriggerButton.removeAttr('disabled');
        }
    });

    choseFormButton.on('click', '[name="customRadio"]', function(e) {
        if ($('#customRadio1').is(':checked')) {
            formOldParams.attr('style', 'display:block;');
            formRangePicker.attr('style', 'display:none;');
        } else {
            formOldParams.attr('style', 'display:none;');
            formRangePicker.attr('style', 'display:block;');
        }
    });

    let selectMeasturement = $('#meast-select').on('click', function(e) {

        let inputSensor1 = $('#sensors-container input[name="top_left_sensor"]');
        let inputSensor2 = $('#sensors-container input[name="top_right_sensor"]');
        let inputSensor3 = $('#sensors-container input[name="bottom_left_sensor"]');
        let inputSensor4 = $('#sensors-container input[name="bottom_right_sensor"]');

        let sensorVal1 = $('#meast-select option').data('value-first');
        let sensorVal2 = $('#meast-select option').data('value-second');
        let sensorVal3 = $('#meast-select option').data('value-third');
        let sensorVal4 = $('#meast-select option').data('value-fourth');

        inputSensor1.val(sensorVal1)
        inputSensor2.val(sensorVal2)
        inputSensor3.val(sensorVal3)
        inputSensor4.val(sensorVal4)
    });

    let customRange1 = $('#customRange1').on('mousemove', function(e) {
        let engine1 = $('#servo-engine-first').val(customRange1.val());
    });

    let customRange2 = $('#customRange2').on('mousemove', function(e) {
        let engine2 = $('#servo-engine-second').val(customRange2.val());
    });

    manualNowTriggerButton.on('click', function(e) {
        e.preventDefault();
        $.ajax({
            "url": '{{route("admin.index.manual_set_now")}}',
            "type": "post",
            "data": {
                '_token': "{{csrf_token()}}"
            }
        }).done(function(response) {
            toastr.success(response.system_message);
            // window.location.href = "{{route('admin.index.index')}}"
        }).fail(function(xhr) {
            let systemError = "@lang('Error occured while manual optimization!')";
            if (xhr.responseJSON && xhr.responseJSON['system_error']) {
                systemError = xhr.responseJSON['system_error'];
            }
            toastr.error(systemError);
        });
    });
</script>
@endpush