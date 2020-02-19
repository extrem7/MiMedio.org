let players = [], videoDone = false

function onYouTubeIframeAPIReady() {
    setTimeout(() => {
        $('.youtube-player').each(function () {
            let $parent = $(this).closest('.video-channel'),
                item = $(this).data('item')
            players[item] = new YT.Player($(this).attr('id'), {
                height: '202',
                videoId: $(this).data('main'),
                events: {
                    'onStateChange': event => {
                        if (event.data == YT.PlayerState.PLAYING) {
                            $parent.find('.fas').removeClass('fa-play').addClass('fa-pause')
                        } else {
                            $parent.find('.fas').removeClass('fa-pause').addClass('fa-play')
                        }
                    }
                }
            })
            youtube($parent, players[item])
        })
    }, 1000)
}

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

function youtube($parent, player) {
    console.log($parent, player)
    $parent.find('.video-item').on('click', function () {
        player.loadVideoById($(this).data('id'))
        let $box = $parent.find('.channel-play-box')
        $box.find('.video-name').text($(this).find('.video-name').text())
        $box.find('.time').text($(this).find('.time').text())
    })
    $parent.find('.play-btn').on('click', function () {
        if (player.getPlayerState() == YT.PlayerState.PLAYING) {
            player.pauseVideo()
        } else {
            player.playVideo()
        }
    })
}

$(function () {
    $('.logout').on('click', (e) => {
        e.preventDefault()
        $('#logout-form').submit()
    })

})
