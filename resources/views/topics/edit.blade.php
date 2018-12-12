@extends('layout')

@section('scripts')
  <script type="text/javascript" src='//cdn.tinymce.com/4/tinymce.min.js'></script>
  <script type="text/javascript">
  tinymce.init({
    selector: 'input#body',
    theme: 'modern',
    plugins: [
      'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
      'save table contextmenu directionality emoticons template paste textcolor'
    ],
    content_css: 'css/content.css',
    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons'
  });
  </script>
@endsection

@section('content')
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Hey!</strong> Se encontraron algunos problemas.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
    <div class="row">
        <div class="col-md-12">
            {!! Form::model($post, ['route' => ['ed_topic', $post->id], 'method' => 'post', 'files' => 'true']) !!}
                <div class="form-group">
                    {!! Form::label('title', 'Ingresa el titulo:', ['class' => 'sr-only']) !!}
                    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Titulo de la publicacion']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('body', 'Ingresa el contenido:', ['class' => 'sr-only']) !!}
                    {!! Form::text('body', null, ['class' => 'form-control', 'placeholder' => 'Contenido de la publicacion']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('category', 'Ingresa el contenido:', ['class' => 'sr-only']) !!}
                    <select class="form-control" name="category" id="category">
                        <option value="">Elige una categoria</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category }}</option>
                        @endforeach
                    </select>
                </div>
                    <div class="form-group">
                        {!! Form::label('type', 'Ingresa el tipo de post', ['class' => 'sr-only']) !!}
                        {!! Form::select('type', array('software' => 'Software', 'hardware' => 'Hardware'), null, ['placeholder' => 'Selecciona el tipo', 'class' => 'form-control']) !!}
                    </div>
                <button class="btn btn-info pull-right" type="submit" id="submit">Editar</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop