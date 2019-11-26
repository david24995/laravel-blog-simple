@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Lista de Categorias
                    <a href="{{ route('categories.create') }}" class="btn btn-sm btn-primary float-right">Crear</a>
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
                            @foreach ($categories as $category)
                                <tr>
                                    <td> {{ $category->id }} </td>
                                    <td> {{ $category->name }} </td>
                                    <td width="10px"><a href="{{ route('categories.show',$category->id) }}" class="btn btn-sm btn-secondary">Ver</a></td>
                                    <td width="10px"><a href="{{ route('categories.edit',$category->id) }}" class="btn btn-sm btn-info">Editar</a></td>
                                    <td width="10px">
                                        {!! Form::open(['route' => ['categories.destroy',$category->id], 'method' => 'DELETE' ]) !!}
                                            <button class="btn btn-sm btn-danger">Eliminar</button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-5 d-flex justify-content-center">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
