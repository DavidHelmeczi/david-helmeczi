var far = 'far fa-heart'
var fas = 'fas fa-heart'

function getCookie(cname) {
    var name = cname + '='
    var decodedCookie = decodeURIComponent(document.cookie)
    var ca = decodedCookie.split(';')
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i]
        while (c.charAt(0) == ' ') {
            c = c.substring(1)
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length)
        }
    }
    return false
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date()
    d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000)
    var expires = 'expires=' + d.toUTCString()
    document.cookie = cname + '=' + cvalue + ';' + expires + ';path=/'
}

if (localStorage.getItem('favorite') === null) {   //facem array cu favorite daca nu exista in localStorage deja
    var favorite = []
} else {
    var favorite = JSON.parse(localStorage.getItem('favorite')) //daca exista luam de acolo
}

function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(
        /^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i
    )
    return pattern.test(emailAddress)
}

function classToggle(x) {  //changes the state of the heart icon (if added to favorite shows full heart, if removed shows empty heart), adds/removes movie from favorite array and saves array to localStorage
    x.classList.toggle('fas')
    pageId = x.id.split('-').pop()
    if (favorite.includes(pageId)) {
        var index = favorite.indexOf(pageId)
        if (index > -1) {
            favorite.splice(index, 1)
        }
    } else if (!favorite.includes(pageId)) {
        favorite.push(pageId)
    }
    localStorage.setItem('favorite', JSON.stringify(favorite))
}

function inArray(needle, haystack) {
    var count = haystack.length
    for (var i = 0; i < count; i++) {
        if (haystack[i] === needle) {
            return true
        }
    }
    return false
}
