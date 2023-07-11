$(() => {
    // ==============================================================
    // This is for Show more show less word
    // ==============================================================
    var maximumWordsLength = 10;
    var element = $('td.word-limiter')
    var countLengthOfElement = element.html().split(' ').length

    if (countLengthOfElement > maximumWordsLength) {
        element.each(function (index, val) {
            var showMore = $('<p>').css('cursor', 'pointer').addClass('text-primary show-more').text('Show More')
            var showLess = $('<p>').css('cursor', 'pointer').addClass('text-primary show-less').text('Show Less')

            var fullText = val.innerText

            val.innerText = val.innerText.substr(0, 30)+'...'

            val.append(showMore[0])

            $(this).click(function (e) {

                var selectedElemClass = $(this).children().attr('class').split(' ')[1]

                if (selectedElemClass == 'show-more') {

                    val.innerText = fullText

                    val.append(showLess[0])

                } else if (selectedElemClass == 'show-less') {

                    val.innerText = fullText.substr(0, 30)+'...'

                    val.append(showMore[0])

                }
            })
        })
    }


})
