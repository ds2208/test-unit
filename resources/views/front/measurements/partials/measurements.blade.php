<div class="row">
    @foreach($measurements as $measurement)
    <!-- post -->
    <div class="post col-xl-12">
        <div class="post-details">
            <div class="post-meta d-flex justify-content-between">
                <div class="date meta-last">{{$measurement->created_at}}</div>
                <div class="category"><a>{{$measurement->author->name}}</a></div>
            </div>
            <a href="{{$measurement->getFrontUrl()}}"><h3 class="h4">{{$measurement->title}}</h3></a>
            @if($measurement->status)
            <p class="text-muted">STATUS OK</p>
            @else
            <p class="text-muted">STATUS ERROR</p>
            @endif
        </div>
    </div>
    @endforeach
</div>