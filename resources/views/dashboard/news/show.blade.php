@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h3 class="card-title mb-3">{{ $new->title }}</h3>
                <img src="{{ asset('storage/' . $new->cover_image) }}" style="height: 14cm; width:35cm; object-fit:cover"
                    alt="{{ $new->cover_image }}" class="img-fluid card-img-top" alt="...">
                <p class="card-text">{!! $new->body !!}</p>
                <p class="card-text"><small class="text-muted">Last updated {{ $new->updated_at->diffForHumans() }}</small>
                </p>
            </div>
        </div>

    </div>
@endsection
