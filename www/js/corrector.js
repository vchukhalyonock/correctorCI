$(document).ready(function () {

    $.urlParam = function(name){
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        if (results == null){
            return null;
        }
        else{
            return decodeURI(results[1]) || 0;
        }
    }

    $.ajax({
        url : '/article?url=' + $.urlParam('articleURL'),
        method : "get",
        dataType : "json",
        success : function (res) {
            $('#correctorForm').append('<h2>TITLE</h2><div class="form-group">\n' +
                '    <label for="pTitle">' + res.title + '</label>\n' +
                '    <input type="text" id="title" class="form-control input-lg" name="title" value="' + res.title + '"/>' +
                '  </div><button class="btn btn-lg btn-primary btn-block signup-btn" value="pTitle" type="button">\n' +
                '  Send</button><hr/><h2>Paragraphs</h2>');
            for(var i = 0; i < res.paragraphs.length; i++) {
                $('#correctorForm').append('<div class="form-group">\n' +
                    '    <label for="p' + i + '">' + res.paragraphs[i] + '</label>\n' +
                    '    <textarea class="form-control input-lg" id="p' + i + '">' + res.paragraphs[i] + '</textarea>\n' +
                    '  </div><button class="btn btn-lg btn-primary btn-block signup-btn" value="p' + i +'" id="corrrectionsButton" type="button">\n' +
                    '  Send</button><hr/>');
            }

            $('button').click(function () {
                var code = $(this).val();
                var oText = $('label[for=' + code + ']').text();
                var uText = code == 'pTitle' ? $('#title').val() : $('#' + code).val();

                sendUpdate(oText, uText);
            });
        }
    });


    function sendUpdate(oText, uText) {
        $.ajax({
            url : '/article',
            method : "post",
            dataType : "json",
            data : JSON.stringify({
                articleURL : $.urlParam('articleURL'),
                originalText : oText,
                usersText : uText
            }),
            processData: false,
            success : function () {
                alert("Your proposition sent");
            }
        });
    }
});