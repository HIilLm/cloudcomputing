@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-9">
            <h5>Welcome to Cloud.test</h5>
        </div>
        <div class="col-3">
            <h5 class="ms-5 text-secondary">{{ date('l, d F') }}</h5>
        </div>
    </div>
    <div class="row">
        @foreach ($news as $new)
            <div class="col-md-6 col-xl-3">
                <div class="card text-bg-dark">
                    <a href="{{ route('single.page', ['news' => $new->slug]) }}" style="color: white">
                        <img src="{{ asset('storage/' . $new->cover_image) }}" style="height: 230px; width:304px; object-fit:cover"  class="card-img" alt="...">
                        <div class="card-img-overlay">
                            <h5 class="card-title">{{ $new->title }}</h5>
                            <p class="card-text">{{  substr(strip_tags($new->body) , 0, 100)  }}....</p>
                            <p class="card-text"><small>Last updated {{ $new->updated_at->diffForHumans() }}</small></p>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
