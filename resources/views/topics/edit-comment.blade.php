@extends('layout')

@section('scripts')
  <script type="text/javascript" src='//cdn.tinymce.com/4/tinymce.min.js'></script>
  <script type="text/javascript">
  tinymce.init({
    selector: 'input#comment',
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
            {!! Form::model($comment, ['route' => ['ed_comment', $comment->id], 'method' => 'post', 'files' => 'true']) !!}
                <div class="form-group">
                    {!! Form::label('comment', 'Ingresa el comentario:', ['class' => 'sr-only']) !!}
                    {!! Form::text('comment', null, ['class' => 'form-control', 'placeholder' => 'Escriba su comentario']) !!}
                </div>
                <button class="btn btn-info pull-right" type="submit" id="submit">Editar</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop