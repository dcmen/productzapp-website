<style>
    .slide > .color-site {
        cursor: pointer;
        font-size: 17px;
    }
    .slide.hide-content .btn-plus-content, .slide .btn-minus-content {
        display: block;
    }
    .slide.hide-content .btn-minus-content, .slide .btn-plus-content {
        display: none;
    }
    .slide.hide-content .slide-content {
        max-height: 0;
        transition: max-height 300ms ease;
    }
    .slide-content {
        padding: 0px 48px;
        transition: max-height 1s ease;
        display: block;
        overflow: hidden;
        max-height: 650px;
    }
    .btn-group-slide {
        float: right;
        margin-top: 5px;
        cursor: pointer;
    }
    .btn-group-slide > .fa {
        font-size: 16px;
        color: #bbb;
    }
    .banner {
        height: 140px;
        text-align: center;
    }
    .search-box {
        position: relative;
        width: 40%;
        display: inline-block;
    }
    .search-box > .fa {
        position: absolute;
        color: #888;
        top: 17px;
        left: 21px;
        font-size: 22px;
        cursor: pointer;
    }
    input.search-input {
        height: 57px;
        border-radius: 33px;
        padding: 0px 60px;
        background-color: rgba(255, 255, 255, 0.89);
        font-size: 15px;
        border: 0;
    }
/*    input.search-input:focus {
        background-color: #fff !important;
        border-color: #fff;
        box-shadow: none;
    }*/
    .txt-header {
        font-size: 30px;
        margin-bottom: 45px;
        margin-top: 0px;
        padding-top: 0px;
    }
    .main_content_terms {
        overflow: hidden;
        padding: 0 5% 5%;
    }
    .main_content_terms p {
        margin: 0px 0 20px;
    }
    body {
        padding: 0 !important;
    }
    .help-header {
        display: none;
    }
    #solution input[type="text"]:focus {
        background-color: #fff !important;
    }
    @media(max-width:768px){

        .banner {
            height: 140px;
            text-align: center;
            margin-top:50px;
        }
    }
    @media(max-width:640px){
        #menu_top {
            display: none;
        }
        .mg-top-navtop {
            margin-top: 22px;
        }
        #solution {
            display: none;
        }
        .help-header {
            display: block;
        }
        .slide {
            border-bottom: 1px solid #dfdfdf;
        }
        .slide > .color-site {
            padding: 13px 10px;
            margin: 0;
        }
        .slide > .color-site > img {
            display: none;
        }
        .main_content_terms p {
            margin: 0px 0 10px;
        }
        .slide-content {
            padding: 0px 15px;
            max-height: 850px;
        }
        .search-box {
            position: relative;
            width: 90%;
            display: inline-block;
        }
        .search-box > .fa {
            top: 10px;
            left: 11px;
            font-size: 15px;
            cursor: pointer;
        }
        input.search-input {
            height: 36px;
            border-radius: 30px;
            padding: 0px 15px 0px 32px;
            background-color: rgba(243, 243, 243, 0.89);
            border-color: rgb(226, 239, 249);
            font-size: 13px;
            border: 0;
        }
        .help-header input.search-input:focus {
            background-color: rgba(243, 243, 243, 0.89) !important;
        }
        .txt-header {
            font-size: 18px;
            margin-bottom: 17px;
            margin-top: 0px;
            padding-top: 23px;
        }
        .navbar-toggle.navbar-mobile {
            display: none;
        }
        #footer {
            display: none;
        }
    }
</style>

<div id="solution" style="margin-top: 0">
    <div class="introabout">
        <div class="support">
            <div class="banner">
                <div class="text-center txt-header"><span>HOW CAN WE HELP</span></div>
                <div class="search-box window">
                    <input class="search-input" type="text" placeholder="Search" />
                    <i class="fa fa-search"></i>
                </div>
            </div>
            <div class="arrow"></div>
        </div>
    </div>
</div>
<div class="help-header">
    <div>
        <div class="col-lg-6 col-md-6 col-sm-5 col-xs-5" style="margin-bottom: 0px;" >
            <img class="img-responsive" src="<?php echo $this->webroot; ?>images/ic_logo_login.png" width="100px">
        </div>
        <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7" style="padding-right: 10px; margin-bottom: 0px; text-align: right;">
            <div class="search-box mobile">
                <input class="search-input" type="text" placeholder="Search" />
                <i class="fa fa-search"></i>
            </div>
        </div>
        
        <div class="col-lg-12 col-xs-12" style="margin-bottom: 0px;">
            <h3 class="color-site" style="font-size: 16px; font-family: sans-serif;">
                CarZapp version 2.1.1 <br/>
                Date: September 2016
            </h3>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div id="mainabout">
    <div class="main_content_terms">
        <div class="slide hide-content">
            <h3 class="color-site">
                <img class="mg-right-8 height-40" src="<?php echo $this->webroot ?>images/1.png">Registration

                <div class="btn-group-slide">
                    <i class="fa fa-plus btn-plus-content"></i>
                    <i class="fa fa-minus btn-minus-content"></i>
                </div>
            </h3>
            <div class="slide-content ct-registration">
                <p>
                    Registration accepts new users, and requires personal details and a subscription payment. The aim of the subscription is to collect vital information to limit users to Dealers only.
                </p>
                <p>
                    A unique CarZapp number is assigned to each new user.
                </p>
                <p>
                    A username is selected by the new user and a password is created
                </p>
                <h3>
                    Information collected includes:
                </h3>
                <p>
                    Personal Information :
                </p>
                <p style="text-align: left">
                    - Name, email, mobile phone number.
                </p>
                <p>
                    Company Information :
                </p>
                <p style="text-align: left">
                    - Company name,
                </p>
                <p style="text-align: left">
                    - Dealer License Number/CarZapp Number
                </p>
                <p>
                    Note: In the case of a Dealership that includes more than one user for the app, The Dealer Principal needs to register first and provide the Dealer License Number. A CarZapp number will be assigned to the Dealer Principal, which will then be given out to subsequent  users who are registering as part of the same Dealership.
                </p>
                <p>
                    Software license numbers that we may interact with:
                </p>
                <p style="text-align: left">
                    - Dealers Solutions, Easy Cars, Other.
                </p>
                <p>
                    Note:  CarZapp Pty Ltd reserves the right to block a user from registering or using the app.
                </p>
            </div>
        </div>
        
        <div class="slide hide-content">
            <h3 class="color-site">
                <img class="mg-right-8 height-40" src="<?php echo $this->webroot ?>images/2.png">Login
                
                <div class="btn-group-slide">
                    <i class="fa fa-plus btn-plus-content"></i>
                    <i class="fa fa-minus btn-minus-content"></i>
                </div>
            </h3>
            <div class="slide-content ct-login">
                <p>
                    The login works by accepting a username and password.
                </p>
                <p>
                    If a user forgets their password, there is a &ldquo;Forgot password&rdquo; feature that allows the user to reset their password based on their email address.
                </p>
                <p>
                    The &ldquo;keep me logged in&rdquo; option, keeps the user logged in to the app until they select to log out. Without selecting this option, the app automatically logs the user out after a prolonged period of inactivity.
                </p>
            </div>
        </div>
        
        <div class="slide hide-content">
            <h3 class="color-site">
                <img class="mg-right-8 height-40" src="<?php echo $this->webroot ?>images/3.png">Home
                
                <div class="btn-group-slide">
                    <i class="fa fa-plus btn-plus-content"></i>
                    <i class="fa fa-minus btn-minus-content"></i>
                </div>
            </h3>
            <div class="slide-content ct-home">
                <p>
                    Welcome and dashboard
                </p>
                <p>
                    Welcome and Dashboard. This screen includes 2 sections: 1) The flicka scrolling banner; and 2) the dashboard with shortcuts. The flicka banner shows images of cars for sale, arranged in an order that is set by the user. The order is random by default, but can be set according to a choice. For example: Newest cars first; price (Ascending/Descending); Age (Ascending/Descending).
                    The images are scrolled across by flicking them back or forward.
                </p>
                <p>
                    The dashboard includes 9 short-cut buttons with summary data:
                </p>
                <p>
                Cars For Sale - Total cars in database; 
                </p>
                <p>
                Cars Followed - Total cars followed;  
                </p>
                <p>
                Set&Forget - Total cars in Set&Forget;  
                </p>
                <p>
                Zapp Chat - Total chats unread; 
                </p>
                <p>
                My Network - Total Dealers in network; 
                </p>
                <p>
                My Stock - Total cars in own stock;  
                </p>
                <p>
                Flicka ; 

                <p>
                My Customer - Total Customers;
                </p>
            </div>
        </div>
        
        <div class="slide hide-content">
            <h3 class="color-site">
                <img class="mg-right-8 height-40" src="<?php echo $this->webroot ?>images/4.png">Flicka
                
                <div class="btn-group-slide">
                    <i class="fa fa-plus btn-plus-content"></i>
                    <i class="fa fa-minus btn-minus-content"></i>
                </div>
            </h3>
            <div class="slide-content ct-flicka">
                <p>
                    Flicka is a section of the site that display cars quickly by only showing a large image and some summary details. The screen offers 2 methods of scrolling:
                    1) by flicking through the images; or by clicking on the large Left and Right buttons. The middle star allows you to quickly tag cars you like, and add
                    them to your favourite list.
                </p>
                <p>
                    Flicka allows you to quickly scroll through all cars in the database.
                </p>
            </div>
        </div>
        
        <div class="slide hide-content">
            <h3 class="color-site">
                <img class="mg-right-8 height-40" src="<?php echo $this->webroot ?>images/5.png">Cars For Sale
                
                <div class="btn-group-slide">
                    <i class="fa fa-plus btn-plus-content"></i>
                    <i class="fa fa-minus btn-minus-content"></i>
                </div>
            </h3>
            <div class="slide-content ct-car4sale">
                <p>
                    Enter a keyword or search using the drop down filters to search for cars. Options are to enter a keyword and search all makes, or select filters starting with make, and then, adding model, series, variant, year and other filters.
                </p>
            </div>
        </div>
        
        <div class="slide hide-content">
            <h3 class="color-site">
                <img class="mg-right-8 height-40" src="<?php echo $this->webroot ?>images/6.png">Set &amp; Forget
                
                <div class="btn-group-slide">
                    <i class="fa fa-plus btn-plus-content"></i>
                    <i class="fa fa-minus btn-minus-content"></i>
                </div>
            </h3>
            <div class="slide-content ct-setforget">
                <p>
                    This section allows you to setup parameters for car that is required but is not in the complete CarZapp inventory - across all dealers. As soon as a car
                    comes into the collective inventory, a push notification will alert the dealer who has created the SnF record.
                </p>
                <p>
                    Each SnF record may also be tagged against a customers name, if the SnF is for a particular customer,
                </p>
                <p>
                    Each Snf May also be broadcast to a list of Dealers, making them aware that tis car is required.
                </p>
                <p>
                    This feature may be restricted in future and additional charges may apply. (It can consume much server processing power, and incur other data charges)
                </p>
            </div>
        </div>
        
        <div class="slide hide-content">
            <h3 class="color-site">
                <img class="mg-right-8 height-40" src="<?php echo $this->webroot ?>images/7.png">Cars Followed
                
                <div class="btn-group-slide">
                    <i class="fa fa-plus btn-plus-content"></i>
                    <i class="fa fa-minus btn-minus-content"></i>
                </div>
            </h3>
            <div class="slide-content ct-carfollowed">
                <p>
                    By following cars, you are creating a list of cars, that are tracked and notifications are sent if any changes are made to these cars.
                </p>
            </div>
        </div>
        
        <div class="slide hide-content">
            <h3 class="color-site">
                <img class="mg-right-8 height-40" src="<?php echo $this->webroot ?>images/8.png">My Stock
                
                <div class="btn-group-slide">
                    <i class="fa fa-plus btn-plus-content"></i>
                    <i class="fa fa-minus btn-minus-content"></i>
                </div>
            </h3>
            <div class="slide-content ct-mystock">
                <p>
                    This section displays each Dealers individual inventory. Cars are added to the app via direct XML datafeeds which are pushed to the app at scheduled times, direct from third party data providers. Cars may also be added via a manual keyboard entry and upload images and videos, from the mobile phone image library or camera.
                </p>
                <p>
                    This module includes a VIN lookup, which speeds up the process of adding new cars. VIN lookups connect to third party data providers and retrieve all details on a car based on the unique VIN chassis number. In the future, a registration plate lookup will be available Pending Australian government approval.
                </p>
            </div>
        </div>
        
        <div class="slide hide-content">
            <h3 class="color-site">
                <img class="mg-right-8 height-40" src="<?php echo $this->webroot ?>images/9.png">My Customers
                
                <div class="btn-group-slide">
                    <i class="fa fa-plus btn-plus-content"></i>
                    <i class="fa fa-minus btn-minus-content"></i>
                </div>
            </h3>
            <div class="slide-content ct-mycustomer">
                <p>
                    This module maintains a list of customers. The Dealer may record existing and new customers names and numbers. The My Customer module provides for a real time customer relationship management function, with direct phone, SMS and email links to customers, keeping them informed of the status of their requests.
                </p>
            </div>
        </div>
        
        <div class="slide hide-content" >
            <h3 class="color-site">
                <img class="mg-right-8 height-40" src="<?php echo $this->webroot ?>images/10.png">Zapp Chat
                
                <div class="btn-group-slide">
                    <i class="fa fa-plus btn-plus-content"></i>
                    <i class="fa fa-minus btn-minus-content"></i>
                </div>
            </h3>
            <div class="slide-content ct-zappchat">
                <p>
                    Zapp Chat is a real-time in-app, chat system. Each chat is linked to a car. This enables two Dealers to engage in a chat communication about a particular car. The Zapp Chats are initiated from the car listing page. After a chat is initiated, it is then visible in the Zapp Chat module.  Users may continue each chat at any stage from the Zapp Chat module or from the car listing page and chat in real time.
                </p>
            </div>
        </div>
        
        <div class="slide hide-content" >
            <h3 class="color-site">
                <img class="mg-right-8 height-40" src="<?php echo $this->webroot ?>images/11.png">Invite Dealer
                
                <div class="btn-group-slide">
                    <i class="fa fa-plus btn-plus-content"></i>
                    <i class="fa fa-minus btn-minus-content"></i>
                </div>
            </h3>
            <div class="slide-content ct-invitedealer">
                <p>
                This is a key feature short cut to invite Dealers to download the app and join the Dealer network. With this link, Dealers immediately invite colleagues to the platform to start trading.
                </p>
            </div>
        </div>
        
        <div class="slide hide-content" >
            <h3 class="color-site">
                <img class="mg-right-8 height-40" src="<?php echo $this->webroot ?>images/12.png">My Network
                
                <div class="btn-group-slide">
                    <i class="fa fa-plus btn-plus-content"></i>
                    <i class="fa fa-minus btn-minus-content"></i>
                </div>
            </h3>
            <div class="slide-content ct-mynetwork">
                <p>
                Each Dealer&#39;s may maintain a personalised list of their preferred Dealers. The purposes of My Network is:
                </p>
                <p style="text-align: left;">
                + Set &amp; Forget records are only sent within the Dealers in &ldquo;My Network&rdquo; (Network).
                </p>
                <p style="text-align: left;">
                + View others Set &amp; Forget records with permission.
                </p>
                <p style="text-align: left;">
                + Dealers can block other Dealers from seeing their products or communicating with them if they&#39;re not in their Network.
                </p>
                <p style="text-align: left;">
                + Create sub-groups in the Network grouping other Dealers into preferred categories for quick access to them.
                </p>
            </div>
        </div>
        
        <div class="slide hide-content" style="border-bottom: 0">
            <h3 class="color-site">
                <img class="mg-right-8 height-40" src="<?php echo $this->webroot ?>images/13.png">Settings
                
                <div class="btn-group-slide">
                    <i class="fa fa-plus btn-plus-content"></i>
                    <i class="fa fa-minus btn-minus-content"></i>
                </div>
            </h3>
            <div class="slide-content ct-invitedealer">
                <p>
                In this section, the following setup parameters are maintained:
                </p>
                <p style="text-align: left;">
                + My profile: Including personal information,
                </p>
                <p style="text-align: left;">
                + General: email templates,
                </p>
                <p style="text-align: left;">
                + Notification: Push notification setting preferences,
                </p>
                <p style="text-align: left;">
                + Other Settings: not used yet,
                </p>
                <p style="text-align: left;">
                + Flicka:  Set the order of cars appearing in Flicka
                </p>
                <p style="text-align: left;">
                + Transfer:  Transfer of cars between users, as cars are assigned to employees in a multi user car Dealership. By assigning cars, the app transfers them from a default user to another user.
                </p>
                <p style="text-align: left;">
                + Purge/Delete ZappChat messages:  Purge and delete old data
                </p>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.color-site').click(function () {
            $(this).closest('.slide').toggleClass('hide-content');
        });
        
        $('.search-box.window > .fa-search').click(function () {
            var search = $('.search-box.window .search-input').val();
            if (search) {
                $('.slide-content').each(function() {
                    if ($(this).text().search(new RegExp(search, "i")) > 0) {
                        $(this).closest('.slide').removeClass('hide-content');
                    }
                    else {
                        $(this).closest('.slide').addClass('hide-content');
                    }
                });
            }
        });
        
        $('.search-box.window .search-input').keypress(function (e) {
            if (e.which == 13) {
                $('.search-box.window > .fa-search').click();
            }
        });
        
        $('.search-box.mobile > .fa-search').click(function () {
            var search = $('.search-box.mobile .search-input').val();
            if (search) {
                $('.slide-content').each(function() {
                    if ($(this).text().search(new RegExp(search, "i")) > 0) {
                        $(this).closest('.slide').removeClass('hide-content');
                    }
                    else {
                        $(this).closest('.slide').addClass('hide-content');
                    }
                });
            }
        });
        
        $('.search-box.mobile .search-input').keypress(function (e) {
            if (e.which == 13) {
                $('.search-box.mobile > .fa-search').click();
            }
        });
    });
</script>