$( window ).resize(function() {
    var h = $(window).width();
    if(h < 768){
        $(".title_response").removeClass('hidden-xs');
        $(".title_response").removeClass('ridbon');
        $(".title_response").addClass('not_ridbon');
        $(".title_response").addClass('col-xs-12');
    }else{
        $(".title_response").addClass('ridbon');
        $(".title_response").removeClass('not_ridbon');
        $(".title_response").removeClass('col-xs-12');
    }
});
function getLocation(id) {
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(function(position){
            load_show();
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            $.post(root + 'Cars/khoangcach/'+id, { 'latitude':latitude, 'longitude':longitude },function(data){
                $html = 'Distance from here to this car: '+data.kc+' Kms';
                jAlert($html);
                load_hide();
            },'json');

        });
    }
}

function check_chose(id, arid, the_form)
{
    var n = $('#'+id+':checked').val();
    if(n){
        setCheckboxes(the_form, arid, true);
        $("#"+the_form+" .checker span").addClass('checked');

    }else{
        setCheckboxes(the_form, arid, false);
        $("#"+the_form+" .checker span").removeClass('checked');

    }
}
var Vcore = {};

Vcore.Notification = function(){
    $(".support .arrow").click(function(){
        if( $(".support").hasClass("expand")){
            $(".support").addClass("colspand");
            $(".support").removeClass("expand");
            $(".support").css('left',-570);
            $('.bg-cover-action').hide();
        }else{
            $(".support").css('left',0);
            $(".support").addClass("expand");
            $(".support").removeClass("colspand");
            $('.bg-cover-action').show();
        }
    });
    
    $('.bg-cover-action').click(function () {
        target = $($(this).attr('data-target'));
        
        target.addClass("colspand");
        target.removeClass("expand");
        target.css('left', -570);
        
        $(this).hide();
    });
};
Vcore.Popup = function(){
    $("a.popup").fancybox({
        'padding'            : 0,
        'titleShow' : false ,
        'autoScale'            : false,
        'transitionIn'        : 'elastic',
        'transitionOut'        : 'elastic',
        'hideOnOverlayClick' : false,
        'hideOnContentClick' : false,
        'overlayShow' : false,
        'opacity' : false,
        'type'                : 'ajax'

    });
    $(".close_pop").click(function(){
        $.fancybox.close();
    });
};
Vcore.DeleteCar = function(){
    $(".del_car").click(function(){
        car_id = $(this).attr('car_id');
        url = $(this).attr('url');
        jConfirm('Are you sure you want to delete this car?','Message',function(r) {
          if(r){
              $.post(root + 'Cars/delete',{'id':car_id},function(data){
                  window.location.href = root + '' + url;
              });
          }
        });
        return false;
    });
};
Vcore.Customer = function(){
   
    $(".submit_search_customer").click(function(){
        load_show("Please wait...");
        key = $("input[name='keyword']").val();
        window.location.href = root + 'customer?keyword='+key;
    });

    $(".del_all_customer").click(function(){
        var str_id = '';
        $(".customer input[type='checkbox']").each(function(){
            if($(this).is(":checked")){
                if( $(this).attr("id") != "checkall"){
                    str_id += $(this).val()+'|';
                }
            }
        });
        if(str_id == ''){
            showMessage('Please select the customer you want to delete',1);
        }else{
            jConfirm('Are you sure you want to delete these customers?','Message',function(r) {
              if(r){
                  $.post(root + 'customers/delcustomer',{'str_id':str_id},function(data){
                      window.location.href = root + 'customer';
                  });
              }
            });
            $('.cancel').hide();
            return false;
        }
    });

    $(".del_customer").click(function(){
        link = $(this).attr('href');
        jConfirm('Are you sure you want to delete this user?','Message',function(r) {
          if(r){
              window.location.href = link;
          }
          $('.cancel').hide();
        });
        return false;
    });
    $(".blockuser").click(function(){
        block_id = $(this).attr('user-id');
        item = $(this);
        jConfirm('Are you sure you want to block this dealer?','Message',function(r) {
            if(r){
                load_show();
                $.post(root + 'blockuser',{id:block_id}, function(data){
                    load_hide();
                    if(data.error == 0){
                        item.closest('tr').fadeOut('slow', function() {$(this).remove();});
                        
                        countBlock = parseInt($('.count-block').text());
                        $('.count-block').text(++countBlock);
                        
                        countDealer = parseInt($('.count-dealer').text());
                        if (countDealer > 0) {
                            $('.count-dealer').text(--countDealer);
                            if (countDealer == 0) {
                                $('#NetworkMynetworkForm').hide();
                            }
                        }
                        
                        showMessage('Blocked successfully', 0);
                        //window.location.href = root + 'mynetwork';
                    }else{
                          showMessage('Block user error!',1);
                    }
                },'json');
            }
            $('.cancel').hide();
        });
    });
    $(".un_blockuser").click(function(){
        block_id = $(this).attr('user-id');
        item = $(this);
        jConfirm('Are you sure you want to unblock this dealer?','Message',function(r) {
           if(r){
                load_show();
                $.post(root + 'unblockuser',{id:block_id}, function(data){
                    load_hide();
                    if(data.error == 0){
                        countResult = parseInt($('.count-result').text());
                        if (countResult > 0) {
                            $('.count-result').text(--countResult);
                        }
                        
                        item.closest('tr').fadeOut('slow', function() {$(this).remove();});
                        
                        showMessage('Unblocked successfully', 0);
                        //window.location.href = root + 'block_network';
                    }else{
                        showMessage('Unblock user error!', 1);
                    }
                },'json');
            }
        });
        $('.cancel').hide();
    });
};
Vcore.Addnetwork = function(){
    $(".is_my_network").click(function(){
        request_id = $(this).attr('request_id');
        user_id = $(this).attr('user_id');
        if( $(this).find('i').hasClass('star-yellow') ) {
            jConfirm('Are you sure you want to remove this user from your network?', 'Message', function(r) {
                if(r){
                    load_show();
                    $.post(root + 'network_del', {id:request_id}, function(data){
                        if(data.error == 0){
                            $("a.is_my_network").find('i').removeClass('star-yellow');
                        }
                        showMessage('Remove my network successfully', 0);
                        load_hide();
                    },'json');
                }
              });
            $('.cancel').hide();
            return false;

        }else{
            jConfirm('Do you want to add this dealer to your network?','Message',function(r) {
                if(r){
                    load_show();
                    $.post(root + 'InviteNetworks/add_network', {'request_id':request_id,'user_id':user_id},function(data){
                        if(data.error == 0){
                            //$(this).find('i').addClass('star-yellow');
                            showMessage('An invite to join your network have been sent',0);
                        }else{
                            showMessage(data.msg,1);
                        }
                        load_hide();
                    },'json');
                }
            });
            $('.cancel').hide();
            return false;

        }
    });
};
Vcore.Flicka = {};
Vcore.Flicka.Follow = function(car_id,user_id,type){
    $(document).ready(function(){
        $(document).on('click', '.clickfollow', function() {    
            element = $(this);
            car_id = $(this).attr('car_id');
            user_id = $(this).attr('user_id');
            
            if (element.hasClass('dis_follow')) {
                jConfirm('You don\'t want follow this car?','Messages',function(r){
                    if(r){
                        load_show();
                        $.post(root + 'cars/follow', {'car_id':car_id,'user_id':user_id,'type':1},function(data){
                            load_hide();
                            if(data.error == 1){
                                showMessage(data.msg, data.error);
                            }else{
                                element.removeClass('dis_follow');
                                element.addClass('follow');
                                firstChild = element.find(">:first-child");
                                firstChild.removeClass('star-yellow');
                                firstChild.attr('title', 'Follow this car');
                                
                                $('#' + car_id + '.car-followed').hide("fade", {}, 500);
                                
                                var count = $('.followed .countcars').attr('count-cars') - 1;
                                
                                if(count>1){
                                    var str = " results found";
                                }else{
                                    var str = " result found";
                                }
                                $('.followed .countcars').html(count+str);
                                $('.followed .countcars').attr('count-cars', count);
                                
                                showMessage('Remove follow car successfully', 0);
                            }
                        },'json');
                    }
                });
                $('.cancel').hide();
            }
            else {
                jConfirm('You want follow this car?','Messages',function(r){
                    if(r){
                        load_show();
                        $.post(root + 'cars/follow', {'car_id':car_id,'user_id':user_id,'type':0},function(data){
                            load_hide();
                            if(data.error == 1){
                                showMessage(data.msg, data.error);
                            }else{
                                element.removeClass('follow');
                                element.addClass('dis_follow');
                                firstChild = element.find(">:first-child");
                                firstChild.addClass('star-yellow');
                                firstChild.attr('title', 'Unfollow this car');
                                showMessage('Follow car successfully', 0);
                            }
                        },'json');

                    }
                });
                $('.cancel').hide();
            }
        });
        
//        $(".follow").click(function(){
//            $element = $(this);
//
//            car_id = $(this).attr('car_id');
//            user_id = $(this).attr('user_id');
//            link = $("input[name='link']").val();
//            jConfirm('You want follow this car?','Messages',function(r){
//                if(r){
//                    load_show();
//                    $.post(root + 'cars/follow', {'car_id':car_id,'user_id':user_id,'type':0},function(data){
//                        load_hide();
//                        if(data.error == 1){
//                            showMessage(data.msg, data.error);
//                        }else{
//                            $element.removeClass('follow');
//                            $element.addClass('dis_follow');
//                            $element.find(">:first-child").addClass("star-yellow");
//                            showMessage('Follow car successfully', 0);
//                        }
//                    },'json');
//
//                }
//            });
//        });
//        $(".dis_follow").click(function(){
//            $element = $(this);
//            
//            car_id = $(this).attr('car_id');
//            user_id = $(this).attr('user_id');
//            link = $("input[name='link']").val();
//            jConfirm('You don\'t want follow this car?','Messages',function(r){
//                if(r){
//                    load_show();
//                    $.post(root + 'cars/follow', {'car_id':car_id,'user_id':user_id,'type':1},function(data){
//                        load_hide();
//                        if(data.error == 1){
//                            showMessage(data.msg, data.error);
//                        }else{
//                            $element.removeClass('dis_follow');
//                            $element.addClass('follow');
//                            $element.find(">:first-child").removeClass('star-yellow');
//                            showMessage('Remove follow car successfully', 0);
//                        }
//                    },'json');
//                }
//            });
//        });
    });
};
Vcore.Flicka.Filter = function(){
    $(document).ready(function() {
        $(".c_list_flicka").click(function(){
            if($(this).hasClass('c_list')){
                $(".gridflicka").css('display','none');
                $(this).removeClass('c_list');
                $(".c_grid_flicka").addClass('c_grid');
                $(".listflicka").css('display','block');
                $.cookie('type', 'list');
            }
            
        });
        $(".c_grid_flicka").click(function(){
            if($(this).hasClass('c_grid')){
                $(".listflicka").css('display','none');
                $(this).removeClass('c_grid');
                $(".c_list_flicka").addClass('c_list');
                $(".gridflicka").css('display','block');
                $.cookie('type', 'grid');
            }
        });
        $("ul.selectfilter li a").click(function(){
            var title = $(this).attr('rel');
            $(".c_select").html(title);
        });

        $( "#input-span-price" ).slider({
                //orientation: "vertical",
                range: true,
                min: 0,
                max: 1000000,
                values: [ 0, 1000000 ],
                slide: function( event, ui ) {
                    var val = ui.values[$(ui.handle).index()-1] + "";
                    if( !ui.handle.firstChild ) {
                        $("<div class='tooltip top in' style='display:none;left:-4px;top:-31px;'><div class='tooltip-arrow'></div><div class='tooltip-inner'></div></div>")
                        .prependTo(ui.handle);
                    }
                    $(ui.handle.firstChild).show().children().eq(1).text(val);
                    
                    $price1 = $("#input-span-price .ui-slider-handle:eq(0) .tooltip-inner").text();
                    $price2 = $("#input-span-price .ui-slider-handle:eq(1) .tooltip-inner").text();
                    
                    $price1 = ($price1 === '')? 0 : $price1;
                    $price2 = ($price2 === '')? 1000000 : $price2;
                    
                    $("input[name='price']").val(parseInt($price1));
                    $("span#price").html($price1+' $');
                        
                    $("input[name='price2']").val(parseInt($price2));
                    $("span#price2").html($price2+' $');
                    
                    $($(".tooltip-inner").last()).parent().css({
                        'left': '-4px',
                        'top': '16px'
                    });
                    $($(".tooltip-inner").first()).parent().css({
                        'left': '-4px',
                        'top': '-31px'
                    });
                    $($(".tooltip-inner").last()).prev().addClass('second-holder');
                    $($(".tooltip-inner").first()).prev().removeClass('second-holder');
                }
        }).find('span.ui-slider-handle').on('blur', function(){
                $(this.firstChild).hide();
        });
        $( "#input-span-km" ).slider({
                //orientation: "vertical",
                range: true,
                min: 0,
                max: 1000000,
                values: [ 0, 1000000 ],
                slide: function( event, ui ) {
                    var val = ui.values[$(ui.handle).index()-1] + "";
                    if( !ui.handle.firstChild ) {
                        $("<div class='tooltip top in' style='display:none;left:-5px;top:-31px;'><div class='tooltip-arrow'></div><div class='tooltip-inner'></div></div>")
                        .prependTo(ui.handle);
                    }
                    $(ui.handle.firstChild).show().children().eq(1).text(val);
                    
                    $km1 = $("#input-span-km .ui-slider-handle:eq(0) .tooltip-inner").text();
                    $km2 = $("#input-span-km .ui-slider-handle:eq(1) .tooltip-inner").text();
                    
                    $km1 = ($km1 === '')? 0 : $km1;
                    $km2 = ($km2 === '')? 1000000 : $km2;
                    
                    $("input[name='km']").val(parseInt($km1));
                    $("span#km").html($km1+' km');
                    
                    $("input[name='km2']").val(parseInt($km2));
                    $("span#km2").html($km2+' km');
                    
                    $($(".tooltip-inner").last()).parent().css({
                        'left': '-4px',
                        'top': '16px'
                    });
                    $($(".tooltip-inner").first()).parent().css({
                        'left': '-4px',
                        'top': '-31px'
                    });
                    $($(".tooltip-inner").last()).prev().addClass('second-holder');
                    $($(".tooltip-inner").first()).prev().removeClass('second-holder');
                }
        }).find('span.ui-slider-handle').on('blur', function(){
                $(this.firstChild).hide();
        });

        $(".choosemake").click(function(){
            var link = $("input[name='link']").val();
            make = '';
            $(".c_make").each(function(){
                if($(this).is(":checked")){
                    if ($(this).val() != 'undefined'){
                        make += $(this).val()+',';
                    };
                }
            });
            if(make == ''){
                showMessage('No items selected',1);
            }else{
                window.location.href = link +'?type=Make&make='+make;
            }
        });
        $(".chooseprice").click(function(){
            price = $("input[name='price']").val();
            price2 = $("input[name='price2']").val();
            window.location.href = root +'flicka?type=Price Range&price='+price+'&price2='+price2;
        });
        $(".chooseyear").click(function(){
            year_from = $("select[name='year_from']").val();
            year_to = $("select[name='year_to']").val();
            if (year_to >= year_from) {
                window.location.href = root +'flicka?type=Year Range&year_from='+year_from+'&year_to='+year_to;
            }
            else {
                //$('#year_range').modal("hide");
                showMessage('The To year must be greater than the From year', 1);
            }
        });

        $(".choosebody").click(function(){
            var body = '';
            $(".c_body").each(function(){
                if($(this).is(":checked")){
                    if ($(this).val() != 'undefined'){
                        body += $(this).val()+',';
                    };
                }
            });
            if(body == ''){
                showMessage('No items selected',1);
            }else{
                window.location.href = root +'flicka?type=Body type&body='+body;
            }
            
        });
        $(".choosefuel").click(function(){
            var fuel_type = '';
            $(".c_fuel").each(function(){
                if($(this).is(":checked")){
                    if ($(this).val() != 'undefined'){
                        fuel_type += $(this).val()+',';
                    };
                }
            });
            
            window.location.href = root +'flicka?type=Fuel type&fuel_type='+fuel_type;
        });
         $(".choosekm").click(function(){
            km = $("input[name='km']").val();
            km2 = $("input[name='km2']").val();
            
            km = (km === '') ? 0 : km;
            km2 = (km2 === '') ? 1000000 : km2;
            
            window.location.href = root +'flicka?type=Km Range&km='+km+'&km2='+km2;
        });
    });
};
Vcore.Flicka.CarsforSale = function(){
    //.$('.chosen-select').chosen({allow_single_deselect:true}); 
    
    $(".chosen-select").chosen({no_results_text: "Not found!"});
    $(".changemake").change(function(){
        load_show();
        make = $(this).val();
        $.post(root + 'cars/changemake',{'make':make}, function(data){
            $("#boxModel").html(data);
             $("#boxModel").trigger("chosen:updated");
             load_hide();
        });
    });
    $(".changemodel").change(function(){
        load_show();
        model = $(this).val();
        make = $("select[name='make']").val();

        $.post(root + 'cars/changemodel',{'make':make,'model':model}, function(data){
            $("#boxSeries").html(data);
            $("#boxSeries").trigger("chosen:updated");
            load_hide();
        });
    });
    $(".change_make_SeriesModel").change(function(){
        make = $(this).val();
        load_show();
        $.post(root + 'cars/change_make_Series',{'make':make}, function(data){
            $("input[name='getmake']").val(make);
            $("#boxModel").html(data);
            $("#boxModel").trigger("chosen:updated");
            load_hide();
        });
    });
    $(".changemodel_Series").change(function(){
        load_show();
        make = $("input[name='getmake']").val();
        $.post(root + 'cars/change_Series_Model',{'make':make}, function(data){
            $("#boxSeries").html(data);
            $("#boxSeries").trigger("chosen:updated");
            load_hide();
        });
    });
    
    $("#CarSetForgetForm").validate({
        rules: {
            model: { required: true }
           },
        messages: {
            required: "Please select an item!" 
        }   
    }); 

    $(".info_customer").click(function(){
        $(".cus").css('display','none');
        $(".info_customer").css('background','#fff');
        $(".info_customer").css('color','#333');
        $(this).css('background','#5f5f5f');
        $(this).css('color','#fff');
        $(this).find(".click_cus").css('display','block');
    });
    $(document).click(function (e)
    {
        var container = $(".info_customer");

        if (!container.is(e.target) // if the target of the click isn't the container...
            && container.has(e.target).length === 0) // ... nor a descendant of the container
        {
            $(".cus").css('display','none');
        }
    });
};
Vcore.Flicka.Setforget = function(){
    $(".submit_search_input").change(function(){
        $(".submit_search").click();
    });
    
    $(".submit_search").click(function(){
        load_show();
        key = $("input[name='key']").val().toLowerCase();
        hasData = false;
        $('.row_set').each(function() {
            car = $(this).attr('data-car').toLowerCase();
            if (car.indexOf(key) != -1) {
                $(this).show();
                hasData = true;
            }
            else {
                $(this).hide();
            }
        }); 
        if (hasData) {
            $('.message-nodata').hide();
        }
        else {
            $('.message-nodata').show();
        }
        load_hide();
    });
    
    $(".submit_search_customer_input").change(function(){
        $(".submit_search_customer").click();
    });
    
    $(".submit_search_customer").click(function(){
        load_show();
        key = $("input[name='key']").val().toLowerCase();
        hasData = false;
        $('.info_customer').each(function() {
            name = $(this).attr('data-name').toLowerCase();
            phone = $(this).attr('data-phone').toLowerCase();
            email = $(this).attr('data-email').toLowerCase();
            if (name.indexOf(key) != -1 || phone.indexOf(key) != -1 || email.indexOf(key) != -1) {
                $(this).show();
                hasData = true;
            }
            else {
                $(this).hide();
            }
        }); 
        if (hasData) {
            $('.message-nodata').hide();
        }
        else {
            $('.message-nodata').show();
        }
        load_hide();
    });
    
    
};
Vcore.Flicka.MyStock = function(){
    $(".cancel_retail").click(function () {
        carId = $(this).attr('car-id');
        
        $(".retail-" + carId).show();
        
        inputPrice = $(".retail-input-" + carId);
        inputPrice.hide();
        inputPrice.val($(this).attr('data-pre'));
        
        preBtn = $(this).prev('a');
        
        preBtn.html('<i class="fa fa-pencil"></i>');
        preBtn.removeClass('save_retail');
        preBtn.addClass('edit_retail');
        
        $(this).hide();
    });
    
    $(".bt_edit_retail").click(function(){
        element = $(this);
        
        carId = $(this).attr('car-id');
        if ($(this).hasClass('edit_retail')) {
            $(".retail-" + carId).hide();
            inputPrice = $(".retail-input-" + carId);
            inputPrice.show();
            $(this).removeClass('edit_retail');
            $(this).addClass('save_retail');
            $(this).html('<i class="fa fa-floppy-o"></i>');
            
            nextBtn = $(this).next('a');
            nextBtn.attr('data-pre', inputPrice.val());
            nextBtn.show();
        }
        else {
            price = $(".retail-input-" + carId).val();
            if (!isNaN(parseFloat(price)) && isFinite(price)) {
                jConfirm('Are you sure you want to change price of this car?', 'Messages', function(r){
                    if(r){
                        load_show();
                        $.post(root + 'Cars/ajaxchangecarprice',{car_id:carId, price:price, type:1},function(data){
                            if (data.error == 0) {
                                $(".retail-" + carId).show();
                                $(".retail-" + carId).val(data.price_format);
                                $(".retail-input-" + carId).hide();

                                element.val(data.price);
                                element.html('<i class="fa fa-pencil"></i>');
                                element.next('a').hide();
                                element.removeClass('save_retail');
                                element.addClass('edit_retail');

                                showMessage('Change price successfully', 0);
                            }
                            else {
                                showMessage(data.msg, 1);
                            }
                            load_hide();
                        },'json');
                    }
                });
                $('.cancel').hide();
            }
            else {
                showMessage('Please enter number', 1);
            }
        }
    });
    
    $(".cancel_wholesale").click(function () {
        carId = $(this).attr('car-id');
        
        $(".wholesale-" + carId).show();
        
        inputPrice = $(".wholesale-input-" + carId);
        inputPrice.hide();
        inputPrice.val($(this).attr('data-pre'));
        
        preBtn = $(this).prev('a');
        
        preBtn.html('<i class="fa fa-pencil"></i>');
        preBtn.removeClass('save_wholesale');
        preBtn.addClass('edit_wholesale');
        
        $(this).hide();
    });
    
    $(".bt_edit_who").click(function(){
        element = $(this);
        
        carId = $(this).attr('car-id');
        if ($(this).hasClass('edit_wholesale')) {
            $(".wholesale-" + carId).hide();
            inputPrice = $(".wholesale-input-" + carId);
            inputPrice.show();
            $(this).removeClass('edit_wholesale');
            $(this).addClass('save_wholesale');
            $(this).html('<i class="fa fa-floppy-o"></i>');
            
            nextBtn = $(this).next('a');
            nextBtn.attr('data-pre', inputPrice.val());
            nextBtn.show();
        }
        else {
            price = $(".wholesale-input-" + carId).val();
            if (!isNaN(parseFloat(price)) && isFinite(price)) {
                jConfirm('Are you sure you want to change price of this car?', 'Messages', function(r){
                    if(r){
                        load_show();
                        $.post(root + 'Cars/ajaxchangecarprice',{car_id:carId, price:price, type:0},function(data){
                            if (data.error == 0) {
                                $(".wholesale-" + carId).show();
                                $(".wholesale-" + carId).val(data.price_format);
                                $(".wholesale-input-" + carId).hide();

                                element.val(data.price);
                                element.html('<i class="fa fa-pencil"></i>');
                                element.next('a').hide();
                                element.removeClass('save_wholesale');
                                element.addClass('edit_wholesale');

                                showMessage('Change price successfully', 0);
                            }
                            else {
                                showMessage(data.msg, 1);
                            }
                            load_hide();
                        },'json');
                    }
                });
                $('.cancel').hide();
            }
            else {
                showMessage('Please enter number', 1);
            }
        }
    });

    $(".search_vin").click(function() {
        vin = $("input[name='vin_number']").val();
        
        if (vin) {
            load_show("Please wait...");

            $.post(root + 'Cars/search_vin',{'vin':vin},function(data){
                if (data.Make && data.Series && data.Model) {
                    $('input[name="make"]').val(data.Make);
                    $('input[name="series"]').val(data.Series);
                    $('input[name="model"]').val(data.Model);
                }
                else {
                    showMessage('Cannot found this car', 1);
                    //jAlert('Cannot found this car');
                    $('input[name="make"]').val('');
                    $('input[name="series"]').val('');
                    $('input[name="model"]').val('');
                }
                load_hide();
            },'json');
        }
        else {
            showMessage('Please enter VIN', 1);
        }
    });
};

Vcore.Home = {};
Vcore.Home.UpdateAccount = function(){
    $(document).ready(function() {
//    $("#UserMyprofileForm").validate({
//            errorElement: "div",
//            errorClass: "error",
//            rules: {
//                'name':{
//                    required: true
//                },
//                'phone':{
//                    required: true
//                },
//                'email':{
//                    required: true
//                }
//            },
//            messages: {
//                'name':{
//                    required: 'Please enter your`s name'
//                },
//                'phone':{
//                    required: 'Please enter your`s phone'
//                },
//                'email':{
//                    required: 'Please enter your`s email'
//                }
//            },
//
//            wrapper: "div",
//            errorLabelContainer: ".message"
//        });  
        $(".btn_check_code").on("click",function(){
            var codef = $('input[name="carzapp_code"]').val();
            $.post(root + 'users/check_code',{'codef':codef},function(data){
                $(".data_source").removeAttr("checked");
                if(data.error == 0){
                    $("input[name='company_name']").val(data.companyname);
                    $("input[name='dealer_number']").val(data.dealernumber);
                    $(".data_source").each(function(){
                        var data_id = parseInt($(this).attr("data_id"));
                        for(i = 0; i < data.list.length; i++){
                            var id = parseInt(data.list[i]);
                            if(id == data_id){
                                $(this).prop("checked","checked");
                                console.log(id+" - check");
                            }
                        }
                    });
                }else{
                    $(".login").prop('disabled', 'disabled');
                    showMessage('Not exits code',1);
                }
            },'json');
        });
    });
};

Vcore.Home.SubmitSignIn = function(){
  $(document).ready(function() {
        $('#Login').bootstrapValidator({
            message: 'This value is not valid',
            fields: {
                email: {
                    validators: {
                        notEmpty: {
                            message: 'The email address is required and can\'t be empty'
                        },
                        emailAddress: {
                            message: 'The input is not a valid email address'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'The password is required and can\'t be empty'
                        },
                        identical: {
                            field: 'confirmPassword',
                            message: 'The password and its confirm are not the same'
                        }
                    }
                }
            }
        }).on('success.form.bv', function (e) {
                e.preventDefault();
                var $form = $(e.target),
                validator = $form.data('bootstrapValidator');
                
                var dataPost = $form.serializeArray();
                dataPost.push({name: 'time_zones', value: getTimeZoneBrowser()});

                load_show();
                
                $.post($('#Login').attr('action'), dataPost, function (data) {
                    load_hide();
                    if(data.error == 0){
                        redirect = $('#my_login').attr('data-redirect');
                        if (redirect) {
                            window.location.href = root + redirect;
                        }
                        else {
                            window.location.href = root + 'home';
                        }
                    }else if(data.error == 3){
                        window.location.href = root + 'in_app_purchase';
                    }else if(data.error == 2){
                        $("#my_login").modal('hide');
                        $("#enter_code_device").modal('show');
                    }else{
                        showMessage(data.msg, 1);
                    }

                },'json');
        });
        
        
        $(".view_code").click(function(){
            load_show();
            
            $.post(root + 'RedeemCodes/view_code',function(data){
                if(data.code != ''){
                    $(".buy_app").css('display','none');
                    $(".view_code").parent(".row_op").css('display','none');
                    $(".base_code").html(data.code);
                    $(".enter_code").css('display','block');
                    load_hide();
                }
            },'json');
            
        });
        
    });

};

Vcore.Home.SubmitSignOut = function(){
    window.location = "index.html";
};

Vcore.Home.SubmitForGot = function(){
  $(document).ready(function() {
        $('#Forgot2').validator({
            message: 'This value is not valid',
            fields: {
                password: {
                    validators: {
                        notEmpty: {
                            message: 'The password is required and can\'t be empty'
                        }
                    }
                },
                confirm_password: {
                    validators: {
                        notEmpty: {
                            message: 'The confirm password is required and can\'t be empty'
                        },
                        identical: {
                            field: 'password',
                            message: 'The password and its confirm are not the same'
                        }
                    }
                }
            }
    }).on('success.form.bv', function (e) {
        });
    });

};

function load_show(msg){
    $("#loading").show();
    $("#loading #msg").text(msg);
    $(".se-pre-con").show();
}

function load_hide(){
    $("#loading").hide();
    $(".se-pre-con").fadeOut('slow');
}

$('#myCarousel').carousel({
    interval: 3000
});
$(document).ready(function(){
    $('#checkall').click(function() {  
        if(this.checked) {
            $('.check').each(function() {
                this.checked = true;           
            });
        }else{
            $('.check').each(function() { 
                this.checked = false;                   
            });        
        }
    });

    $('#make .content-make, #body_type .content-make, #fuel_type .content-make').slimscroll({
        size: '4px',
        height: 415
    });
    $('#Notification .notifylist > ul').slimscroll({
        size: '4px',
        height: 500
    });
    
    $('[data-toggle="tooltip"]').tooltip({
        placement : 'bottom'
    });
});

function showMessage($message, $type, callback) {
    /*$type = 0 - Normal; = 1 Error*/
    // set data
    $('.kb-alert-message').attr('data-type', $type);
    $('.kb-message').html($message);
    
    // show message
    $('.kb-alert-message').css('top', 0);
    
    // hide message
    setTimeout(function () {
        $('.kb-alert-message').css('top', -100);
        if ( typeof callback == 'function' ) { 
            callback();
        }
    }, 3000);
}


function GetImagesFlicka($carId) {
    $.post(root + 'ajaxgetimageflicka', {id : $carId}, function(data) {
        if (data.length > 0) {
            str = '';
            for (var i = 0; i < data.length; i++){
                if (i == 5) {
                    break;
                }
                if(i == 4){
                    str += '<li class="last" rel="' + i + '"><img src="' + data[i].image_file_name + '" class="img-responsive" height="40px" width="59.2px"></li>';
                }else{
                    str += '<li class="" rel="' + i + '"><img src="' + data[i].image_file_name + '" class="img-responsive" height="40px" width="59.2px"></li>';
                }
                
            }
            
            $('.thums-' + $carId).html(str);
        }
        else {
            $('.thums-' + $carId).html('');
        }
    },'json');
}

function getTimeZoneBrowser() {
    var offset = (new Date()).getTimezoneOffset();
    
    var timezones = {
        '-12': '-12:00',
        '-11': '-11:00',
        '-10': '-10:00',
        '-9': '-09:00',
        '-8': '-08:00',
        '-7': '-07:00',
        '-6': '-06:00',
        '-5': '-05:00',
        '-4': '-04:00',
        '-3.5': '-03:30',
        '-3': '-03:00',
        '-2': '-02:00',
        '-1': '-01:00',
        '0': '00:00',
        '1': '+01:00',
        '2': '+02:00',
        '3': '+03:00',
        '3.5': '+03:30',
        '4': '+04:00',
        '4.5': '+04:30',
        '5': '+05:00',
        '5.5': '+05:30',
        '6': '+06:00',
        '7': '\+07:00',
        '8': '+08:00',
        '9': '+09:00',
        '9.5': '+09:30',
        '10': '+10:00',
        '11': '+11:00',
        '12': '+12:00'
    };

    return timezones[-offset / 60];
}

function clearBrowserData() {
    localStorage.clear();
}