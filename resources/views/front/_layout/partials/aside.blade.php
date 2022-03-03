<aside id="content-maker" class="col-lg-4">
    <!-- Widget [Search Bar Widget]-->
    <div class="widget search">
        <header>
            <h3 class="h6">{{__("Search the measurements")}}</h3>
        </header>
        <form action="{{route('front.search.index')}}" method="get">
            <div class="form-group">
                <input 
                    type="search" 
                    placeholder="{{__('What are you looking for?')}}"
                    name="search"
                    value="{{old('search')}}"
                    >
                <button type="submit" class="submit"><i class="icon-search"></i></button>
            </div>
        </form>
    </div>
    <!-- Widget [Latest Posts Widget] -->
    <div class="widget latest-posts">
        <header>
            <h3 class="h6">{{__("Latest Measurements")}}</h3>
        </header>
        <!-- Widget [Measurements Widget]-->
        <div class="widget measurement">
            <header>
                <h3 class="h6">{{__("List")}}</h3>
            </header>
            @foreach($latestMeasurements as $measurement)
            <div class="item d-flex justify-content-between">
                <a href="{{$measurement->getFrontUrl()}}" class="Measurement-link">
                    {{$measurement->title}}
                </a>
                @if($measurement->status)
                <span style="color: green;">OK</span>
                @else
                <span style="color: red;">ERROR</span>
                @endif
            </div>
            @endforeach
        </div>
</aside>