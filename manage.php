<?php 
include('./class/manage.class.php');
//ini_set('display_errors',1);
error_reporting(E_ALL || ~E_NOTICE);
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
<body data-type="generalComponents" class=" am-animation-fade">


    <header class="am-topbar am-topbar-inverse admin-header">
        <div class="am-topbar-brand">
            <a href="javascript:;" class="tpl-logo">
                <img src="assets/img/logo.png" alt="">
            </a>
        </div>
       <!--  <div class="am-icon-list tpl-header-nav-hover-ico am-fl am-margin-right" id="switch_navigation">

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


    <div class="tpl-page-container tpl-page-header-fixed">


        <div class="tpl-left-nav tpl-left-nav-hover" >
            <div class="tpl-left-nav-title">
                管理中心
            </div>
            <div class="tpl-left-nav-list" >
                <ul class="tpl-left-nav-menu">
                    <li class="tpl-left-nav-item">
                        <a href="#" class="nav-link " id="add-project">
                            <i class="am-icon-check-square-o"></i>
                            <span >添加项目</span>
                        </a>
                    </li>
                   <li class="tpl-left-nav-item">
                        <a href="#" class="nav-link " id="add-module">
                            <i class="am-icon-check-square-o"></i>
                            <span >添加模块</span>
                        </a>
                    </li>
                  
                  <li class="tpl-left-nav-item">
                        <a href="#" class="nav-link " id="add-label">
                            <i class="am-icon-check-square-o"></i>
                            <span >添加标签</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>


         
        <div class="tpl-content-wrapper ">
            <div class="tpl-portlet-components">
                <div class="portlet-title">
                    <div class="caption font-green bold">
                        <span class="am-icon-edit" id="m-title-text"> 添加项目</span> 
                    </div>


                </div>

                <div class="tpl-block" >
					
                    <div class="am-g" >
		<!--------------------------------------------------------------- 添加项目-->

                        <div class="tpl-form-body tpl-form-line"  id="m-p-con">

                            <form class="am-form tpl-form-line-form" >
                                <div class="am-form-group">
                                    <label  class="am-u-sm-3 am-form-label"><i class="am-icon-spinner am-icon-pulse" id="m-p-ck_name-ico" style="display: none"></i> 项目名称：</label>
                                    <div class="am-u-sm-9">
                                        <input type="text" placeholder="" id="m-p-name">
                                         <div class="am-alert am-alert-danger" id="m-p-name-war" style="display:none;">
	                                        </div>
                                    </div>
                                </div>


                                <div class="am-form-group">
                                    <label  class="am-u-sm-3 am-form-label">所属中心：</label>
                                    <div class="am-u-sm-9">
                                            <select data-am-selected="{btnWidth:300}" placeholder=" " id="m-p-dpm">
                                            <option value=""></option>
                                               <?php $m->get_select("department","name","");?>
                                            </select> 
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label  class="am-u-sm-3 am-form-label">项目类别：</label>
                                    <div class="am-u-sm-9">
                                        <select data-am-selected="{btnWidth:300}"   placeholder=" " id="m-p-type">
                                        <option value=""></option>
                                        </select> 
                                        </div>
                                </div>
								
								<div class="am-form-group">
                                    <label  class="am-u-sm-3 am-form-label">市场价格：</label>
                                    <div class="am-u-sm-9">
                                        <input type="text" placeholder="" id="m-p-mk_p">
                                         <div class="am-alert am-alert-danger" id="m-p-mk_p-war" style="display:none ;">错误：市场价格只允许输入数字！
	                                        </div>
                                    </div>
                                </div>
								
								<div class="am-form-group">
                                    <label  class="am-u-sm-3 am-form-label">会员价格：</label>
                                    <div class="am-u-sm-9">
                                        <input type="text" placeholder="" id="m-p-mb_p">
                                         <div class="am-alert am-alert-danger" id="m-p-mb_p-war" style="display:none ;">错误：会员价格只允许输入数字！
	                                        </div>
                                    </div>
                                </div>
								
								<div class="am-form-group">
                                    <label  class="am-u-sm-3 am-form-label" >添加模块：</label>
                                    <div class="am-u-sm-9">
                                        <a class="am-btn am-btn-success am-radius am-btn-sm" id="m-p-add-module" href="#"  ><i class="am-icon-edit"></i> 添加</a>
                                        <a class="am-btn am-btn-danger am-radius am-btn-sm" href="#" id="m-p-del-module" style="display: none"><i class="am-icon-trash"></i> 删除</a>
                                    </div>


									<div class="am-modal am-modal-no-btn" tabindex="-1" id="doc-modal-1">
										<div class="am-modal-dialog" >
											<div class="am-modal-hd">模块库
											  <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
											</div>
										<div class="am-modal-bd" style="overflow:auto;height:500px;background:#fff;" id="m-jump-con">
										


										<table class="am-table am-table-compact" style="font-size:12px;width:1170px;">
											
												<tr style="position:fixed;height:45px;z-index:9999" bgcolor="#fff">
													<td >
														<div style="width:1165px;background:#fff;-webkit-box-shadow:0px 2px 3px rgba(34,25,25,0.4);height:38px;">
															<div style="width:1160px;">

															<div class="am-btn-group" style="float:left">
																<button type="button" class="am-btn am-btn-default am-btn-sm">所属中心</button>
																<select data-am-selected="{btnWidth:100, btnSize: 'sm'}"   placeholder="" id="m-p-m-dpm">
																	  <option value="all">全部</option>
																	  <?php $m->get_select('department','name','');?>
																	</select>
															  </div>
															  
															  <div class="am-btn-group" style="float:left">
																<select data-am-selected="{btnWidth:100, btnSize: 'sm'}"   placeholder="" id="m-p-field-s">
																	  <option value="no">不选择</option>
																	  <option value="mc">模块名称</option>
									                                  <option value="zxr">执行人类型</option>
									                                  <option value="sb">设备</option>
									                                  <option value="yp">用品</option>
									                                  <option value="zybw">作用部位</option>
									                                  <option value="zygn">作用功能</option>
									                                  <option value="syz">适应症</option>
									                                  <option value="jjz">禁忌症</option>
																	</select>
																<input type="text" style="display:inline;width:98px;" class="am-radius am-input-sm" disabled="disabled" id="m-p-field-con">

															  </div>
															  <div style="float:left">
                                                       <a class="am-btn am-btn-warning am-radius am-btn-sm" id="m-add-mod-s">查询</a>
                                                      </div>

															  <div class="am-btn-group" style="float:right;">
																<button type="button" class="am-btn am-btn-default am-radius am-btn-sm" >
																  模块数量：<span id="m-p-c-moduleNum">0</span>
																</button>
																<a class="am-btn am-btn-secondary am-radius am-btn-sm" id="m-p-module-add">添加</a>
                 <input type="hidden" id="m-p-module-val" value="">
															  </div>

															  
															</div>

														</div>
															
														 
													</td>
												</tr>

										</table>
										  <table class="am-table am-table-compact am-table-bordered am-table-radius am-table-striped am-table-hover" style="font-size:12px;width:1170px;margin-top:55px;">
											<thead>
												<tr style="display:none" id="m-p-filedCon-war">
													<th colspan="16" >
														<div class="am-alert am-alert-danger" data-am-alert >
									                      <p></p>
									                    </div>
													</th>
												</tr>
												<tr >
													<th></th>
													<th>模块编号</th>
													<th>所属中心</th>
													<th>模块名称</th>
													<th>执行人等级</th>
													<th>服务时间</th>
													<th>设备</th>
													<th>用品</th>
													<th>区域</th>
													<th>是否医疗</th>
													<th>部位</th>
													<th>功能</th>
													<th>适应症</th>
													<th>禁忌症</th>
													<th>性别限制</th>
													<th>年龄限制</th>
												</tr>
											</thead>
											<tbody id="m-p-module-con">
												
												
											</tbody>
										  </table>
										</div>
									  </div>
									</div>
                                </div>

													

                                 <div class="am-form-group" id="m-p-moule-list" style="display: none">
																											      <label class="am-u-sm-3" ></label>
																											      <div class="am-u-sm-9">
																											      <select multiple class=""  data-am-selected="{btnWidth:300,btnSize: 'sm', btnStyle: 'secondary'}" placeholder="已选模块">
																											      </select>
																											      <input type="hidden" value="" id="m-p-final-module">
																											     </div>
																											    </div>

                                <div class="am-form-group">
                                    <label  class="am-u-sm-3 am-form-label" >项目描述：</label>
                                    <div class="am-u-sm-9">
                                        <textarea class="" rows="5" id="m-p-describe" ></textarea>
                                    </div>
                                </div>
								
							                         	<div class="am-form-group">
                                    <label for="user-email" class="am-u-sm-3 am-form-label" >项目时间：</label>
                                    <div class="am-u-sm-9">
                                        <input type="text"  placeholder="请输入分钟数" id="m-p-time">
                                         <div class="am-alert am-alert-danger" id="m-p-time-war" style="display:none;">错误：项目时间只允许输入数字！
	                                        </div>
                                         <div class="am-alert am-alert-danger" id="m-p-time-war2" style="display:none;">
                                         </div>
                                    </div>
                                </div>
								
                    

                                <div class="am-form-group">
                                    <div class="am-u-sm-9 am-u-sm-push-3">
                                        <button type="button" class="am-btn am-btn-primary am-radius am-btn-sm tpl-btn-bg-color-success "  id="m-p-sub"><i class="am-icon-check"></i> 提交</button>
                                    </div>
                                </div>
                      								
                      									<div class="am-modal am-modal-alert" tabindex="-1" id="m-p-sub-info">
                      									  <div class="am-modal-dialog">
                      										<div class="am-modal-hd"></div>
                      										<div class="am-modal-bd">
                      											<span class="am-icon-exclamation-circle"></span>
                      										  请确认提交的信息无误
                      										</div>
                      										<div class="am-modal-footer">
                      										<span class="am-modal-btn" data-am-modal-cancel>检查一下</span>
                      										  <span class="am-modal-btn" id="m-p-last-sub">继续提交</span>
                      										</div>
                      									  </div>
                      									</div>
		
									
                            </form>

                    </div>
		<!--------------------------------添加项目-------------------------------------------------------->
					
					
					
					
		<!------------------------------------ 添加模块-->
                        <div class="tpl-form-body tpl-form-line" id="m-m-con" style="display:none;">

                            <form class="am-form tpl-form-line-form" id="m-m-form">
                                <div class="am-form-group">
                                    <label for="user-email" class="am-u-sm-3 am-form-label" > 模块名称：</label>
                                    <div class="am-u-sm-9">
                                        <input type="text" placeholder="" id="m-m-name">
                                        <div class="am-alert am-alert-danger" id="m--module-name-war" style="display: none;">错误：名称中不允许包含 _ 符号！</div>
                                    </div>
                                </div>


                                <div class="am-form-group">
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
																																		 <label for="" class="am-u-sm-3 am-form-label">性别限制：</label>
																																		 <div class="am-u-sm-9">
																																			  <label class="am-radio-inline m-lab">
																																				<input type="radio" name="m-m-sex" value="0" data-am-ucheck> 不限
																																			  </label>
																																			  <label class="am-radio-inline m-lab">
																																				<input type="radio" name="m-m-sex" value="1" data-am-ucheck> 限男
																																			  </label>
																																			  <label class="am-radio-inline m-lab">
																																				<input type="radio" name="m-m-sex" value="2" data-am-ucheck> 限女
																																			  </label>
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


   <!----------------------------------------------添加标签---------------------------------------------------->
                    <div class="tpl-form-body tpl-form-line" id="m-label-con" style="display:none;min-height:500px;">
                         <div style="width:10%;border:0px solid #666;" class="am-form">
                             <div class="am-form-group">
                               
                                 <select  data-am-selected="{btnWidth:200,btnSize: 'sm',btnStyle: 'secondary'}"  id="m-label-type" placeholder="">
                                     <option value="label-ry">人员</option>
                                     <option value="label-sb">设备</option>
                                     <option value="label-yp">用品</option>
                                     <option value="label-bm">部门</option>
                                     <option value="label-zs">诊室</option>
                                     <option value="label-xmlb">项目类别</option>
                                     <option value="label-zybw">作用部位</option>
                                     <option value="label-zygn">作用功能</option>
                                     <option value="label-syz">适应症</option>
                                     <option value="label-jjz">禁忌症</option>
                                </select>
                              </div>

                         </div>
<!--------------------人员------------------>
                         <div style="margin-top:30px;" class="label-con" id="label-ry" >
                               <form class="am-form am-form-inline " role="form" >
                               <div class="am-form-group">
                                  <select data-am-selected="{btnWidth:200,btnSize: 'sm'}" placeholder="所属部门(必选)" id="label-ry-dpm" class="am-input-sm">
                                            <option value=""></option>
                                             <?php $m->get_select("department","name","");?>
                                            </select> 
                               </div>
                               <div class="am-form-group am-form-warning">
                                 <input type="text" class="am-radius am-input-sm" id="label-ry-title" placeholder="人员等级(必填)" >
                               </div>

                               <div class="am-form-group ">
                                  <input type="text" class="am-radius am-input-sm" id="label-ry-name" placeholder="姓名(必填)" >
                               </div>

                               <div class="am-form-group ">
                                  <input type="text" class="am-radius am-input-sm" id="label-ry-wage" placeholder="时薪" >
                               </div>

                               <button type="button" class="am-btn am-btn-success am-radius am-btn-sm" id="label-add-ry">增加</button>
                             </form>
                             <table class="label-del am-table am-table-compact  am-table-radius" style="font-size:14px;margin-top:10px;">
                                 <thead>
                                  <tr>
                                   <th colspan="6" style="display:none;">
                                    <div class="am-alert am-alert-danger"  >错误：有未填写的项目</div>
                                   </th>
                                  </tr>
                                   <tr>
                                     <th>编号</th>
                                     <th>部门</th>
                                     <th>等级</th>
                                     <th>姓名</th>
                                     <th >时薪</th>
                                     <th style="width:5%;">删除</th>
                                   </tr>
                                 </thead>
                                 <tbody>
                                 </tbody>
                             </table>
                         </div>
 <!--------------------人员------------------>                            

<!--------------------设备------------------>
                              <div style="margin-top:30px;display: none;" class="label-con" id="label-sb" >
                               <form class=" am-form am-form-inline" role="form">
                               <div class="am-form-group">
                                  <select data-am-selected="{btnWidth:100,btnSize: 'sm'}" placeholder="所属部门(必选)" class="am-input-sm" id="label-sb-dpm">
                                            <option value=""></option>
                                             <?php $m->get_select("department","name","");?>
                                            </select> 
                               </div>

                               <div class="am-form-group">
                                  <select data-am-selected="{btnWidth:100,btnSize: 'sm'}" placeholder="摆放诊室" class="am-input-sm" id="label-sb-room">
                                            <option value=""></option>
                                            <?php $m->get_select("room","name","");?>
                                            </select> 
                               </div>

                               <div class="am-form-group">
                                 <input type="text" class="am-radius am-input-sm" placeholder="设备编号(必填)" style="width:100px;" id="label-sb-code">
                               </div>

                               <div class="am-form-group">
                                  <input type="text" class="am-radius am-input-sm" placeholder="设备名称(必填)" style="width:100px;" id="label-sb-name">
                               </div>
                               
                               
                                
                                <div class="am-form-group">
                                  <input type="text" class="am-radius am-input-sm" placeholder="品牌" style="width:100px;" id="label-sb-brand">
                               </div>

                               <div class="am-form-group">
                                  <input type="text" class="am-radius am-input-sm" placeholder="产地" style="width:100px;" id="label-sb-region">
                               </div>

                               <div class="am-form-group">
                                  <input type="text" class="am-radius am-input-sm" placeholder="购买价格" style="width:100px;" id="label-sb-price">
                               </div>

                               <div class="am-form-group">
                                  <input type="text" class="am-radius am-input-sm" placeholder="单次成本" style="width:100px;" id="label-sb-cost">
                               </div>


                               <div class="am-form-group">
                                  <input type="text" class="am-radius am-input-sm" placeholder="描述" id="label-sb-describe">
                               </div>

                               <button type="button" class="am-btn am-btn-success am-radius am-btn-sm"  id="label-add-sb">增加</button>
                             </form>
                             <table class="label-del am-table am-table-compact  am-table-radius" style="font-size:14px;margin-top:10px;">
                                 <thead>
                                 <tr>
                                   <th colspan="10" style="display:none;">
                                    <div class="am-alert am-alert-danger" >错误：有未填写的项目</div>
                                   </th>
                                  </tr>
                                   <tr>
                                     <th>设备编号</th>
                                     <th>设备名称</th>
                                     <th>所属部门</th>
                                     <th>摆放科室</th>
                                     <th >品牌</th>
                                     <th >产地</th>
                                     <th >购买价格</th>
                                     <th >单次成本</th>
                                     <th >描述</th>
                                     <th style="width:5%;">删除</th>
                                   </tr>
                                 </thead>
                                 <tbody>
                                 </tbody>
                             </table>
                         </div>
<!--------------------设备------------------>


<!--------------------用品------------------>

                          <div style="margin-top:30px;display: none;" class="label-con" id="label-yp" >
                               <form class=" am-form am-form-inline" role="form">
                               <div class="am-form-group">
                                  <select data-am-selected="{btnWidth:200,btnSize: 'sm'}" placeholder="所属部门(必选)" class="am-input-sm" id="label-yp-dpm">
                                            <option value=""></option>
                                             <?php $m->get_select("department","name","");?>
                                            </select> 
                               </div>
                               <div class="am-form-group">
                                  <input type="text" class="am-radius am-input-sm" placeholder="名称(必填)" style="width:100px;" id="label-yp-name">
                               </div>
                               
                                <div class="am-form-group">
                                  <input type="text" class="am-radius am-input-sm" placeholder="品牌" style="width:100px;" id="label-yp-brand">
                               </div>

                               <div class="am-form-group">
                                  <input type="text" class="am-radius am-input-sm" placeholder="产地" style="width:100px;" id="label-yp-region">
                               </div>

                               <div class="am-form-group">
                                  <input type="text" class="am-radius am-input-sm" placeholder="购买价格" style="width:100px;" id="label-yp-price">
                               </div>

                               <div class="am-form-group">
                                  <input type="text" class="am-radius am-input-sm" placeholder="单次成本" style="width:100px;" id="label-yp-cost">
                               </div>


                               <div class="am-form-group">
                                  <input type="text" class="am-radius am-input-sm" placeholder="描述" id="label-yp-describe">
                               </div>

                               <button type="button" class="am-btn am-btn-success am-radius am-btn-sm" id="label-add-yp">增加</button>
                             </form>
                             <table class="label-del am-table am-table-compact  am-table-radius" style="font-size:14px;margin-top:10px;">
                                 <thead>
                                 <tr>
                                   <th colspan="9" style="display:none;">
                                    <div class="am-alert am-alert-danger" >错误：有未填写的项目</div>
                                   </th>
                                  </tr>

                                   <tr>
                                     <th>设备编号</th>
                                     <th>设备名称</th>
                                     <th>所属部门</th>
                                     <th >品牌</th>
                                     <th >产地</th>
                                     <th >购买价格</th>
                                     <th >单次成本</th>
                                     <th >描述</th>
                                     <th style="width:5%;">删除</th>
                                   </tr>
                                 </thead>
                                 <tbody>
                                 </tbody>
                             </table>
                       </div>
<!--------------------用品------------------>

<!--------------------部门------------------>
                          <div style="margin-top:30px;display: none;" class="label-con" id="label-bm" >
                               <form class=" am-form am-form-inline" role="form">
                               
                               <div class="am-form-group">
                                 <input type="text" class="am-radius am-input-sm" placeholder="部门名称(必填)" id="label-bm-dpm">
                               </div>

                               <div class="am-form-group">
                                 <input type="text" class="am-radius am-input-sm" placeholder="编码（大写首字母）(必填)" id="label-bm-code">
                               </div>

                               <button type="button" class="am-btn am-btn-success am-radius am-btn-sm" id="label-add-bm">增加</button>
                             </form>
                             <table class="label-del am-table am-table-compact  am-table-radius" style="font-size:14px;margin-top:10px;">
                                 <thead>
                                 <tr>
                                   <th colspan="3" style="display:none;">
                                    <div class="am-alert am-alert-danger" >错误：有未填写的项目</div>
                                   </th>
                                  </tr>
                                   <tr>
                                     <th>编号</th>
                                     <th>部门</th>
                                     <th style="width:5%;">删除</th>
                                   </tr>
                                 </thead>
                                 <tbody>
                                 </tbody>
                             </table>
                         </div>
<!--------------------部门------------------>

<!--------------------诊室------------------>
                          <div style="margin-top:30px;display: none;" class="label-con" id="label-zs" >
                               <form class=" am-form am-form-inline" role="form">
                               <div class="am-form-group">
                                  <select data-am-selected="{btnWidth:200,btnSize: 'sm'}" placeholder="所属部门(必选)" class="am-input-sm" id="label-zs-dpm">
                                            <option value=""></option>
                                             <?php $m->get_select("department","name","");?>
                                            </select> 
                               </div>
                               <div class="am-form-group">
                                 <input type="text" class="am-radius am-input-sm" placeholder="诊室名称(必填)" id="label-zs-name">
                               </div>

                               <button type="button" class="am-btn am-btn-success am-radius am-btn-sm" id="label-add-zs">增加</button>
                             </form>
                             <table class="label-del am-table am-table-compact  am-table-radius" style="font-size:14px;margin-top:10px;">
                                 <thead>
                                 <tr>
                                   <th colspan="4" style="display:none;">
                                    <div class="am-alert am-alert-danger" >错误：有未填写的项目</div>
                                   </th>
                                  </tr>
                                   <tr>
                                     <th>编号</th>
                                     <th>部门</th>
                                     <th>诊室名称</th>
                                     <th style="width:5%;">删除</th>
                                   </tr>
                                 </thead>
                                 <tbody>
                                 </tbody>
                             </table>
                         </div>
<!--------------------诊室------------------>

<!--------------------项目类别------------------>
                          <div style="margin-top:30px;display: none;" class="label-con" id="label-xmlb" >
                               <form class=" am-form am-form-inline" role="form">
                               <div class="am-form-group">
                                  <select data-am-selected="{btnWidth:200,btnSize: 'sm'}" placeholder="所属部门(必选)" class="am-input-sm" id="label-xmlb-dpm">
                                            <option value=""></option>
                                             <?php $m->get_select("department","name","");?>
                                            </select> 
                               </div>
                               <div class="am-form-group">
                                 <input type="text" class="am-radius am-input-sm" placeholder="名称(必填)" id="label-xmlb-name">
                               </div>

                               <div class="am-form-group">
                                  <input type="text" class="am-radius am-input-sm" placeholder="代码（大写字母）(必填)" id="label-xmlb-code">
                               </div>

                               <button type="button" class="am-btn am-btn-success am-radius am-btn-sm" id="label-add-xmlb">增加</button>
                             </form>
                             <table class="label-del am-table am-table-compact  am-table-radius" style="font-size:14px;margin-top:10px;">
                                 <thead>
                                 <tr>
                                   <th colspan="4" style="display:none;">
                                    <div class="am-alert am-alert-danger" >错误：有未填写的项目</div>
                                   </th>
                                  </tr>
                                   <tr>
                                     <th>编号</th>
                                     <th>部门</th>
                                     <th>名称</th>
                                     <th style="width:5%;">删除</th>
                                   </tr>
                                 </thead>
                                 <tbody>
                                 </tbody>
                             </table>
                         </div>
<!--------------------项目类别------------------>


<!--------------------作用部位------------------>
                          <div style="margin-top:30px;display: none;" class="label-con" id="label-zybw" >
                               <form class=" am-form am-form-inline" role="form">
                               <div class="am-form-group">
                                 <input type="text" class="am-radius am-input-sm" placeholder="名称(必填)" id="label-zybw-name">
                               </div>
                               <button type="button" class="am-btn am-btn-success am-radius am-btn-sm" id="label-add-zybw">增加</button>
                             </form>
                             <table class="label-del am-table am-table-compact  am-table-radius" style="font-size:14px;margin-top:10px;">
                                 <thead>
                                 <tr>
                                   <th colspan="3" style="display:none;">
                                    <div class="am-alert am-alert-danger" >错误：有未填写的项目</div>
                                   </th>
                                  </tr>
                                   <tr>
                                     <th>序号</th>
                                     <th>名称</th>
                                     <th style="width:5%;">删除</th>
                                   </tr>
                                 </thead>
                                 <tbody>
                                 </tbody>
                             </table>
                         </div>
<!--------------------作用部位------------------>

<!--------------------作用功能------------------>
                          <div style="margin-top:30px;display: none;" class="label-con" id="label-zygn" >
                               <form class=" am-form am-form-inline" role="form">
                               <div class="am-form-group">
                                 <input type="text" class="am-radius am-input-sm" placeholder="名称(必填)" id="label-zygn-name">
                               </div>

                               <button type="button" class="am-btn am-btn-success am-radius am-btn-sm" id="label-add-zygn">增加</button>
                             </form>
                             <table class="label-del am-table am-table-compact  am-table-radius" style="font-size:14px;margin-top:10px;">
                                 <thead>
                                 <tr>
                                   <th colspan="3" style="display:none;">
                                    <div class="am-alert am-alert-danger" >错误：有未填写的项目</div>
                                   </th>
                                  </tr>
                                   <tr>
                                     <th>序号</th>
                                     <th>名称</th>
                                     <th style="width:5%;">删除</th>
                                   </tr>
                                 </thead>
                                 <tbody>
                                 </tbody>
                             </table>
                         </div>
<!--------------------作用功能------------------>

<!--------------------适应症------------------>
                          <div style="margin-top:30px;display: none;" class="label-con" id="label-syz" >
                               <form class=" am-form am-form-inline" role="form">
                               <div class="am-form-group">
                                 <input type="text" class="am-radius am-input-sm" placeholder="名称(必填)" id="label-syz-name">
                               </div>
                               <button type="button" class="am-btn am-btn-success am-radius am-btn-sm" id="label-add-syz">增加</button>
                             </form>
                             <table class="label-del am-table am-table-compact  am-table-radius" style="font-size:14px;margin-top:10px;">
                                 <thead>
                                 <tr>
                                   <th colspan="3" style="display:none;">
                                    <div class="am-alert am-alert-danger" >错误：有未填写的项目</div>
                                   </th>
                                  </tr>
                                   <tr>
                                     <th>序号</th>
                                     <th>名称</th>
                                     <th style="width:5%;">删除</th>
                                   </tr>
                                 </thead>
                                 <tbody>
                                 </tbody>
                             </table>
                         </div>
<!--------------------适应症------------------>

<!--------------------禁忌症------------------>
                          <div style="margin-top:30px;display: none;" class="label-con" id="label-jjz" >
                               <form class=" am-form am-form-inline" role="form">
                               <div class="am-form-group">
                                 <input type="text" class="am-radius am-input-sm" placeholder="名称(必填)" id="label-jjz-name">
                               </div>

                               <button type="button" class="am-btn am-btn-success am-radius am-btn-sm" id="label-add-jjz">增加</button>
                             </form>
                             <table class="label-del am-table am-table-compact  am-table-radius" style="font-size:14px;margin-top:10px;">
                                 <thead>
                                 <tr>
                                   <th colspan="3" style="display:none;">
                                    <div class="am-alert am-alert-danger" >错误：有未填写的项目</div>
                                   </th>
                                  </tr>
                                   <tr>
                                     <th>序号</th>
                                     <th>名称</th>
                                     <th style="width:5%;">删除</th>
                                   </tr>
                                 </thead>
                                 <tbody>
                                 </tbody>
                             </table>
                         </div>
<!--------------------禁忌症------------------>
                    </div>

                    <div class="am-modal am-modal-alert" tabindex="-1" id="label-sub-info">
                                 <div class="am-modal-dialog">
                                <div class="am-modal-hd"></div>
                                <div class="am-modal-bd">
                                 <span class="am-icon-exclamation-circle"></span>
                                  确认要删除此条数据吗？
                                </div>
                                <div class="am-modal-footer">
                                <span class="am-modal-btn" data-am-modal-cancel>取消删除</span>
                                  <span class="am-modal-btn" id="label-del">确认删除</span>
                                </div>
                                 </div>
                               </div>
                    <!----------------------------------------------------------------------添加标签END-------------------------------------------------------------------->
                </div>
				
                

            </div>


        </div>

        </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/amazeui.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.10.4.min.js"></script>
    <script type="text/javascript" src="js/jquery.mousewheel.min.js"></script>
    <script type="text/javascript" src="js/jquery.mCustomScrollbar.min.js"></script>
     <script src="js/main.js"></script>
	 <script type="text/javascript">
    $(function(){
                   $("#m-jump-con").mCustomScrollbar({  
                        theme:"minimal-dark", //主题颜色  
                        scrollButtons:{  
                            enable:true //是否使用上下滚动按钮  
                        },  
                        autoHideScrollbar: true, //是否自动隐藏滚动条  
                        scrollInertia :0,//滚动延迟  
                        horizontalScroll : false,//水平滚动条  
                        // callbacks:{  
                        //     onScroll: function(){alert(1)} //滚动完成后触发事件  
                        // }  
                        advanced:{ 
                        	updateOnBrowserResize: true
                        }
                    });
    });
    </script>

</body>

</html>