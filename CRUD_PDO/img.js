
    
$(".lightbox").click(function(){

    overlayLink = $(this).attr("href");

    window.startOverlay(overlayLink);

});
        
               
$(".overlay").click(function(){
    $(".container, .overlay")
    .animate({"opacity":"0"}, 200, linear, function(){
        $(".container, .overlay").remove();
    })
});

function startOverlay(overlayLink) {
    $(".container img").load(function() {
        var imgWidth = $(".container img").width();
        var imgHeight = $(".container img").height();
        $(".container")
            .css({
                "top":        "50%",
                "left":        "50%",
                "width":      imgWidth,
                "height":     imgHeight,
                "margin-top": -(imgHeight/2), // the middle position
                "margin-left":-(imgWidth/2)
            })
            .animate({"opacity":"1"}, 200, "linear");
    });
}