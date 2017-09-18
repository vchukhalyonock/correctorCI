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

    alert($.urlParam('articleURL'));

    $.ajax({
        url : '/article?url=' + $.urlParam('articleURL'),
        method : "get",
        dataType : "json",
        success : function (res) {
            
        }
    });
});