@extends('web.layouts.app');
@section('content')
<section class="container clearfix">
    <div class="product w-100">
        <div class="row d-flex justify-content-center">
            <div class="product-list col-10">
                <h3 class="mb-3">TÌm kiếm: {{ $search }}</h3>
                <div class="row">
                    @foreach ($result as $movie)
                        <article class="col-md-3 col-sm-4 col-xs-6 thumb grid-item post-38424">
                            <div class="item">
                               <a class="thumb" href="/movie/{{ $movie->id }}" title="{!! $movie['name'] !!}">
                                <figure><img class="lazy img-responsive" src="/images/movies/{!! $movie['image'] !!}" alt="" title="{!! $movie['name'] !!}" style="height: 350px"></figure>
                                <span class="status
                                @if($movie->rating->name == 'C18') bg-danger
                                @elseif($movie->rating->name == 'C16') bg-warning
                                @elseif($movie->rating->name == 'P') bg-success
                                @elseif($movie->rating->name == 'K') bg-primary
                                @else bg-info
                                @endif me-1">{!! $movie->rating->name !!}</span>
                                <div class="product-info">
                                    <h2 class="product-name">{!! $movie['name'] !!}</h2>
                                    <div class="movie-info">
                                        <span class="bold">Thể loại: </span>
                                        <span class="normal">
                                            @foreach($movie->movieGenres as $genre)
                                                @if ($loop->first)
                                                    {{$genre->name}}
                                                @else
                                                    , {{ $genre->name }}
                                                @endif
                                            @endforeach
                                        </span>
                                    </div>
                                    <div class="movie-info">
                                        <span class="bold">Thời lượng: </span>
                                        <span class="normal">{!!$movie['showTime']!!}</span>
                                    </div>
                                    <div class="movie-info">
                                        <span class="bold">Khởi chiếu: </span>
                                        <span class="normal">{!! $movie['releaseDate'] !!}</span>
                                    </div>
                                </div>
                                <ul>
                                    <li class="like">
                                        <button class="btn btn-like"><i class="fa fa-thumbs-up"></i> Like 12</button>
                                    </li>
                                    <li class="booking">
                                        <button class="btn btn-booking"><i class="fa-solid fa-receipt"></i> Đặt vé</button>
                                    </li>
                                </ul>
                               </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
            <div class="product-rating col-2">
    
            </div>
        </div>
    
    </div>
</section>
@endsection