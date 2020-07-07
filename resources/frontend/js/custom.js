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
        ],
        convert_urls: false,
        images_upload_handler: function (blobInfo, success, failure) {
            var xhr, formData;
            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '/profile/posts/image');
            var token = $('meta[name="csrf-token"]').attr('content');
            xhr.setRequestHeader("X-CSRF-Token", token);
            xhr.setRequestHeader("Accept", 'application/json');
            xhr.onload = function() {
                var json;
                if (xhr.status === 422) {
                    json = JSON.parse(xhr.responseText);
                    failure('Error: ' + json.errors.image.join('\n'));
                    return;
                }
                if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }
                json = JSON.parse(xhr.responseText);
                if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }
                success(json.location);
            };
            formData = new FormData();
            formData.append('image', blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
        }
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

function repeater() {
    function updateInputName($input, index) {
        $($input).attr('name', $($input).attr('name').replace(/[0-9]/g, index))
    }

    $('body')
        .on('click', '.repeater-add', function (e) {
            e.preventDefault()
            const clone = $('.repeater .repeater-row:last-child').clone(),
                index = $('.repeater .repeater-row').length
            clone.find('input').each(function () {
                $(this).val('')
                updateInputName(this, index)
            })
            clone.appendTo('.repeater')
        })
        .on('click', '.repeater-remove', function () {
            $(this).closest('.repeater-row').remove()
            $('.repeater .repeater-row').each(function (index) {
                $(this).find('input').each(function () {
                    updateInputName(this, index)
                })
            })
        })
}

function share() {
    const popupSize = {
        width: 780,
        height: 550
    }

    $('body').on('click', '.social-button', function (e) {
        var verticalPos = Math.floor(($(window).width() - popupSize.width) / 2),
            horisontalPos = Math.floor(($(window).height() - popupSize.height) / 2)

        var popup = window.open($(this).prop('href'), 'social',
            'width=' + popupSize.width + ',height=' + popupSize.height +
            ',left=' + verticalPos + ',top=' + horisontalPos +
            ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1')

        if (popup) {
            popup.focus()
            e.preventDefault()
        }

    })
}

function horizontalScroll() {
    $('.slide-panel .button').on('click', function () {
        const $container = $(this).closest('.category-own-media').find('.inline-block-pc'),
            currentScroll = $container.scrollLeft()
        let itemWidth = $container.find('.article-column-card').width()
        if ($(this).hasClass('slide-prev')) itemWidth = -itemWidth
        $container.animate({scrollLeft: currentScroll + itemWidth}, 500)
    })
    $('.inline-block-pc').on('mousewheel', function (event, delta) {

        this.scrollLeft -= (delta * 60)

        event.preventDefault()

    })
}

function deleteAjax() {
    $('.form-ajax').on('click', function (e) {
        e.preventDefault()
        if (!confirm('Are you sure?')) return
        $.ajax({
            url: $(this).data('action'),
            type: 'POST',
            data: {
                _method: 'DELETE'
            },
            success: () => {
                let $hide = $(this)
                if ($(this).closest('table').length) {
                    $hide = $(this).closest('tr')
                }
                $hide.fadeOut(function () {
                    $(this).remove()
                })
            }
        })
    })
}

$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    $('.logout').on('click', (e) => {
        e.preventDefault()
        $('#logout-form').submit()
    })
    share()
    horizontalScroll()
    $('.tab-pane:first').addClass('show').addClass('active')
})
