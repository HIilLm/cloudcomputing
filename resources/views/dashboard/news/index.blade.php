@extends('layouts.dashboard')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <a href="{{ route('news.create') }}" class="btn btn-primary">Add</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Cover Image</th>
                        <th scope="col">Title</th>
                        <th scope="col">Body</th>
                        <th scope="col">Option</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($news as $new)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td><img src="{{ asset('storage/' . $new->cover_image) }}"
                                    style="max-height: 200px; max-width: 300px;" alt="{{ $new->cover_image }}"></td>
                            <td>{{ $new->title }}</td>
                            <td>{{  substr(strip_tags($new->body) , 0, 100)  }}....</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        Dropdown
                                    </button>
                                    <ul class="dropdown-menu">
                                        <form id="form-delete{{ $new->id }}"
                                            action="{{ route('news.destroy', ['news' => $new->id]) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <li><a class="dropdown-item" href="{{ route('news.show', ['news' => $new->id]) }}">Show</a></li>
                                            <li><a class="dropdown-item" href="{{ route('news.edit', ['news' => $new->id]) }}">Edit</a></li>
                                            <li><button type="submit" class="dropdown-item"> Delete</button></li>
                                        </form>
                                    </ul>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
