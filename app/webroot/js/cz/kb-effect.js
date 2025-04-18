function changeProperty(data, status, callback) {
    if (data.target) {
        targetObj = $(data.target);

        if (status === 'back') {
            targetObj.css(data.property, data.from);
        }
        else {
            // get effect transition
            if (data.transition) {
                targetObj.css('transition', data.transition);
            }

            // get speed
            if (data.speed) {
                targetObj.css('transition-duration', data.speed + 'ms');
            }

            // get delay
            if (data.delay) {
                targetObj.css('transition-delay', data.delay + 'ms');
            }

            targetObj.css(data.property, data.to);
        }

        if ( typeof callback == 'function' ) { 
            callback();
        }
    }
    else {
        return false;
    }
}

function pushTo(data, status, callback) {
    // get target
    if (data.target) {
        targetObj = $(data.target);

        // get status push
        if (status === 'back') {
            targetObj.css('transform', 'translate(0,0)');
        }
        else {
            // get effect transition
            if (data.transition) {
                targetObj.css('transition', data.transition);
            }

            // get speed
            if (data.speed) {
                targetObj.css('transition-duration', data.speed + 'ms');
            }

            // get delay
            if (data.delay) {
                targetObj.css('transition-delay', data.delay + 'ms');
            }

            targetObj.css('transform', 'translate(' + data.to + ')');
        }

        if ( typeof callback == 'function' ) { 
            callback();
        }
    }
    else {
        return false;
    }
}
    
$(function() {
    $(document).ready(function () {
        $('.kb-effect-display').each(function(){
            var delay = $(this).attr('kb-effect-delay');
            if (delay) {
                $(this).css('transition-delay', delay + 'ms');
            }
            $(this).css('opacity', '1');
            $(this).css('transform', 'translate(0, 0)');
        });
        
        $('.kb-action-change').each(function(){
            target = $(this).attr('kb-change-target');
            if (target) {
                targetObj = $(target);
                property = $(this).attr('kb-change-property');
                valueFrom = $(this).attr('kb-change-from');
                targetObj.css(property, valueFrom);
            }
        });
        
        $('.kb-action-change').click(function () {
            // get target
            target = $(this).attr('kb-change-target');
            if (target) {
                targetObj = $(target);
                
                // get status push
                status = $(this).attr('kb-change-status');
                if (status === 'back') {
                    property = $(this).attr('kb-change-property');
                    valueFrom = $(this).attr('kb-change-from');
                    targetObj.css(property, valueFrom);
                    
                    $(this).attr('kb-change-status', 'change');
                }
                else {
                    // get effect transition
                    transition = $(this).attr('kb-change-transition');
                    if (transition) {
                        targetObj.css('transition', transition);
                    }
                    
                    // get speed
                    speed = $(this).attr('kb-change-speed');
                    if (speed) {
                        targetObj.css('transition-duration', speed + 'ms');
                    }

                    // get delay
                    delay = $(this).attr('kb-change-delay');
                    if (delay) {
                        targetObj.css('transition-delay', delay + 'ms');
                    }
                    
                    property = $(this).attr('kb-change-property');
                    valueTo = $(this).attr('kb-change-to');
                    targetObj.css(property, valueTo);
                    
                    $(this).attr('kb-change-status', 'back');
                }
            }
            else {
                return false;
            }
        });
        
        $('.kb-action-push').click(function () {
            // get target
            target = $(this).attr('kb-push-target');
            if (target) {
                targetObj = $(target);
                
                // get status push
                status = $(this).attr('kb-push-status');
                if (status === 'back') {
                    targetObj.css('transform', 'translate(0,0)');
                    $(this).attr('kb-push-status', 'push');
                }
                else {
                    // get effect transition
                    transition = $(this).attr('kb-push-transition');
                    if (transition) {
                        targetObj.css('transition', transition);
                    }
                    
                    // get speed
                    speed = $(this).attr('kb-push-speed');
                    if (speed) {
                        targetObj.css('transition-duration', speed + 'ms');
                    }

                    // get delay
                    delay = $(this).attr('kb-push-delay');
                    if (delay) {
                        targetObj.css('transition-delay', delay + 'ms');
                    }
                    
                    pushTo = $(this).attr('kb-push-to');
                    targetObj.css('transform', 'translate(' + pushTo + ')');
                    
                    $(this).attr('kb-push-status', 'back');
                }
            }
            else {
                return false;
            }
        });
    });
});
