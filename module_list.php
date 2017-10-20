<?php
include("./class/module.class.php");
$m = new module();
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
    <link rel="stylesheet" href="assets/css/amazeui.min.css" /><!-- 
    <link rel="stylesheet" type="text/css" href="assets/css/amazeui.datatables.min.css"> -->
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="css/amazeui.page.css">
</head>
<body data-type="index" class="am-animation-fade">


    <header class="am-topbar am-topbar-inverse admin-header">
        <div class="am-topbar-brand">
            <a href="javascript:;" class="tpl-logo">
                <img src="assets/img/logo.png" alt="">
            </a>
        </div>
        <!-- <div class="am-icon-list tpl-header-nav-hover-ico am-fl am-margin-right">

        </div> -->

        

        <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

            

            <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-left admin-header-list tpl-header-list" style="margin-left:50px;">
                <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                    <a class="" href="project_list.php?d=YXYDZX" style="color:#666;">
                        <span class="am-icon-product-hunt"></span>  项目中心
                    </a>
                </li>
                <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                    <a class="" href="keyword.php" style="color:#666;">
                        <span class="am-icon-search"></span>  关键词查询
                    </a>
                </li>
              <!--   <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                    <a class="" href="#" style="color:#666;">
                        <span class="am-icon-area-chart"></span>  项目分析
                    </a>
                </li> -->
                 <?php
                if($_SESSION['auth']==1){

                    echo " <li class=\"am-dropdown\" data-am-dropdown data-am-dropdown-toggle>
                    <a  href=\"manage.php\" style=\"color:#666;\">
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


        <div class="tpl-left-nav tpl-left-nav-hover">
            <div class="tpl-left-nav-title">
                部门列表
            </div>
            <div class="tpl-left-nav-list">
                <ul class="tpl-left-nav-menu">
                    

                    <li class="tpl-left-nav-item">
                        <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                            <i class="am-icon-futbol-o" style="width: 30px;"></i>
                            <span>医院运动中心</span>
                            <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right tpl-left-nav-more-ico-rotate"></i>
                        </a>
                        <ul class="tpl-left-nav-sub-menu"  <?php if($_GET['d']=='YXYDZX'){echo "style=\"display: block;\"";}?>>
                            <li> 
                                <a href="project_list.php?d=YXYDZX"  >
                                    <i class="am-icon-angle-right"></i>
                                    <span>项目列表</span>
                                </a>

                                <a href="module_list.php?d=YXYDZX" <?php if($_GET['d']=='YXYDZX'){echo "class=\"nav-link active\"";}?>>
                                    <i class="am-icon-angle-right"></i>
                                    <span>模块列表</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="tpl-left-nav-item">
                        <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                            <i class="am-icon-leaf" style="width: 30px;"></i>
                            <span>医学美容中心</span>
                            <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right "></i>
                        </a>
                        <ul class="tpl-left-nav-sub-menu" <?php if($_GET['d']=='YXMRZX'){echo "style=\"display: block;\"";}?>>
                            <li>
                                <a href="project_list.php?d=YXMRZX">
                                    <i class="am-icon-angle-right"></i>
                                    <span>项目列表</span>
                                </a>

                                <a href="module_list.php?d=YXMRZX" <?php if($_GET['d']=='YXMRZX'){echo "class=\"nav-link active\"";}?>>
                                    <i class="am-icon-angle-right"></i>
                                    <span>模块列表</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                     <li class="tpl-left-nav-item">
                        <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                            <i class="am-icon-tint" style="width: 30px;"></i>
                            <span>医学水疗中心</span>
                            <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right "></i>
                        </a>
                        <ul class="tpl-left-nav-sub-menu" <?php if($_GET['d']=='YXSLZX'){echo "style=\"display: block;\"";}?>>
                            <li>
                                <a href="project_list.php?d=YXSLZX">
                                    <i class="am-icon-angle-right"></i>
                                    <span>项目列表</span>
                                </a>

                                <a href="module_list.php?d=YXSLZX" <?php if($_GET['d']=='YXSLZX'){echo "class=\"nav-link active\"";}?>>
                                    <i class="am-icon-angle-right"></i>
                                    <span>模块列表</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                     <li class="tpl-left-nav-item">
                        <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                            <i class="am-icon-user" style="width: 30px;"></i>
                            <span>男性健康中心</span>
                            <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right "></i>
                        </a>
                        <ul class="tpl-left-nav-sub-menu" <?php if($_GET['d']=='NXJKZX'){echo "style=\"display: block;\"";}?>>
                            <li>
                                <a href="project_list.php?d=NXJKZX">
                                    <i class="am-icon-angle-right"></i>
                                    <span>项目列表</span>
                                </a>

                                <a href="module_list.php?d=NXJKZX" <?php if($_GET['d']=='NXJKZX'){echo "class=\"nav-link active\"";}?>>
                                    <i class="am-icon-angle-right"></i>
                                    <span>模块列表</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                     <li class="tpl-left-nav-item">
                        <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                            <i class="am-icon-wpforms" style="width: 30px;"></i>
                            <span>牙科中心</span>
                            <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right "></i>
                        </a>
                        <ul class="tpl-left-nav-sub-menu" <?php if($_GET['d']=='YKZX'){echo "style=\"display: block;\"";}?>>
                            <li>
                                <a href="project_list.php?d=YKZX">
                                    <i class="am-icon-angle-right"></i>
                                    <span>项目列表</span>
                                </a>

                                <a href="module_list.php?d=YKZX" <?php if($_GET['d']=='YKZX'){echo "class=\"nav-link active\"";}?>>
                                    <i class="am-icon-angle-right"></i>
                                    <span>模块列表</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                     <li class="tpl-left-nav-item">
                        <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                            <i class="am-icon-tree" style="width: 30px;"></i>
                            <span>抗衰老中心</span>
                            <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right "></i>
                        </a>
                        <ul class="tpl-left-nav-sub-menu" <?php if($_GET['d']=='KSLZX'){echo "style=\"display: block;\"";}?>>
                            <li>
                                <a href="project_list.php?d=KSLZX">
                                    <i class="am-icon-angle-right"></i>
                                    <span>项目列表</span>
                                </a>

                                <a href="module_list.php?d=KSLZX" <?php if($_GET['d']=='KSLZX'){echo "class=\"nav-link active\"";}?>>
                                    <i class="am-icon-angle-right"></i>
                                    <span>模块列表</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                     <li class="tpl-left-nav-item">
                        <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                            <i class="am-icon-medkit" style="width: 30px;"></i>
                            <span>会员医疗中心</span>
                            <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right "></i>
                        </a>
                        <ul class="tpl-left-nav-sub-menu" <?php if($_GET['d']=='HYYLZX'){echo "style=\"display: block;\"";}?>>
                            <li>
                                <a href="project_list.php?d=HYYLZX">
                                    <i class="am-icon-angle-right"></i>
                                    <span>项目列表</span>
                                </a>

                                <a href="module_list.php?d=HYYLZX" <?php if($_GET['d']=='HYYLZX'){echo "class=\"nav-link active\"";}?>>
                                    <i class="am-icon-angle-right"></i>
                                    <span>模块列表</span>
                                </a>
                            </li>
                        </ul>
                    </li>  

                    <li class="tpl-left-nav-item">
                        <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                            <i class="am-icon-flask" style="width: 30px;"></i>
                            <span>医学检测中心</span>
                            <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right "></i>
                        </a>
                        <ul class="tpl-left-nav-sub-menu" <?php if($_GET['d']=='YXJCZX'){echo "style=\"display: block;\"";}?>>
                            <li>
                                <a href="project_list.php?d=YXJCZX" >
                                    <i class="am-icon-angle-right"></i>
                                    <span>项目列表</span>
                                </a>

                                <a href="module_list.php?d=YXJCZX" <?php if($_GET['d']=='YXJCZX'){echo "class=\"nav-link active\"";}?>>
                                    <i class="am-icon-angle-right"></i>
                                    <span>模块列表</span>
                                </a>
                            </li>
                        </ul>
                    </li>  



                </ul>
            </div>
        </div>





        <div class="tpl-content-wrapper">
        <!--     <div class="tpl-content-page-title">
                Amaze UI 首页组件
            </div> -->
            <ol class="am-breadcrumb">
                <li><a href="#" class="am-icon-home"><?php echo $m->d;?></a></li>
                <li><a href="#">模块列表</a></li>
            </ol>
            <div class="tpl-content-scope">
                <div class="note note-info">
                    <table class="am-table  am-table-striped am-table-hover  " id="example" style="width:98%;" align="center" valign="middle" >
                            <thead>
                                <tr>
                                    <th >模块编号</th>
                                    <th>模块名称</th>
                                    <th>执行人</th>
                                    <th>设备</th>
                                    <th>用品</th>
                                    <th>作用功能</th>
                                    <th>模块时间</th>
                                    <th ><span style="margin-left:20px;">操作</span></th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php
                                $m->get_module_list();
                               ?>
                            </tbody>
                        </table>
                                 <div id="page5" class="tpl-pagination" style="float:right;"></div>
                          
                    </div>
            </div>

            </div>

         

        </div>

    


    <script src="assets/js/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <script src="assets/js/amazeui.min.js"></script>
    <script src="assets/js/app.js"></script><!-- 
    <script type="text/javascript" src="assets/js/amazeui.datatables.min.js"></script> -->
    <script src="js/amazeui.page.js"></script>
    <script type="text/javascript">
    var page = window.location.search.match(/page=(\d+)/);
    $("#page5").page({
        pages:<?php  $m->page_total();?>,
        prev:'«',
        next:'»',
        curr:page?page[1]:1,
        jump:window.location.href.split('&')[0]+"&page=%page%"
        /*使用回调函数可以处理更复杂的逻辑
        jump:function(context, first){
            if(!first){
                window.location.href = '?page='+context.option.curr;
            }
        }        
        */
    })  
    </script>
  
<!--     <script>
  $(function() {
    $('#example').DataTable();
  });
</script> -->

</body>

</html>