$(function(){

    $("#exzoom").exzoom({

    // thumbnail nav options
    "navWidth": 60,
    "navHeight": 60,
    "navItemNum": 5,
    "navItemMargin": 7,
    "navBorder": 1,

    // autoplay
    "autoPlay": false,   
    });

});
function deleteexzoomdn(){
        $("#exzoom-dn").removeAttr("style");
        $("#exzoom-dn-nav").removeAttr("style");
    };
    setTimeout(deleteexzoomdn,500);                 