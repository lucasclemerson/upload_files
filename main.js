$().ready(function(){
    $("#uploadForm").on("submit", function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $("#progressWrapper").show();
        $.ajax({
            url: "upload.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,

            xhr: function(){
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress', function(event){
                    if (event.lengthComputable){
                        var percent = Math.round((event.loaded / event.total) * 100);
                        $('#progressBar').width(percent+'%');
                        $('#progressBar').text(percent+'%');
                    }
                }, false);
                return xhr;
            },
            success: function(response){
                if (JSON.parse(response).status == 200){
                    confirm("Tudo certo com seu envio!");
                    window.reload();
                }else{
                    alert(response);
                }
            }
        });
    })
});