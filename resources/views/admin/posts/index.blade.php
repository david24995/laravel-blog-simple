@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Lista de mis Entradas
                    <a href="{{ route('posts.create') }}" class="btn btn-sm btn-primary float-right">Crear</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover" >
                        <thead class="thead-dark">
                            <tr>
                                <th width="10px">ID</th>
                                <th>Nombre</th>
                                <th colspan="3">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td> {{ $post->id }} </td>
                                    <td> {{ $post->name }} </td>
                                    <td width="10px"><a href="{{ route('posts.show',$post->id) }}" class="btn btn-sm btn-secondary">Ver</a></td>
                                    <td width="10px"><a href="{{ route('posts.edit',$post->id) }}" class="btn btn-sm btn-info">Editar</a></td>
                                    <td width="10px">
                                        {!! Form::open(['route' => ['posts.destroy',$post->id], 'method' => 'DELETE' ]) !!}
                                            <button class="btn btn-sm btn-danger">Eliminar</button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-5 d-flex justify-content-center">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
