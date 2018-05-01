// $(window).on('hashchange', function() {
//     if (window.location.hash) {
//         var page = window.location.hash.replace('#', '');
//         if (page == Number.NaN || page <= 0) {
//             alert('test');
//             return false;
//         } else {
//             getSearch(page);
//         }
//     }
// });
$(document).on('click', '.pagination a', function (e) {
    getSearch($(this).attr('href'));
    $('#search-results').hide();
    $('#spinner').css({'height': '100px'});
    $(window).scrollTop(0);
    e.preventDefault();
});
function getSearch(page) {
    $.ajax({
        url : page,
        dataType: 'json',
    }).done(function (data) {
        $('#search-results').show().html(data);
        window.history.pushState(null, null, '/search?q=' + page.split('q=')[1]);
        $('#spinner').css({'height': '0px'});
    }).fail(function () {
        alert('Search could not be loaded.');
    });
}