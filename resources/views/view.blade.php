@extends('master')

@section('content')
    <div class="row my-2 p-4">
        <div
            class="col-xl-8 offset-xl-2 col-md-10 offset-md-1 col-12 shadow-sm bg-info border border-dark rounded text-dark">
            <div class="mb-2 mt-1">
                <a href="{{ route('post#home') }}" class="text-decoration-none text-dark"><i
                        class="fas fa-long-arrow-alt-left fs-5">&nbsp;Back</i></a>
            </div>
            <div class="mt-1">
                <div class="row my-1">
                    <h4 class="col-9">{{ $data->title }}</h4>
                </div>
                <div class="d-flex justify-content-center">
                    <p class="bg-dark text-white p-2 me-2 rounded"><i
                            class="fas fa-map-marker-alt text-danger"></i>&nbsp;{{ $data->address }}
                    </p>
                    <p class="bg-dark text-white p-2 me-2 rounded"><i
                            class="fas fa-money-bill text-primary"></i>&nbsp;{{ $data->price }}
                        kyats</p>
                    <p class="bg-dark text-white p-2 me-2 rounded"><i
                            class="fas fa-star text-warning"></i>&nbsp;{{ $data->rating }}
                    </p>
                    <p class="bg-dark text-white p-2 me-2 rounded"><i class="far fa-calendar-alt text-secondary"></i>
                        {{ $data->created_at->format('j-F-Y') }}
                    </p>
                    <p class="bg-dark text-white p-2 me-2 rounded"><i class="far fa-clock text-success"></i>
                        {{ $data->created_at->format('h:m:s:a') }}
                    </p>
                </div>
                @if ($data->image != null)
                    <div class=" text-center mt-1 mb-2">
                        <img src="{{ asset('storage/' . $data->image) }}" class="img-thumbnail shadow-sm" width="500px">
                    </div>
                @else
                    <div class=" text-center mt-1 mb-2">
                        <img src="{{ asset('storage/default.jpg') }}" class="img-thumbnail" width="500px">
                    </div>
                @endif
                <p class="mt-2">{{ $data->description }}</p>

            </div>
            <div class="mb-3 text-end">
                <a href="{{ route('post#edit', $data->id) }}" class="btn btn-dark"><i
                        class="fas fa-edit fs-5"></i>&nbsp;တည္းျဖတ္မည္</a>
            </div>
        </div>
    </div>
@endsection
