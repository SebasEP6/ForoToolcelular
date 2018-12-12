<script type="text/javascript" src="{{asset('vendor/jildertmiedema/laravel-plupload/js/plupload.full.min.js')}}"></script>
<script>
    var uploader = new plupload.Uploader({
        runtimes : 'html5',

        browse_button : 'pickfiles', // you can pass in id...
        container: 'container', // ... or DOM Element itself

        url : "{{url('upload')}}",

        multi_selection: false,

        filters : {
            max_file_size : '10gb',
            mime_types: [
                {title : "Allowed files", extensions : "rar,zip,7zip,tar"},
            ]
        },
        chunk_size: '5mb',
        max_retries: 5,
        rename: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        init: {
            PostInit: function() {
                document.getElementById('filelist').innerHTML = '';
                document.getElementById('uploadfiles').onclick = function() {
                    if($('#title').length > 0 && $('#body').length > 0 && $('.post_cat').val() != '' && $('#post_type').val() != '') {
                        if(uploader.files.length > 0) {
                            uploader.start();
                            return false;
                        }else{
                            $('#file-form').submit();
                        }
                    }
                };
            },
            FilesAdded: function(up, files) {
                plupload.each(files, function(file) {
                    document.getElementById('filelist').innerHTML += '<div id="' + file.id + '" style="color:#afafaf;">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b>'+'<a href="#" title="Eliminar de la cola" file="'+file.id+'" class="remove btn error">X</a></div>';
                    $('#uploadfiles').removeAttr('disabled');
                });
                $('a.remove').click(function(e) {
                    e.preventDefault();
                    var file_id= $(this).attr('file');
                    up.removeFile(file_id);
                    $('#' + file_id).remove();
                    if (up.files.length == 0) {
                        $('#uploadfiles').attr('disabled', 'true');
                    }
                });
                $('#console').html("");
            },
            QueueChanged: function(uploader){
                if (uploader.files.length == 2) {
                    $('#' + uploader.files[0].id).remove();
                    uploader.removeFile(uploader.files[0].id);
                }
            },
            UploadProgress: function(up, file) {
                document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
            },
            BeforeUpload: function(up, files){
                $("#save-response").html('');
                $("#save-response").html("<h4>Estamos procesando tus archivos, por favor mant&eacuten abierta esta pesta&ntildea hasta que el proceso termine.</h4>");
            },
            UploadComplete: function(up,files){
                var data= [];
                plupload.each(files, function(file){
                    $('#file-name').val(file.name);
                });
                $('#file-form').submit();
            },

            Error: function(up, err) {
                if(err.code == "-601") {
                    $('#console').html("");
                    $('#console').html("Extensi&oacuten de archivo inv&aacutelida");
                }else{
                    $('#console').html("");
                    $('#console').html("Error: "+err.message);
                }
            }
        }
    });
    uploader.init();
</script>