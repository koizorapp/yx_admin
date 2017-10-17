<?php
include('./class/public.class.php');
$k= new common();
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>优翔项目管理</title>
    <meta name="description" content="">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="assets/i/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="assets/i/app-icon72x72@2x.png">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <link rel="stylesheet" href="assets/css/amazeui.min.css" />
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <script src="assets/js/echarts.min.js"></script>
    </head>
<body data-type="index" class="am-animation-fade">


    <header class="am-topbar am-topbar-inverse admin-header">

        <div class="am-topbar-brand">
            <a href="javascript:;" class="tpl-logo">
                <img src="assets/img/logo.png" alt="">
            </a>
        </div>

        <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

            <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-left admin-header-list tpl-header-list" style="margin-left:50px;">
                <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                    <a class="" href="project_list.php?d=YXYDZX" style="color:#666;">
                        <span class="am-icon-product-hunt"></span>  项目中心
                    </a>
                </li>
                <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                    <a class="" href="#" style="color:#666;">
                        <span class="am-icon-search"></span>  关键词查询
                    </a>
                </li>
               <!--  <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                    <a class="" href="#" style="color:#666;">
                        <span class="am-icon-area-chart"></span>  项目分析
                    </a>
                </li> -->
                 <?php
                if($_SESSION['auth']==1){

                    echo " <li class=\"am-dropdown\" data-am-dropdown data-am-dropdown-toggle >
                    <a  href=\"manage.php\" style=\"color:#666;\" >
                        <span class=\"am-icon-tasks\"></span>  管理中心
                    </a>
                </li>";
               
                } 
                ?>
            </ul>
            

            <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list tpl-header-list">
                <li class="am-hide-sm-only"><a href="javascript:;" id="admin-fullscreen" class="tpl-header-list-link"><span class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span></a></li>

                <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                    <a class="am-dropdown-toggle tpl-header-list-link" href="javascript:;">
                        <span class="tpl-header-list-user-nick"><?php echo "您好，".$_SESSION['name'];?></span><span class="tpl-header-list-user-ico"> <img src="assets/img/<?php if($_SESSION['sex']==1){ echo "user01.png";}else{ echo "user02.png";} ?>"></span>
                    </a>
                    <ul class="am-dropdown-content">
                        <li><a href="#"><span class="am-icon-bell-o"></span> 资料</a></li>
                        <li><a href="#"><span class="am-icon-cog"></span> 设置</a></li>
                        <li><a href="#" class="logout"><span class="am-icon-power-off"></span> 退出</a></li>
                    </ul>
                </li>
                <li><a href="###" class="tpl-header-list-link logout"><span class="am-icon-sign-out tpl-header-list-ico-out-size"></span></a></li>
            </ul>

        </div>

    </header>







    <div class="tpl-page-container tpl-page-header-fixed">
        <div class="tpl-content-wrapper tpl-content-wrapper-hover">
   
            <div class="tpl-content-scope">
                <div class="note note-info" style="min-height:600px;">
                <div class="portlet-title" style="border-bottom:1px solid #eef1f5;">
                    <div class="caption font-green bold">
                        <span class="label label-sm label-success">关键字查询</span>
                </div>
                </div>

                <center style="margin-top:50px;" >
                    <div class="am-alert am-alert-danger" data-am-alert style="display: none">
                      <p>注意：搜索条件及搜索内容均不可为空！</p>
                    </div>
                    <form class="am-form-inline" method="get" >
                        <div class="am-btn-group">
                             <button type="button" class="am-btn am-btn-secondary am-radius" ><span class="am-icon-pencil"></span> 关键字</button>
                                <select data-am-selected="{searchBox: 1,btnWidth: '120px'}" placeholder=" " name="key" id="s-key-title" style="width:50px">
                                <option value=""></option>
                                  <option value="mc">名称</option>
                                  <option value="zxr">执行人类型</option>
                                  <option value="sb">设备</option>
                                  <option value="yp">用品</option>
                                  <option value="zybw">作用部位</option>
                                  <option value="zygn">作用功能</option>
                                  <option value="syz">适应症</option>
                                  <option value="jjz">禁忌症</option>
                                </select>
                            
                            </div>
                            <div class="am-form-group">
                                <input type="text" name="" class="am-form-field am-radius" style="width:200px;" id="s-key-con">
                            </div>
                            <button type="button" class="am-btn am-btn-success am-round" id="s-sub"><span class="am-icon-search" ></span> 查询</button>
                   
                    </form>
                    </center>
                    
                    <div class="key-con" style="display: none">
                    
                        

                    
                    </div>
                </div>
            </div>

            </div>

         

        </div>


    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/amazeui.min.js"></script>
    <script src="js/main.js" ></script>
    <script src="assets/js/app.js"></script>
    
</body>

</html>