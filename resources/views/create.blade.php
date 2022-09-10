@extends('master')

@section('content')
    <div class="row p-1">
        <div class="col-12 col-xl-5 order-xl-1">
            @if (session('insertSuccess'))
                <div class="alert-message">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('insertSuccess') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            @if (session('updateSuccess'))
                <div class="alert-message">
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <strong>{{ session('updateSuccess') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            @if (session('deleteSuccess'))
                <div class="alert-message">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('deleteSuccess') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-xl-5 order-xl-1 order-2">
            <div class="p-sm-3 p-1 mt-1">
                <form action="{{ route('post#create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif --}}
                    <div class="text-group mb-3">
                        <label for="postTitle">Post Title</label>
                        <input type="text" name="postTitle"
                            class="form-control
                            @error('postTitle') is-invalid @enderror"
                            value="{{ old('postTitle') }}" placeholder="Enter Post Title...">
                        @error('postTitle')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="text-group mb-3">
                        <label for="postDescription">Post Description</label>
                        <textarea name="postDescription" class="form-control @error('postDescription') is-invalid @enderror "
                            placeholder="Enter Post Description..." cols="30" rows="10">{{ old('postDescription') }}</textarea>
                        @error('postDescription')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="text-group mb-3">
                        <label for="postImage">Image</label>
                        <input type="file" name="postImage"
                            class="form-control @error('postImage') is-invalid @enderror">
                        @error('postImage')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="text-group mb-3">
                        <label for="postAddress">Address</label>
                        <select name="postAddress" class="form-select">
                            @foreach ($address as $addKey => $addValue)
                                <option value="{{ $addValue }}">{{ $addValue }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-group mb-3 d-flex">
                        <div class="w-50">
                            <label for="postPrice">Fee</label>
                            <input type="number" name="postPrice"
                                class="form-control w-100 @error('postPrice') is-invalid @enderror"
                                value="{{ old('postPrice') }}" placeholder="Enter fee">
                            @error('postPrice')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="w-50 ps-3">
                            <label for="postRating">Rating</label>
                            <input type="number" name="postRating" max="5"
                                class="form-control w-100 @error('postRating') is-invalid @enderror"
                                value="{{ old('postRating') }}" placeholder="Enter rating">
                            @error('postRating')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit"class="btn btn-info text-white">Post ဖန္တီးမည္</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-xl-7 col-12 order-xl-2 order-1">
            <div class="data-container">
                <div class="d-flex justify-content-between align-items-start row">
                    <h3 class="mb-2 col-4">Total - {{ $posts->total() }}</h5>
                        <div class="col-6 offset-2">
                            <form action="{{ route('post#home') }}" method="GET">
                                <div class="input-group">
                                    <input type="search" name="searchKey" class="form-control"
                                        placeholder="Enter Search Key" value="{{ request('searchKey') }}">
                                    <button type="submit" class="btn btn-info"><i class="fas fa-search p-1"></i></button>
                                </div>
                            </form>
                        </div>
                </div>
                @if (count($posts) != 0)
                    @foreach ($posts as $post)
                        <div class="post p-sm-3 p-1 shadow-sm mb-3 bg-info border border-dark text-dark rounded">
                            <div class="d-flex justify-content-between row">
                                <h5 class="col-8">{{ $post->title }}</h5>
                                <p class="text-dark col-4 text-end"><i class="far fa-clock"></i>
                                    {{ $post->created_at->format('h:m:s:a') }}</p>
                            </div>
                            <p class="text-muted mb-3">
                                {{ Str::words($post->description, 20, '...') }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center mt-1">
                                <div>
                                    <small><i class="fas fa-map-marker-alt text-danger"></i>&nbsp;{{ $post->address }}
                                        |</small>
                                    <small><i class="fas fa-money-bill text-primary"></i>&nbsp;{{ $post->price }}
                                        kyats|</small>
                                    <small>{{ $post->rating }}&nbsp;<i class="fas fa-star text-warning"></i></small>
                                </div>
                                {{-- Another delete
                                    <form action="{{ route('post#delete', $post['id']) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash fs-5"></i>
                                    </button>
                                </form> --}}
                                <div class="button-group">
                                    <a href="{{ route('post#delete', $post->id) }}" class="btn btn-sm btn-danger"><i
                                            class="fas fa-trash">&nbsp;ဖျက်မည်</i></a>
                                    <a href="{{ route('post#view', $post->id) }}" class="btn btn-sm btn-primary"><i
                                            class="far fa-file-alt">&nbsp;အပြည့်အစုံဖတ်မည်</i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-danger fs-3 mt-3">There is no data to show...</p>
                @endif
            </div>
            {{ $posts->appends(request()->query())->links() }}
        </div>
    </div>
@endsection
