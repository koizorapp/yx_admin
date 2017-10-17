<?php
include("./class/project.class.php");
$p = new project();
// print_r($p->get_module_field(1,"function"));
//$p->get_people(1);
//print_r($p->get_project_module(2));
//$p->get_executor_process(2);
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
    <meta name="apple-mobile-web-app-title" content="" />
    <link rel="stylesheet" href="assets/css/amazeui.min.css" />
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="css/Icomoon/normalize.css" />
    <link href="css/Icomoon/loading.css" rel="stylesheet" type="text/css" />
    </head>

<body data-type="index" class="am-animation-fade">
    <div id="loading">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <div class="object" id="object_one"></div>
                <div class="object" id="object_two"></div>
                <div class="object" id="object_three"></div>
                <div class="object" id="object_four"></div>
            </div>
        </div>
    </div>

    <header class="am-topbar am-topbar-inverse admin-header">
        <div class="am-topbar-brand">
            <a href="javascript:;" class="tpl-logo">
                <img src="assets/img/logo.png" alt="">
            </a>
        </div>
       <!--  <div class="am-icon-list tpl-header-nav-hover-ico am-fl am-margin-right">

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
                <!-- <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
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
                            <i class="am-icon-futbol-o"></i>
                            <span>医院运动中心</span>
                            <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right tpl-left-nav-more-ico-rotate"></i>
                        </a>
                        <ul class="tpl-left-nav-sub-menu"  <?php if($_GET['d']=='YXYDZX'){echo "style=\"display: block;\"";}?>>
                            <li> 
                                <a href="project_list.php?d=YXYDZX"  <?php if($_GET['d']=='YXYDZX'){echo "class=\"nav-link active\"";}?>>
                                    <i class="am-icon-angle-right"></i>
                                    <span>项目列表</span>
                                </a>

                                <a href="module_list.php?d=YXYDZX" >
                                    <i class="am-icon-angle-right"></i>
                                    <span>模块列表</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="tpl-left-nav-item">
                        <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                            <i class="am-icon-leaf"></i>
                            <span>医学美容中心</span>
                            <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right "></i>
                        </a>
                        <ul class="tpl-left-nav-sub-menu" <?php if($_GET['d']=='YXMRZX'){echo "style=\"display: block;\"";}?>>
                            <li>
                                <a href="project_list.php?d=YXMRZX" <?php if($_GET['d']=='YXMRZX'){echo "class=\"nav-link active\"";}?>>
                                    <i class="am-icon-angle-right"></i>
                                    <span>项目列表</span>
                                </a>

                                <a href="module_list.php?d=YXMRZX" >
                                    <i class="am-icon-angle-right"></i>
                                    <span>模块列表</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                     <li class="tpl-left-nav-item">
                        <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                            <i class="am-icon-tint"></i>
                            <span>医学水疗中心</span>
                            <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right "></i>
                        </a>
                        <ul class="tpl-left-nav-sub-menu" <?php if($_GET['d']=='YXSLZX'){echo "style=\"display: block;\"";}?>>
                            <li>
                                <a href="project_list.php?d=YXSLZX" <?php if($_GET['d']=='YXSLZX'){echo "class=\"nav-link active\"";}?>>
                                    <i class="am-icon-angle-right"></i>
                                    <span>项目列表</span>
                                </a>

                                <a href="module_list.php?d=YXSLZX" >
                                    <i class="am-icon-angle-right"></i>
                                    <span>模块列表</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                     <li class="tpl-left-nav-item">
                        <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                            <i class="am-icon-user"></i>
                            <span>男性健康中心</span>
                            <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right "></i>
                        </a>
                        <ul class="tpl-left-nav-sub-menu" <?php if($_GET['d']=='NXJKZX'){echo "style=\"display: block;\"";}?>>
                            <li>
                                <a href="project_list.php?d=NXJKZX" <?php if($_GET['d']=='NXJKZX'){echo "class=\"nav-link active\"";}?>>
                                    <i class="am-icon-angle-right"></i>
                                    <span>项目列表</span>
                                </a>

                                <a href="module_list.php?d=NXJKZX" >
                                    <i class="am-icon-angle-right"></i>
                                    <span>模块列表</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                     <li class="tpl-left-nav-item">
                        <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                            <i class="am-icon-wpforms"></i>
                            <span>牙科中心</span>
                            <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right "></i>
                        </a>
                        <ul class="tpl-left-nav-sub-menu" <?php if($_GET['d']=='YKZX'){echo "style=\"display: block;\"";}?>>
                            <li>
                                <a href="project_list.php?d=YKZX" <?php if($_GET['d']=='YKZX'){echo "class=\"nav-link active\"";}?>>
                                    <i class="am-icon-angle-right"></i>
                                    <span>项目列表</span>
                                </a>

                                <a href="module_list.php?d=YKZX" >
                                    <i class="am-icon-angle-right"></i>
                                    <span>模块列表</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                     <li class="tpl-left-nav-item">
                        <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                            <i class="am-icon-tree"></i>
                            <span>抗衰老中心</span>
                            <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right "></i>
                        </a>
                        <ul class="tpl-left-nav-sub-menu" <?php if($_GET['d']=='KSLZX'){echo "style=\"display: block;\"";}?>>
                            <li>
                                <a href="project_list.php?d=KSLZX" <?php if($_GET['d']=='KSLZX'){echo "class=\"nav-link active\"";}?>>
                                    <i class="am-icon-angle-right"></i>
                                    <span>项目列表</span>
                                </a>

                                <a href="module_list.php?d=KSLZX" >
                                    <i class="am-icon-angle-right"></i>
                                    <span>模块列表</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                     <li class="tpl-left-nav-item">
                        <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                            <i class="am-icon-medkit"></i>
                            <span>会员医疗中心</span>
                            <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right "></i>
                        </a>
                        <ul class="tpl-left-nav-sub-menu" <?php if($_GET['d']=='HYYLZX'){echo "style=\"display: block;\"";}?>>
                            <li>
                                <a href="project_list.php?d=HYYLZX" <?php if($_GET['d']=='HYYLZX'){echo "class=\"nav-link active\"";}?>>
                                    <i class="am-icon-angle-right"></i>
                                    <span>项目列表</span>
                                </a>

                                <a href="module_list.php?d=HYYLZX" >
                                    <i class="am-icon-angle-right"></i>
                                    <span>模块列表</span>
                                </a>
                            </li>
                        </ul>
                    </li>  

                    <li class="tpl-left-nav-item">
                        <a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                            <i class="am-icon-flask"></i>
                            <span>医学检测中心</span>
                            <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right "></i>
                        </a>
                        <ul class="tpl-left-nav-sub-menu" <?php if($_GET['d']=='YXJCZX'){echo "style=\"display: block;\"";}?>>
                            <li>
                                <a href="project_list.php?d=YXJCZX" <?php if($_GET['d']=='YXJCZX'){echo "class=\"nav-link active\"";}?>>
                                    <i class="am-icon-angle-right"></i>
                                    <span>项目列表</span>
                                </a>

                                <a href="module_list.php?d=YXJCZX" >
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
            <ol class="am-breadcrumb">
                <li><a href="#" class="am-icon-home"><?php echo $p->d;?></a></li>
                <li><a href="<?php echo "project_list.php?d={$_GET['d']}";?>">项目列表</a></li>
                <li><a href="#"><?php $p->get_project_p_name();?></a></li>
            </ol>
            <div class="tpl-content-scope">
                <div class="note note-info">
                     <table class="am-table am-table-compact p-table-span" style="width:98%;border-collapse:collapse"  id="p-table-con" align="center" valign="middle">
                            <tbody>
                                <?php $p->get_project_detail_content();?>
                               
                            </tbody>
                    </table>
                </div>
                  <div class="am-btn-group" style="float:right;">
                                                 <a  href="<?php $p->get_page_link($_GET['id'],"project","frist");?>" type="button" class="am-btn am-btn-primary am-round am-btn-xs <?php if($p->get_page_start_end($_GET['id'],"project","frist")==1){echo "am-disabled";}?>">< 上一个</a>
                                                <a type="button" class="am-btn am-btn-primary am-round am-btn-xs" onclick="print();">打印本页</a>
                                                <a type="button" class="am-btn am-btn-primary am-round am-btn-xs" data-am-modal="{target: '#p-del'}">删除本页</a>
                                                <a  href="<?php $p->get_page_link($_GET['id'],"project","last");?>" type="button" class="am-btn am-btn-primary am-round am-btn-xs <?php if($p->get_page_start_end($_GET['id'],"project","last")==1){echo "am-disabled";}?> " >下一个 ></a>
                  </div>
            </div>

            </div>

         

        </div>
                                    <div class="am-modal am-modal-alert" tabindex="-1" id="p-del">
                                      <div class="am-modal-dialog">
                                        <div class="am-modal-hd"></div>
                                        <div class="am-modal-bd">
                                        <span class="am-icon-exclamation-circle"></span>
                                          请确认是否要删除
                                        </div>
                                        <div class="am-modal-footer">
                                        <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                                          <span class="am-modal-btn" id="project-del-sub" del="<?php echo $_GET['id'];?>" dpm="<?php echo $_GET['d'];?>">确认</span>
                                        </div>
                                      </div>
                                    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <script src="assets/js/amazeui.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script type="text/javascript" src="./js/jquery.jqprint-0.3.js"></script>
    <script type="text/javascript" src="./js/jquery-migrate-1.2.1.min.js"></script>

    <script language="javascript">
        function  print(){
                $("#p-table-con").jqprint();
            }

        </script>
</body>

</html>