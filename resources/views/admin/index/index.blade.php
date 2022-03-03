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
            <div class="col-lg-6">
                <div class="card bg-gradient-success">
                    <div class="card-header border-0">

                        <h3 class="card-title">
                            <i class="far fa-calendar-alt"></i>
                            Kalendar
                        </h3>
                        <!-- tools card -->
                        <div class="card-tools">
                            <!-- button with a dropdown -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                                    <i class="fas fa-bars"></i></button>
                                <div class="dropdown-menu float-right" role="menu">
                                    <a href="#" class="dropdown-item">Dodaj merenje</a>
                                    <a href="#" class="dropdown-item">Obriši sva zakazivanja</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" class="dropdown-item">Pogledaj kalendar</a>
                                </div>
                            </div>
                            <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <!-- /. tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body pt-0">
                        <!--The calendar -->
                        <div id="calendar" style="width: 100%"></div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{__("Optimizuj svoj solarni sistem")}}</h5>

                        <p class="card-text">
                            {{__("Izaberite opciju za izvršavanje merenja i optimizacije.")}}
                        </p>

                        <div class="form-group">
                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                <input type="checkbox" @if(session()->has('auto_active')) checked @endif class="custom-control-input" id="customSwitch3">
                                <label class="custom-control-label" for="customSwitch3">Automatski</label>
                            </div>
                        </div>
                        <a href="{{route('admin.index.manual_set')}}" class="btn btn-primary">Manuelno</a>
                    </div>
                </div>
            </div>
            <!-- /.col-md-6 -->
            <div class="col-lg-6">
                <!-- Map card -->
                <div class="card bg-gradient-primary">
                    <div class="card-header border-0">
                        <h3 class="card-title">
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            Mrenja po regionu
                        </h3>
                        <!-- card tools -->
                        <div class="card-tools">
                            <button type="button" class="btn btn-primary btn-sm daterange" data-toggle="tooltip" title="Date range">
                                <i class="far fa-calendar-alt"></i>
                            </button>
                            <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <div class="card-body">
                        <div id="world-map" style="height: 250px; width: 100%;"></div>
                    </div>
                    <!-- /.card-body-->
                    <div class="card-footer bg-transparent">
                        <div class="row">
                            <div class="col-4 text-center">
                                <div id="sparkline-1"></div>
                                <div class="text-white">Merenja</div>
                            </div>
                            <!-- ./col -->
                            <div class="col-4 text-center">
                                <div id="sparkline-2"></div>
                                <div class="text-white">Trenutno</div>
                            </div>
                            <!-- ./col -->
                            <div class="col-4 text-center">
                                <div id="sparkline-3"></div>
                                <div class="text-white">Automatski</div>
                            </div>
                            <!-- ./col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.card -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Merenja</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">Pogledaj sva merenja</h6>

                        <p class="card-text">Na klik dugmeta ispod, možete videti sve informacije o predhodnim merenjima.</p>
                        <a href="{{route('admin.measurements.index')}}" class="btn btn-primary">Pogledaj listu merenja</a>
                    </div>
                </div>
            </div>
            <!-- /.col-md-6 -->
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
<script src="{{url('/themes/admin/plugins/chart.js/Chart.min.js')}}" type="text/javascript"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{url('/themes/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{url('/themes/admin/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{url('/themes/admin/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{url('/themes/admin/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{url('/themes/admin/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{url('/themes/admin/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{url('/themes/admin/plugins/moment/moment.min.js')}}"></script>
<script src="{{url('/themes/admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{url('/themes/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{url('/themes/admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{url('/themes/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- bs-custom-file-input -->
<script src="{{url('/themes/admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('/themes/admin/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{url('/themes/admin/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('/themes/admin/dist/js/demo.js')}}"></script>

<script type="text/javascript">
  

  
  
  let automaticaly = $('#customSwitch3')
    automaticaly.on('change', function(e) {
        let onOff
        if (automaticaly.is(':checked')){
            onOff = 1;
        } else {
            onOff = 0;
        }
        $.ajax({
            "url": '{{route("admin.index.auto_set")}}',
            "type": "post",
            "data": {
                '_token': "{{csrf_token()}}",
                'onOff': onOff
            }
        }).done(function (response) {
            toastr.success(response.system_message);
            automaticaly.is(checked)
        }).fail(function (xhr) {
            let systemError = "@lang('Desila se greška prilikom uključivanja automatske optimizacije!')";
            if (xhr.responseJSON && xhr.responseJSON['system_error']) {
                systemError = xhr.responseJSON['system_error'];
            }
            toastr.error(systemError);
        });
        
        

    });
</script>
@endpush