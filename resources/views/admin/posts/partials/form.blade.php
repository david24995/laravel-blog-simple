{{ Form::hidden('user_id', auth()->user()->id ) }}

<div class="form-group">
    {{ Form::label('category_id', 'Categorias') }}
    {{ Form::select('category_id',$categories,null,['class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('name', 'Nombre de la etiqueta') }}
    {{ Form::text('name',null,['class' => 'form-control','id' => 'name']) }}
</div>
<div class="form-group">
    {{ Form::label('slug', 'URL amigable') }}
    {{ Form::text('slug',null,['class' => 'form-control','id' => 'slug']) }}
</div>
<div class="form-group">
    {{ Form::label('file', 'Imagen') }}
    {{ Form::file('file') }}
</div>
<div class="form-group">
    {{ Form::label('status', 'Estado') }}
    <label>
        {{ Form::radio('status','PUBLISHED') }} Publicado
    </label>
    <label>
        {{ Form::radio('status','DRAFT') }} Borrador
    </label>
</div>
<div class="form-group">
    {{ Form::label('tags', 'Etiquetas') }}
    @foreach ($tags as $tag)
        <label>
            {{ Form::checkbox('tags[]',$tag->id) }} {{ $tag->name }}
        </label>
    @endforeach
</div>
<div class="form-group">
    {{ Form::label('excerpt','Extracto') }}
    {{ Form::textarea('excerpt',null,['class' => 'form-control', 'cols' => '10', 'rows' => '2']) }}
</div>
<div class="form-group">
    {{ Form::label('body', 'Descripción') }}
    {{ Form::textarea('body',null,['class' => 'form-control', 'cols' => '10', 'rows' => '5']) }}
</div>
<div class="form-group">
    {{ Form::submit('Guardar',['class' => 'btn btn-sm btn-primary']) }}
</div>

@section('scripts')
    <script src="{{ asset('vendor/stringToSlug/speakingurl.min.js') }}" ></script>
    <script src="{{ asset('vendor/stringToSlug/jquery.stringtoslug.min.js') }}" ></script>
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}" ></script>
    <script>
        $(document).ready(function(){
            $('#name, #slug').stringToSlug({
                callback: function(text) {
                    $('#slug').val(text);
                }
            });
            CKEDITOR.config.height= 400;
            CKEDITOR.config.widht= 400;
            CKEDITOR.replace( 'body' );
        });

    </script>
@endsection
