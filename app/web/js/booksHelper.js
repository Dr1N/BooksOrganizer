//to-do loader for post request

$(document).ready(function () {
    $('.activity-view-link').click(function() {
        var postUrl = '/web/index.php?r=books%2Fview&id=' + $(this).data('id');
        $.post(
            postUrl,
            function (data) {
                $('.modal-body').html(data);
                $('.modal-title').html('Просмотр книги');
                $('#activity-modal').modal();
            }  
        );
    });

    $('.activity-image-link').click(function() {
        var src = $(this).children("img").attr("src");
        var cover = $('<img />', {src: src, class: 'center-block', style: 'max-width:500px'});
        $('.modal-title').html('Обложка книги');
        $('.modal-body').html(cover);
    });
});