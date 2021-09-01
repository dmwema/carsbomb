$(document).ready(() => {

    var showTag = function(a) {
        $('.col.parent-tab').removeClass('active')
        a.parentNode.classList.add('active')

        $('.contents').hide();
        $(a.getAttribute('href') + '-content').fadeIn(500);
    }

    let tabs = $('.details .title')
    tabs.click(function(e) {
        showTag(e.target)
    });

    var hash = window.location.hash
    var a = document.querySelector('a[href="' + hash + '"]')

    if (a !== null && !a.parentNode.classList.contains('active')) {
        showTag(a)
    }
})