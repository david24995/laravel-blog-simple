@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Ver Entrada
                </div>
                <div class="card-body">
                    <p><strong>Nombre:</strong>    {{ $post->name }} </p>
                    <p><strong>Slug:</strong>      {{ $post->slug }} </p>
                    <p><strong>Contenido:</strong>
                        @if($post->body)
                            {{ $post->body }}
                        @else
                            No hay descripción!
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
