$(function (){
    var navbar_str = "<div class=\"navbar navbar-fixed-top\">\
            <div class=\"navbar-inner\">\
                <div class=\"container\">\
                    <a class=\"btn btn-navbar\" data-toggle=\"collapse\" data-target=\".navbar-inverse-collapse\">\
                        <i class=\"icon-reorder shaded\"></i>\
                    </a>\
                    <a class=\"brand\" href=\"index.php\">诊所病历管理</a>\
                    <div class=\"nav-collapse collapse navbar-inverse-collapse\">\
                        <ul class=\"nav pull-right\">\
                            <li class=\"dropdown\">\
                                <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" style=\"color:red\">遇到问题了？\
                                    <b class=\"caret\"></b>\
                                </a>\
                                <ul class=\"dropdown-menu\">\
                                    <li class=\"nav-header\">不直接的帮助</li>\
                                    <li>\
                                        <a href=\"demo.html\">操作示例</a>\
                                    </li>\
                                    <li class=\"divider\"></li>\
                                    <li class=\"nav-header\">直接的帮助</li>\
                                    <li>\
                                        <a href=\"#\">联系你儿子</a>\
                                    </li>\
                                </ul>\
                            </li>\
                            <li>\
                                <a href=\"index.php\">返回首页</a>\
                            </li>\
                            <li class=\"nav-user dropdown\">\
                                <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">\
                                    <img src=\"images/user.png\" class=\"nav-avatar\" />\
                                    <b class=\"caret\"></b>\
                                </a>\
                                <ul class=\"dropdown-menu\">\
                                    <li>\
                                        <a href=\"#\">Your Profile</a>\
                                    </li>\
                                    <li>\
                                        <a href=\"#\">Edit Profile</a>\
                                    </li>\
                                    <li>\
                                        <a href=\"#\">Account Settings</a>\
                                    </li>\
                                    <li class=\"divider\"></li>\
                                    <li>\
                                        <a href=\"#\">Logout</a>\
                                    </li>\
                                </ul>\
                            </li>\
                        </ul>\
                    </div>\
                    <!-- /.nav-collapse -->\
                </div>\
            </div>\
            <!-- /navbar-inner -->\
        </div>\
        <!-- /navbar -->\
        ";
	$("body").prepend(navbar_str);
    
    var footer_str = "    <div class=\"footer\">\
            <div class=\"container\">\
                <b class=\"copyright\">&copy; 2014 Edmin - EGrappler </b>All rights reserved.\
            </div>\
        </div>\
    ";
    $("body").append(footer_str);
 });