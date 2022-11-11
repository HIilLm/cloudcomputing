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
                <!-- Main Body -->
                <section>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-12 pb-4">
                            <h1>Comments</h1>
                            <form id="algin-form" action="{{ route('comment.news') }}" method="POST">
                                @csrf
                                <h4>Leave a comment</h4>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="fullname" class="form-control">
                                </div>
                                <div class="form-group d-none">
                                    <label for="name">Name</label>
                                    <input type="text" value="{{ $new->id }}" name="news_id" id="fullname"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea name="message" id=""msg cols="30" rows="5" class="form-control"></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-10 me-4 pe-2">
                                    </div>
                                    <div class="col">
                                        <div class="form-group mt-2">
                                            <button type="submit" id="post" class="btn btn-primary">Post Comment
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                            @foreach ($comments as $komen)
                                <div class="comment mt-4 text-justify float-left">
                                    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png"
                                        alt="name" class="rounded-circle" width="40" height="40">
                                    <h4>{{ $komen->name }}</h4>
                                    <span>- {{ date_format($komen->updated_at, 'd F, Y') }}</span>
                                    <br>
                                    <p>{{ $komen->message }}</p>
                                    @foreach ($replies($komen->id) as $komen)
                                        <div class="mx-3">
                                            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png"
                                                alt="name" class="rounded-circle" width="40" height="40">
                                            <h4>{{ $komen->name }}</h4>
                                            <span>- {{ date_format($komen->updated_at, 'd F, Y') }}</span>
                                            <br>
                                            <p>{{ $komen->message }}</p>
                                        </div>
                                    @endforeach

                                    @auth

                                        <div class="collapse mb-4" id="collapseExample">
                                            {{-- <div class="card card-body"> --}}
                                            <form id="algin-form" action="{{ route('comment.balas', $komen->id) }}"
                                                method="POST">
                                                @csrf
                                                <div class="form-group d-none">
                                                    <label for="name">Name</label>
                                                    <input type="text" value="{{ $new->id }}" name="news_id"
                                                        id="fullname" class="form-control">
                                                    <input type="text" value="{{ $new->id }}" name="news_id"
                                                        id="fullname" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="message">Message</label>
                                                    <textarea name="message" id=""msg cols="30" rows="5" class="form-control"></textarea>
                                                </div>
                                                <div class="row">
                                                    <div class="col-10 me-4">
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group mt-2">
                                                            <button type="submit" id="post" class="btn btn-primary">Post
                                                                Comment
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </form>
                                            {{-- </div> --}}
                                        </div>

                                    @endauth
                                </div>
                                <p>
                                    <form method="post" action="{{ route('comment.hapus', ['comment' => $komen->id]) }}">
                                        @csrf
                                        @method('delete')
                                        <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample"
                                            role="button" aria-expanded="false" aria-controls="collapseExample">
                                            Balas
                                        </a>
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                    </p>
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>
        </div>

    </div>
@endsection
