var kbcore = {};

kbcore.effect = function () {
    $(document).ready(function(){
        $('.kb-effect-display').each(function(){
            var delay = $(this).attr('data-delay');
            if (delay) {
                $(this).css('transition-delay', delay + 'ms');
            }
            $(this).css('opacity', '1');
            $(this).css('transform', 'translate(0, 0)');
        });
    });
};

kbcore.loading = function () {
    $(document).ready(function(){
        if ($('body > .kb-loading').length === 0) {
            $('body').append('<div class="kb-loading"><div class="bg-cover"></div><div class="loading-content"><div class="loading-icon"></div><div class="loading-msg"></div></div></div>');
        }
    });
    
    show = function (message) {
        if (message) {
            $('.kb-loading .loading-msg').text(message);
        }
        else {
            $('.kb-loading .loading-msg').text('Loading...');
        }
        $('.kb-loading').show();
    };
    
    hide = function () {
        $('.kb-loading').hide();
    };
};

kbcore.helper = function () {
    getTimeZoneOffsetBrowser = function () {
        var offset = (new Date()).getTimezoneOffset();
    
        var timezones = {
            '-12'   : '-12:00',
            '-11'   : '-11:00',
            '-10'   : '-10:00',
            '-9'    : '-09:00',
            '-8'    : '-08:00',
            '-7'    : '-07:00',
            '-6'    : '-06:00',
            '-5'    : '-05:00',
            '-4'    : '-04:00',
            '-3.5'  : '-03:30',
            '-3'    : '-03:00',
            '-2'    : '-02:00',
            '-1'    : '-01:00',
            '0'     : '00:00',
            '1'     : '+01:00',
            '2'     : '+02:00',
            '3'     : '+03:00',
            '3.5'   : '+03:30',
            '4'     : '+04:00',
            '4.5'   : '+04:30',
            '5'     : '+05:00',
            '5.5'   : '+05:30',
            '6'     : '+06:00',
            '7'     : '+07:00',
            '8'     : '+08:00',
            '9'     : '+09:00',
            '9.5'   : '+09:30',
            '10'    : '+10:00',
            '11'    : '+11:00',
            '12'    : '+12:00'
        };

        return timezones[-offset / 60];
    };
};