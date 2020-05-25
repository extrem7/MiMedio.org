function fallbackCopyTextToClipboard(text, callback = null) {
    var textArea = document.createElement("textarea")
    textArea.value = text
    textArea.style.position = "fixed"  //avoid scrolling to bottom
    document.body.appendChild(textArea)
    textArea.focus()
    textArea.select()

    try {
        var successful = document.execCommand('copy')
        var msg = successful ? 'successful' : 'unsuccessful'
        callback()
    } catch (err) {
        console.error('Fallback: Oops, unable to copy', err)
    }

    document.body.removeChild(textArea)
}

export function copyTextToClipboard(text, callback = null) {
    if (!navigator.clipboard) {
        fallbackCopyTextToClipboard(text, callback)
        return
    }
    navigator.clipboard.writeText(text).then(function () {
        callback()
    }, function (err) {
        console.error('Async: Could not copy text: ', err)
    })
}

export function createTextLinks(text) {

    return (text || "").replace(
        /([^\S]|^)(((https?\:\/\/)|(www\.))(\S+))/gi,
        function(match, space, url){
            var hyperlink = url;
            if (!hyperlink.match('^https?:\/\/')) {
                hyperlink = 'http://' + hyperlink;
            }
            return space + '<a href="' + hyperlink + '">' + url + '</a>';
        }
    );
};
