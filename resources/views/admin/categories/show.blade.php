@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Ver Categoria
                </div>
                <div class="card-body">
                    <p><strong>Nombre:</strong>    {{ $category->name }} </p>
                    <p><strong>Slug:</strong>      {{ $category->slug }} </p>
                    <p><strong>Contenido:</strong>
                        @if($category->body)
                            {{ $category->body }}
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
