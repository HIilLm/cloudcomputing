@extends('layouts.dashboard')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h5>Create News</h5>
            </div>
            <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="title" class="form-label is-invalid">News Title</label>
                            <input type="text" name="title"
                                class="form-control @error('title') is-invalid @enderror" id="title"
                                aria-describedby="title" value="{{ old('title') }}">
                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="filePhoto" class="form-label">Cover Image
                            </label>
                            <input class="form-control @error('cover_image') is-invalid @enderror" name="cover_image" type="file"
                            id="imgInp" accept="image/*" value="{{ old('cover_image') }}">
                            <img id="blah" src="" alt=""  class="mt-3" style="max-height: 200px; max-width: 300px;"/>
                            @error('cover_image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="body" class="form-label is-invalid">Body</label>
                        <textarea name="body" id="body" cols="30" class="form-control @error('body') is-invalid @enderror"
                            rows="10">{{ old('body') }}</textarea>
                        @error('body')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Submit</button>
                <a class="btn btn-danger mt-2" href="{{ url()->previous() }}">Back</a>

            </form>
        </div>
    </div>
@endsection
@section('js')
<script>
   imgInp.onchange = evt => {
    const [file] = imgInp.files
    if (file) {
      blah.src = URL.createObjectURL(file)
    }
  }
</script>

@endsection
