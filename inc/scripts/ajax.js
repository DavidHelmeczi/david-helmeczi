function ajaxPosts() {
    jQuery.ajax({
        type: 'post',
        url: myAjax.ajaxurl,
        data: {
            action: 'display_fav_movies',
            id_favorite: localStorage.getItem('favorite'),
        },
        success: function (response) {
            $('#fav_movies_list').html(response)
        },
    })
}  //ajax pentru favorite

function istoricAjaxPosts() {
    jQuery.ajax({
        type: 'post',
        url: myAjax.ajaxurl,
        data: {
            action: 'display_istoric_movies',
            id_istoric: getCookie('istoricCookie'),
        },
        success: function (response) {
            $('#istoric_movies_list').html(response)
        },
    })
} //ajax pentru istoric
