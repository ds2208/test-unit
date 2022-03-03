@extends('front._layout.layout')

@section('seo_title', $measurement->title)

@section('content')
<div class="container">
    <div class="row">
        <!--Measurement post -->
        <main class="post measurement col-lg-8">
            <div class="container">
                <div class="post-single">
                    <div class="post-details">
                        <h1>{{$measurement->title}}<a href="#"><i class="fa fa-bookmark-o"></i></a></h1>
                        <div class="post-footer d-flex align-items-center flex-column flex-sm-row"><a href="" class="author d-flex align-items-center flex-wrap">
                                <div class="avatar"><img src="{{$measurement->author->getPhotoUrl()}}" alt="..." class="img-fluid"></div>
                                <div class="title"><span>{{$measurement->author->name}}</span></div>
                            </a>
                            <div class="d-flex align-items-center flex-wrap">
                                <div class="date"><i class="icon-clock"></i>{{$measurement->dateInAgoFormat()}}</div>
                                <div class="comments meta-last"><a href="#post-comments"><i class="icon-comment"></i>{{$measurement->comments()->count()}}</a></div>
                            </div>
                        </div>
                        <div class="post-body">
                            <table class="table" style="margin-top: 50px; background-color: lightcyan;">
                                <thead>
                                    <tr>
                                        <td>Light sensor 1</td>
                                        <td>Light sensor 2</td>
                                        <td>Light sensor 3</td>
                                        <td>Light sensor 4</td>
                                        <td>Engine 1</td>
                                        <td>Engine 2</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($measurement->getSyncShowFront() as $single)
                                   <tr style=" padding: 10px;">
                                       <td>{{$single[0]}}</td>
                                       <td>{{$single[1]}}</td>
                                       <td>{{$single[2]}}</td>
                                       <td>{{$single[3]}}</td>
                                       <td>{{$single[4] % 1000}}</td>
                                       <td>{{($single[5] % 1000)}}</td>
                                   </tr>
                                   @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>Light sensor 1</td>
                                        <td>Light sensor 2</td>
                                        <td>Light sensor 3</td>
                                        <td>Light sensor 4</td>
                                        <td>Engine 1</td>
                                        <td>Engine 2</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="post-tags">
                        <span class="tag">{{$measurement->title}}</span>
                        @if($measurement->status)
                        <span class="tag">Status OK</span>
                        @else
                        <span class="tag">Status Eror</span>
                        @endif
                        <span class="tag">{{$measurement->author->email}}</span>
                        </div>
                        <hr>
                        <div class="comment-container">
                            
                        </div>
                        <div class="add-comment">
                            <header>
                                <h3 class="h6">{{__("Leave a reply")}}</h3>
                            </header>
                            <form id="form-add-comments" action="{{route('front.measurements.add_comment')}}" class="commenting-form" method="post">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <input type="text" name="name" value="" id="username" placeholder="{{__('Name')}}" class="form-control">
                                        @include('front._layout.partials.form_errors', ['fieldName' => 'name'])
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="email" name="email" value="" id="useremail" placeholder="@lang('Email Address (will not be published)')" class="form-control">
                                        @include('front._layout.partials.form_errors', ['fieldName' => 'email'])
                                    </div>
                                    <div class="form-group col-md-12">
                                        <textarea name="content" id="usercomment" placeholder="@lang('Type your comment')" class="form-control"></textarea>
                                        @include('front._layout.partials.form_errors', ['fieldName' => 'content'])
                                    </div>
                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-secondary" data-action='add_comment' data-measurement-id="{{$measurement->id}}">{{__("Submit Comment")}}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        @include('front._layout.partials.aside')
    </div>
</div>
@endsection

@push('scripts')
<script src="{{url('/themes/front/js/jquery.validate.min.js')}}" type="text/javascript"></script>
<script src="{{url('/themes/front/js/additional-methods.min.js')}}" type="text/javascript"></script>

<script type="text/javascript">
    function commentContainerRefresh() {
        $.ajax({
            "url": "{{route('front.measurements.partials.comments')}}",
            "type": "post",
            "data": {
                '_token': "{{csrf_token()}}",
                'measurement_id': "{{$measurement->id}}"
            }
        }).done(function(response) {
            $('.comment-container').html(response);
        }).fail(function(jqXHR, textStatus, error) {
            console.log('Error!');
        });
    }

    commentContainerRefresh();

    function addComment(measurement_id, name, email, content) {
        $.ajax({
            "url": "{{route('front.measurements.add_comment')}}",
            "type": "post",
            "data": {
                '_token': "{{csrf_token()}}",
                'measurement_id': measurement_id,
                'name': name,
                'email': email,
                'content': content
            }
        }).done(function(response) {
            $('#username').val('');
            $('#useremail').val('');
            $('#usercomment').val('');
            let systemMessage = "Success, you added new comment!";
            if (systemMessage !== "") {
                toastr.success(response.systemMessage);
            }
            commentContainerRefresh();
        }).fail(function(jqXHR, textStatus, error) {
            let systemError = "Your parameters are invalid!";
            if (systemError !== "") {
                toastr.error(systemError);
            }
        });
    }

    $(".add-comment").on('click', "[data-action='add_comment']", function(e) {
        e.preventDefault();
        //e.stopPropagation();

        let measurement_id = $(this).attr('data-measurement-id');
        let name = $('#username').val();
        let email = $('#useremail').val();
        let content = $('#usercomment').val();

        addComment(measurement_id, name, email, content);

    });

    $('#form-add-comments').validate({
        rules: {
            name: {
                required: true,
                rangelength: [2, 50]
            },
            email: {
                required: true,
                email: true,
                maxlength: 255
            },
            content: {
                required: true,
                rangelength: [50, 500]
            }
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
</script>
@endpush