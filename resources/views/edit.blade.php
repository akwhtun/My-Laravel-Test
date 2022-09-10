@extends('master')

@section('content')
    <div class="row p-2 pb-3">
        <div class="col-xl-8 offset-xl-2 col-md-10 offset-md-1 col-12  shadow-sm bg-info rounded text-dark">
            <div class=" mt-2">
                <a href="{{ route('post#view', $editData['id']) }}" class="text-decoration-none text-dark"><i
                        class="fas fa-long-arrow-alt-left fs-5">&nbsp;Back</i></a>
            </div>
            <div class="p-2">
                <form action="{{ route('post#update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 mt-0">
                        <input type="hidden" name="postId" value={{ $editData['id'] }}>
                        <label for="postTitle">Post Title</label>
                        {{-- @dd($editData['title']) --}}
                        <input type="text" name="postTitle" value="{{ old('postTitle', $editData['title']) }}"
                            class="form-control @error('postTitle') is-invalid @enderror"
                            placeholder="Enter update post title">
                        @error('postTitle')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        @if ($editData['image'] != null)
                            <div class=" text-center mt-1 mb-2">
                                <img src="{{ asset('storage/' . $editData['image']) }}" class="img-thumbnail"
                                    width="500px">
                            </div>
                        @else
                            <div class=" text-center mt-1 mb-2">
                                <img src="{{ asset('storage/default.jpg') }}" class="img-thumbnail shadow-sm"
                                    width="500px">
                            </div>
                        @endif
                        <div class="my-1">
                            <label for="postImage">Update Image</label>
                            <input type="file" name="postImage"
                                class="form-control @error('postImage') is-invalid @enderror">
                            @error('postImage')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="postDescription">Post Description</label>
                        <textarea name="postDescription" cols="30" rows="10"
                            class="form-control @error('postDescription') is-invalid @enderror" placeholder="Enter update post description">{{ old('postDescription', $editData['description']) }}</textarea>
                        @error('postDescription')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="text-group mb-3">
                        <label for="postAddress">Address</label>
                        <select name="postAddress" class="form-select">
                            @foreach ($address as $editAddress)
                                @if ($editAddress == $editData['address'])
                                    <option value="{{ $editAddress }}" selected>{{ $editAddress }}
                                    </option>
                                @else
                                    <option value="{{ $editAddress }}">{{ $editAddress }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex">
                        <div class="w-50">
                            <label for="postPice">Price</label>
                            <input type="number" name="postPrice" value="{{ old('postPrice', $editData['price']) }}"
                                placeholder="Enter pirce"
                                class="form-control w-100 @error('postPrice') is-invalid @enderror">
                            @error('postPrice')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="w-50 ps-3">
                            <label for="postRating">Rating</label>
                            <input type="number" name="postRating" value="{{ old('postRating', $editData['rating']) }}"
                                placeholder="Enter rating"
                                class="form-control w-100 @error('postRating') is-invalid @enderror">
                            @error('postRating')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-3 mb-2 text-end">
                        <button type="submit" class="btn btn-dark"><i
                                class="fas fa-save fs-5"></i>&nbsp;ျပုျပင္မည္</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
