<style>
    #backToTop {
        border-radius: 0px;
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
        background-clip: padding-box;
        background-color: rgba(0,0,0,.4);
        box-shadow: inset 0 0 5px rgba(0,0,0,.1);
        position: fixed;
        bottom: -40px;
        right: 20px;
        z-index: 1000;
        padding: 10px 15px 10px;
        cursor: pointer;
        transform: translate3d(0,0,0);
        opacity: 0;
        color: #fff;
    }
</style>

<div id="backToTop" class="animate-top"><i class="fa fa-angle-up"></i></div>

<script>
    $(window).scroll( function() {
        var scrollPosition = $(window).scrollTop();
        
        if (scrollPosition > 300) {
            $('#backToTop').stop().animate({
                    'bottom': '62px',
                    'opacity': 1
            }, 300, "easeOutQuart");
        } else if (scrollPosition < 300) {
            $('#backToTop').stop().animate({
                    'bottom': '-40px',
                    'opacity': 0
            }, 300, "easeInQuart");
        }
    });
    
    $(backToTop).click(function () {
        $("html, body").animate({ scrollTop: 0 }, "slow");
    });
</script>