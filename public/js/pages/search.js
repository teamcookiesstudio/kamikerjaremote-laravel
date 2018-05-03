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

jQuery('#submit-search-2').click(() => {
    if (jQuery('#input-search-2').val() == '') {
        $.notify('Kolom pencarian tidak boleh kosong..');
    } else {
        jQuery('#search-results').hide();
        jQuery('#spinner').css({'height': '100px'});
        jQuery(window).scrollTop(0);

        var q = jQuery('#input-search-2').val();
        $.ajax({
            url: 'search',
            cache: true,
            data: {q: q}
        }).done(function (data){
            $('#search-results').show().html(data);
            window.history.pushState(null, null, '/search?q=' + q);
            $('#spinner').css({'height': '0px'});
        }).fail(function (jqXHR, textStatus) {
            console.log(jqXHR,textStatus);
        });
    }
});
function getSearch(page) {
    $.ajax({
        url : page,
        dataType: 'json',
        cache: true,
    }).done(function (data) {
        $('#search-results').show().html(data);
        window.history.pushState(null, null, '/search?q=' + page.split('q=')[1]);
        $('#spinner').css({'height': '0px'});
    }).fail(function () {
        alert('Search could not be loaded.');
    });
}