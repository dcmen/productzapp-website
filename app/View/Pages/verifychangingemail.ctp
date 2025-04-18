<div id="solution" class="container">
    <div class="introFourthDiv" >
        <div class="mainContent">
            <div class="title customContainer">
                <div style="text-transform: uppercase;font-size: 25px">Email validation completed </div>
            </div>
            <div class="content customContainer">
                <div>Thank you for validating your email using the secure link you received </div>
                <div>Please wait for a final activation email, this will be sent to you shortly after the Web Administration has checked all your credential and activated your account.  </div>
            </div>
            <div class="imgCollection customContainer">
                <img src="<?php echo $this->webroot ?>images/imac.png" class="iMac">
                <img src="<?php echo $this->webroot ?>images/iphone.png" class="iPhone">
                <img src="<?php echo $this->webroot ?>images/android.png" class="iPad">
            </div>
        </div>
    </div>    
</div>
<script type="text/javascript">
$(document).ready(function(){
    $(window).scroll( function(){
        /* Check the location of each desired element */

        $('.introFourthDiv .imgCollection').each( function(i){
            var bottom_of_object = $(this).position().top + $(this).outerHeight()/2;
            var bottom_of_window = $(window).scrollTop() + $(window).height();

            /* If the object is completely visible in the window, fade it in */
            if( bottom_of_window > bottom_of_object ){

                $(this).addClass('loaded');

            }

        });
    });
})
</script>