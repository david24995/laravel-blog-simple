@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-8">
            <h1>Lista de Articulos</h1>
            @foreach ($posts as $post)
                <div class="card my-2">
                    <div class="card-header">
                        {{ $post->name }} <span class="float-right" > {{ $post->created_at->format('d/m/Y') }} - {{ $post->created_at->format('H:i:s') }} </span>
                    </div>
                    <div class="card-body">
                        @if ($post->file)
                            <img src="{{ $post->file }}" alt="{{ $post->file }}" class="card-img-top">
                        @endif
                        <p class="card-text">{{ $post->excerpt }}</p>
                        <a href="{{ route('post', $post->slug ) }}" class="float-right">Leer más</a>
                    </div>
                </div>
            @endforeach
            <div class="mt-5 d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
