function imagePreview() {
    $("#image").on('change', (e) => {
        const $preview = $('#image_preview'),
            $input = $(e.currentTarget),
            files = e.target.files
        $preview.fadeOut(function () {
            $(this).html('')
            if (files.length) {
                if (String(files[0].type).slice(0, 6) !== 'image/') {
                    $input.val(null)
                } else {
                    for (let file of files) {
                        $preview.append(`<img class='img-preview' src='${URL.createObjectURL(file)}'>`)
                    }
                    $(this).fadeIn()
                }
            }
        })
    })
    $('body').on('click', '.img-preview', function () {
        $(this).closest('.images-form-group').find('input').val(null).trigger('change')
    })
}

function initEditors() {
    tinymce.init({
        selector: '#body',
        height: 300,
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table paste imagetools wordcount"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tiny.cloud/css/codepen.min.css'
        ]
    }).then(editor => {
        $('.preview').on('click', (e) => {
            e.preventDefault()
            tinymce.get('body').execCommand('mcePreview')
        })
    })
    tinymce.init({
        selector: '#excerpt',
        height: 150,
        menubar: false
    })
}

$(function () {
    $('.logout').on('click', (e) => {
        e.preventDefault();
        $('#logout-form').submit();
    });
});
