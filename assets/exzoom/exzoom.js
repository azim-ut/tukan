$(function () {
    let options = {
        navWidth: 60,
        navHeight: 60,
        navItemNum: 5,
        navItemMargin: 7,
        navBorder: 1,
        autoPlay: false
    };
    let res = $("#exzoom").exzoom(options);
    console.log($("#exzoom").exzoom);

});

function deleteexzoomdn() {
    $("#exzoom-dn").removeAttr("style");
    $("#exzoom-dn-nav").removeAttr("style");
};
setTimeout(deleteexzoomdn, 300);