$(document).ready(function(){
   $("[data-role='del']").click(function(){
      if (!confirm("Da li ste sigurni da želite da obrišete?")){
         return false;
      }
   });

    $("[data-role='tab']").click(function(){
        var val = $(this).data("value");
        if (val == "sr")
            showSrTab();
        else if (val == "en")
            showEnTab();
    });
});

function showSrTab() {
    $("[data-role='tabbed_form']").removeClass("en").addClass("sr");
}
function showEnTab() {
    $("[data-role='tabbed_form']").removeClass("sr").addClass("en");
}

window.goBack = function (e){
    var defaultLocation = "http://www.mysite.com";
    var oldHash = window.location.hash;

    history.back(); // Try to go back

    var newHash = window.location.hash;

    /* If the previous page hasn't been loaded in a given time (in this case
    * 1000ms) the user is redirected to the default location given above.
    * This enables you to redirect the user to another page.
    *
    * However, you should check whether there was a referrer to the current
    * site. This is a good indicator for a previous entry in the history
    * session.
    *
    * Also you should check whether the old location differs only in the hash,
    * e.g. /index.html#top --> /index.html# shouldn't redirect to the default
    * location.
    */

    if(
        newHash === oldHash &&
        (typeof(document.referrer) !== "string" || document.referrer  === "")
    ){
        window.setTimeout(function(){
            // redirect to default location
            window.location.href = defaultLocation;
        },1000); // set timeout in ms
    }
    if(e){
        if(e.preventDefault)
            e.preventDefault();
        if(e.preventPropagation)
            e.preventPropagation();
    }
    return false; // stop event propagation and browser default event
}
