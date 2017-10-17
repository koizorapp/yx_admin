<?php 
include('./class/manage.class.php');
$m=new manage();
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
    <link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.css">
    </head>
<body data-type="generalComponents" >


    <header class="am-topbar am-topbar-inverse admin-header ">
        <div class="am-topbar-brand">
            <a href="javascript:;" class="tpl-logo">
                <img src="assets/img/logo.png" alt="">
            </a>
        </div>
        <div class="am-icon-list tpl-header-nav-hover-ico am-fl am-margin-right" id="switch_navigation">

        </div>


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
                <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                    <a class="" href="#" style="color:#666;">
                        <span class="am-icon-area-chart"></span>  项目分析
                    </a>
                </li>
                <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                    <a class="" href="#" style="color:#666;">
                        <span class="am-icon-tasks"></span>  管理中心
                    </a>
                </li>
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
                <li><a href="#" class="tpl-header-list-link logout" ><span class="am-icon-sign-out tpl-header-list-ico-out-size"></span></a></li>
            </ul>

        </div>
    </header>


    <div class="tpl-page-container tpl-page-header-fixed am-animation-fade">
        <div>
            <div class="tpl-portlet-components">
                <div class="portlet-title">
                    <div class="caption font-green bold">
                        <span class="am-icon-edit" id="m-title-text"> 添加项目</span> 
                    </div>


                </div>

                <div class="tpl-block" >
					
                    <div class="am-g" >
					
		<!------------------------------------ 添加模块-->
                        <div class="tpl-form-body tpl-form-line" id="m-m-con" >

                            <form class="am-form tpl-form-line-form" id="m-m-form">
                                <div class="am-form-group">
                                    <label for="user-email" class="am-u-sm-3 am-form-label" > 模块名称：</label>
                                    <div class="am-u-sm-9">
                                        <input type="text" placeholder="" id="m-m-name" value="" disabled="disabled">
                                        <div class="am-alert am-alert-danger" id="m--module-name-war" style="display: none;">错误：名称中不允许包含 _ 符号！</div>
                                    </div>
                                </div>


                                <div class="am-form-group" id="m-e-dpm">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">所属中心：</label>
                                    <div class="am-u-sm-9">
                                            <select data-am-selected="{btnWidth:300,maxHeight: 200}" placeholder=" " id="m-m-dpm">
                                            <option value=""></option>
                                             <?php $m->get_select("department","name","");?>
                                            </select> 
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-phone" class="am-u-sm-3 am-form-label">执行诊室：</label>
                                    <div class="am-u-sm-9">
                                        <select data-am-selected="{btnWidth:300,maxHeight: 200}"   placeholder=" " id="m-m-room">
                                        <option value=""></option>
                                          <?php $m->get_select("room","name","");?>
                                        </select> 
                                        </div>
                                </div>


                                <div class="am-form-group">
                                    <label for="user-phone" class="am-u-sm-3 am-form-label">执行人：</label>
                                    <div class="am-u-sm-9">
                                         <select  multiple data-am-selected="{searchBox: 1,btnWidth:300,maxHeight: 200}"  placeholder=" " id="m-m-exp">
                                            <option value=""></option>
	                                         <?php $m->get_select("executor_info","title","group by `title`");?>
                                        </select>
                                        </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-phone" class="am-u-sm-3 am-form-label">设备：</label>
                                    <div class="am-u-sm-9">
                                        <select  multiple data-am-selected="{searchBox: 1,btnWidth:300,maxHeight: 200}"   placeholder=" " id="m-m-device">
                                        <option value=""></option>
                                           <?php $m->get_select("device","name","");?>
                                        </select> 
                                        </div>
                                </div>

                                  <div class="am-form-group">
                                    <label for="user-phone" class="am-u-sm-3 am-form-label">用品：</label>
                                    <div class="am-u-sm-9">
                                        <select multiple data-am-selected="{searchBox: 1,btnWidth:300,maxHeight: 200}" placeholder=" " id="m-m-apl">
                                        <option value=""></option>
                                           <?php $m->get_select("appliance","name","");?>
                                        </select>
                                        </div>
                                </div>

                                  <div class="am-form-group">
                                    <label for="user-phone" class="am-u-sm-3 am-form-label">作用部位：</label>
                                    <div class="am-u-sm-9">
                                        <select  multiple data-am-selected="{searchBox: 1,btnWidth:300,maxHeight: 200}"   placeholder=" " id="m-m-site">
                                        <option value=""></option>
                                           <?php $m->get_select("site","name","");?>
                                        </select> 
                                        </div>
                                </div>

                                  <div class="am-form-group">
                                    <label for="user-phone" class="am-u-sm-3 am-form-label">作用功能：</label>
                                    <div class="am-u-sm-9">
                                        <select  multiple data-am-selected="{searchBox: 1,btnWidth:300,maxHeight: 200}"   placeholder=" " id="m-m-function">
                                        <option value=""></option>
                                           <?php $m->get_select("function","name","");?>
                                        </select> 
                                        </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-phone" class="am-u-sm-3 am-form-label">适应症：</label>
                                    <div class="am-u-sm-9">
                                        <select  multiple data-am-selected="{searchBox: 1,btnWidth:300,maxHeight: 200}"   placeholder=" " id="m-m-idc">
                                        <option value=""></option>
                                           <?php $m->get_select("indication","name","");?>
                                        </select> 
                                        </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-phone" class="am-u-sm-3 am-form-label">禁忌症：</label>
                                    <div class="am-u-sm-9">
                                        <select  multiple data-am-selected="{searchBox: 1,btnWidth:300,maxHeight: 200}"   placeholder=" " id="m-m-ctd">
                                        <option value=""></option>
                                          <?php $m->get_select("contraindication","name","");?>
                                        </select> 
                                        </div>
                                </div>

                            <div class="am-form-group">
                                    <label for="user-phone" class="am-u-sm-3 am-form-label">年龄限制：</label>
                                         <div class="am-u-sm-9">
                                                <span>
                                                    <label class="am-checkbox-inline">
                                                                   <input type="checkbox" value="" data-am-ucheck id="m-m-age-n">无限制
                                                      </label>
                                                  </span>
                                                  <span style="margin-left:10px;">
                                                <input type="text" id="m-m-age-b" > 
                                  				<span class="m-span" >至</span>
                                  			    <input type="text" id="m-m-age-e" >
                                                </span>
                                                <div class="am-alert am-alert-danger" id="m-m-module-age-war" style="display: none;">错误：年龄只允许输入数字</div>
                                        </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-email" class="am-u-sm-3 am-form-label" >服务时间：</label>
                                    <div class="am-u-sm-9">
                                        <input type="text"  placeholder="请输入分钟数" id="m-m-time">
                                        <div class="am-alert am-alert-danger" id="m-m-module-time-war" style="display:none ;">错误：时间只允许输入数字</div>
                                    </div>
                                </div>

                    
                                <div class="am-form-group">
                                    <label for="user-intro" class="am-u-sm-3 am-form-label">是否医疗：</label>
                                    <div class="am-u-sm-9">
                                        <div class="tpl-switch">
                                            <input type="checkbox" class="ios-switch bigswitch tpl-switch-btn" id="m-m-is-yl">
                                            <div class="tpl-switch-btn-view">
                                                <div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <div class="am-u-sm-9 am-u-sm-push-3">
                                        <button type="button" class="am-btn am-btn-primary am-radius am-btn-sm tpl-btn-bg-color-success" id="m-m-sub"><i class="am-icon-check"></i> 提交</button>
                                    </div>
                                </div>
								
									<div class="am-modal am-modal-alert" tabindex="-1" id="m-m-sub-info">
									  <div class="am-modal-dialog">
										<div class="am-modal-hd"></div>
										<div class="am-modal-bd">
										<span class="am-icon-exclamation-circle"></span>
										  请确认提交的信息无误
										</div>
										<div class="am-modal-footer">
										<span class="am-modal-btn" data-am-modal-cancel>检查一下</span>
										  <span class="am-modal-btn" id="m-m-last-sub">继续提交</span>
										</div>
									  </div>
									</div>
		
									
                            </form>

                    </div>
		<!------------------------------------ 添加模块---------------------------------------------->
                </div>
				
                

            </div>


        </div>

        </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/amazeui.min.js"></script>
    <script src="assets/js/app.js"></script>
     <script src="js/main.js"></script>

</body>

</html>