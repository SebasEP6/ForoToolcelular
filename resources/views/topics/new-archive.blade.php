@extends('layout')

@section('scripts')
  <script type="text/javascript" src='//cdn.tinymce.com/4/tinymce.min.js'></script>
  <script type="text/javascript">
  tinymce.init({
    selector: 'textarea',
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
<div class="modal fade" id="new-category">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h3 class="modal-title">Agregar categor&iacute;a</h3>
            </div>
            <div class="modal-body">
                <form action="{{ route('newCategory') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="category" class="sr-only">Ingrese el nombre de la categoria:</label>
                        <input type="text" name="category" id="category" class="form-control" placeholder="Ingrese el nombre de la nueva categoria">
                        <button class="btn btn-info" type="submit">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container">
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
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['route' => ['new-post',], 'id'=>'file-form', 'method' => 'POST' ]) !!}
                <div class="form-group">
                    {!! Form::label('title', 'Ingresa el titulo:', ['class' => 'sr-only']) !!}
                    {!! Form::text('title', null, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Titulo de la publicacion']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('body', 'Ingresa el contenido:', ['class' => 'sr-only']) !!}
                    <textarea name="body" id="body" rows="15" class="form-control" placeholder="Escriba aqui el contenido de su publicacion"></textarea>
                </div>
                <div class="form-group">
                    {!! Form::label('category', 'Ingresa el contenido:', ['class' => 'sr-only']) !!}
                    <select class="form-control post_cat" name="category" id="category">
                        <option value="">Elige una categoria</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category }}</option>
                        @endforeach
                    </select>
                    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'moderator')
                    <a href="#new-category" type="button" class="btn btn-link" data-toggle="modal">Agregar nueva categoria</a>
                    @endif
                </div>
                <div class="form-group">
                    {!! Form::label('type', 'Ingresa el tipo de post', ['class' => 'sr-only']) !!}
                    {!! Form::select('type', array('software' => 'Software', 'hardware' => 'Hardware'), null, ['placeholder' => 'Selecciona el tipo', 'class' => 'form-control', 'id' => 'post_type']) !!}
                </div>
                <div class="form-group">
                    {!! Form::hidden('file_name','',['id' => 'file-name']) !!}
                    <div id="filelist" style="max-width: 230px;word-wrap: break-word;text-align: left;">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
                    <br />
                    <div id="container">
                        <button type="button" class="subir" id="pickfiles">Agregar</button>
                    </div>
                    <span id="console" class="help-block" style="margin-top:20px;color:#afafaf"></span>
                    <div id="save-response" style="margin-top:20px;"></div>
                </div>
                <button class="btn btn-info pull-right" type="buttom" id="uploadfiles">Publicar</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop