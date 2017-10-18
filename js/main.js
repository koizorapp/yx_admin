$(function() {
    // 定义全局变量
    const win = {
        module_list_arr: [],
    };
    $("#loading").fadeOut(1500);
    var progress = $.AMUI.progress;
    function is_num(inputId, warId) { //判断是否为数字的函数
        $(inputId).change(function() {
            if (isNaN($(this).val())) {
                $(this).val("");
                $(warId).fadeIn();
            } else {
                $(warId).fadeOut();
            }
        })
    }

      function get_labe_table(id){    //通过传入的id获取对应的数据库内容（添加标签使用）
        $.ajax({
            url: 'ajax.php',
            data: {
                label_type: id
            },
            type: 'post',
            dataType: 'text',
            async: true,
            success: function(msg) {
                if (msg != "") {
                    $("#"+id).find('table tbody').html(msg);
                }

            }

        });
    }
    /////////////////////////////////////登陆/退出//////////////////////////
    $('input[type="email"], input[type="password"]').on('keyup', function(e) {
        e.preventDefault();
        if (e.keyCode == 13) {
            if (!!$('input[type="email"]').val() && !!$('input[type="password"]').val()) {
                $('#login').trigger('click');
            }
        }
    });
    $('#login').click(function(){	//登陆
    	$('#login_war').fadeOut();
    	var user=$('#user').val();
    	var pwd=$('#pwd').val();
    	if(user!="" && pwd!=""){
    		progress.start();
    		$.ajax({
            url: 'ajax.php',
            data: {
                user:user,
                pwd:pwd,
                type: 'login'
            },
            type: 'post',
            dataType: 'text',
            async: true,
            success: function(msg) {
                if (msg != "") {
                    progress.done();
                    window.location.href = 'project_list.php?d=YXYDZX';
                    
                }else{
                	progress.done();
                	$('#login_war').text('错误：用户名密码错误！')
    				$('#login_war').fadeIn();
                }

            }

        });
    	}else{
    		$('#login_war').text('错误：用户名密码不能为空！')
    		$('#login_war').fadeIn();
    	}
    })

    $('.logout').click(function(){  //退出
    	progress.start();
    	$.ajax({
            url: 'ajax.php',
            data: {
                type: 'sign_out'
            },
            type: 'post',
            dataType: 'text',
            async: true,
            success: function(msg) {
                if (msg != "") {
                    progress.done();
                    window.location.href = 'login.html';
                    
                }

            }

        });
    })

    //////////////////////////////////项目及模块详情页中删除功能////////////
    $('#module-del-sub').click(function() { //删除模块
        progress.start();
        var del_id = $('#module-del-sub').attr('del');
        var dpm = $('#module-del-sub').attr('dpm');
        $.ajax({
            url: 'ajax.php',
            data: {
                del_id: del_id,
                type: 'del_module'
            },
            type: 'post',
            dataType: 'text',
            async: true,
            success: function(msg) {
                if (msg != "") {
                    progress.done();
                    window.location.href = 'module_list.php?d=' + dpm;
                    //alert(msg);
                }

            }

        });
        //alert(1);
    })

    $('#project-del-sub').click(function() { //删除项目
        progress.start();
        var del_id = $('#project-del-sub').attr('del');
        var dpm = $('#project-del-sub').attr('dpm');
        $.ajax({
            url: 'ajax.php',
            data: {
                del_id: del_id,
                type: 'del_project'
            },
            type: 'post',
            dataType: 'text',
            async: true,
            success: function(msg) {
                if (msg != "") {
                    progress.done();
                    window.location.href = 'project_list.php?d=' + dpm;
                }

            }

        });
    })

    ///////////////////////////////////////////////////////////////////////
    /////////////////////////keyword页面查询//////////////////////////
    $("#s-sub").click(function() {

        var s_title = $("#s-key-title").val();
        var s_con = $("#s-key-con").val();
        if (s_title == "" || s_con == "") {
            $(".am-alert").fadeIn();
        } else {
            $(".am-alert").fadeOut();
            progress.start();
            $.ajax({
                url: 'ajax.php',
                data: {
                    s_title: s_title,
                    s_con: s_con,
                    type: 'keyword'
                },
                type: 'post',
                dataType: 'text',
                async: true,
                success: function(msg) {
                    if (msg != "") {
                        $(".key-con").html(msg);
                        $(".key-con").show();
                        progress.done();
                    }

                }

            });
        }
    })
    ////////////////////////////////////////////////////////////////////////

    /////////////////////管理中心页面//////////////////////////////////////
    $("#add-module").click(function() { //点击左侧导航条添加模块按钮
    	$('#p-wrning').alert('close');
    	$('#m-wrning').alert('close');
        var animation = 'am-animation-slide-right';
        progress.start();
        $('#m-p-con').hide();
        $('#m-label-con').hide();
        $('#m-title-text').text(' 添加模块');
        $("#m-m-con").show();
        $("#m-m-con").addClass(animation).one($.AMUI.support.animation.end,
        function() {
            $("#m-m-con").removeClass(animation);
        });
        progress.done();

    })

    // $('#switch_navigation').click(function(){	
    	
    // 	if($('#navigation').css('display')=='block'){
    // 		var animation = 'am-animation-slide-left am-animation-reverse';
    // 		$('#navigation').fadeOut();
    // 		$('.tpl-content-wrapper').toggleClass('tpl-content-wrapper-hover am-animation-slide-right');
    // 		$('#navigation').css('display','none');
    // 		$("#navigation").addClass(animation).one($.AMUI.support.animation.end,
	   //      function() {
	   //          $("#m-m-con").removeClass(animation);
	   //      });
    // 	}else{
    // 		var animation = 'am-animation-slide-left';
    // 		$('#navigation').fadeIn();
    // 		$('.tpl-content-wrapper').removeClass('tpl-content-wrapper-hover');
    // 		$('.tpl-content-wrapper').toggleClass('am-animation-slide-right am-animation-reverse');
    // 		$('#navigation').css('display','block');
    // 		$("#navigation").addClass(animation).one($.AMUI.support.animation.end,
	   //      function() {
	   //          $("#m-m-con").removeClass(animation);
	   //      });
    // 	}
    // })

    $("#add-project").click(function() { //点击左侧导航添加项目按钮
    	$('#p-wrning').alert('close');
    	$('#m-wrning').alert('close');
        var animation = 'am-animation-slide-right';
        progress.start();
        $('#m-m-con').hide();
        $('#m-label-con').hide();
        $('#m-title-text').text(' 添加项目');
        $("#m-p-con").show();
        $("#m-p-con").addClass(animation).one($.AMUI.support.animation.end,
        function() {
            $("#m-p-con").removeClass(animation);
        });
        progress.done();

    })

    $("#add-label").click(function() { //点击左侧导航添加项目按钮
        $('#p-wrning').alert('close');
        $('#m-wrning').alert('close');
        var animation = 'am-animation-slide-right';
        progress.start();
        $('#m-m-con').hide();
        $('#m-p-con').hide();
        $('#m-title-text').text(' 添加标签');
        get_labe_table('label-ry');
        $("#m-label-con").show();
        $("#m-label-con").addClass(animation).one($.AMUI.support.animation.end,
        function() {
            $("#m-label-con").removeClass(animation);
        });
        progress.done();

    })



    $("#m-m-age-n").click(function() { //当点击年龄无限制时，禁止年龄起始段的输入
        if ($('#m-m-age-n').is(':checked')) {
            $("#m-m-age-b").attr("disabled", true);
            $("#m-m-age-e").attr("disabled", true);
        } else {
            $("#m-m-age-b").removeAttr("disabled");
            $("#m-m-age-e").removeAttr("disabled");
            $("#m-m-age-b").val("");
            $("#m-m-age-e").val("");
        }
    })

    $('#m-m-name').change(function() { //////当输入模块名称之后的验证
        var name = $('#m-m-name').val();
        if (name != "") {
            if (name.indexOf("_") > 0) {
                $('#m-m-module-name-war').fadeIn();
                $('#m-m-name').val("");
            } else {
                $('#m-m-module-name-war').fadeOut();
            }
        }
    })

    // $('#m-m-age-b,#m-m-age-e').change(function(){	//判断输入的年龄是否为数字
    // 	if(isNaN($(this).val())){
    // 		$(this).val("");
    // 		$('#m-m-module-age-war').fadeIn();
    // 	}else{
    // 		$('#m-m-module-age-war').fadeOut();
    // 	}
    // })

    is_num("#m-m-age-b,#m-m-age-e", "#m-m-module-age-war"); //判断输入的年龄是否为数字
    is_num("#m-m-time", "#m-m-module-time-war"); //判断输入的时间是否为数字

    $('#m-m-sub').click(function() { //当点击提交按钮时的检查及数据提交
        var name = $('#m-m-name').val();
        var dpm = $('#m-m-dpm').val();
        var room = $('#m-m-room').val();
        var exp = $('#m-m-exp').val();
        var device = $('#m-m-device').val();
        var apl = $('#m-m-apl').val();
        var site = $('#m-m-site').val();
        var fun = $('#m-m-function').val();
        var idc = $('#m-m-idc').val();
        var ctd = $('#m-m-ctd').val();
        var sex = $('input:radio[name="m-m-sex"]:checked').val();
        var age_n = $('#m-m-age-n').is(':checked');
        //alert(age_n);
        var age_b = $('#m-m-age-b').val();
        var age_e = $('#m-m-age-e').val();
        var time = $('#m-m-time').val();

        // if (name != "" && dpm != "" && room != "" && exp != "" && device != "" && apl != "" && site != "" && fun != "" && idc != "" && ctd != "" && sex != null && (age_n != false || (age_e != "" && age_b != "")) && time != "") {
        if (true) {
            if ($('#m-wrning').length > 0) {
                $('#m-wrning').remove();
            }

            $('#m-m-sub-info').modal('open');
            $("#m-m-last-sub").unbind("click");
            $("#m-m-last-sub").click(function() {
                if ($('#m-m-age-n').is(':checked')) {
                    var age_val = 1;
                } else {
                    var age_val = 0;
                }
                if ($("#m-m-is-yl").is(':checked')) {
                    var is_yl = 1;
                } else {
                    var is_yl = 0;
                }
                progress.start();
                $.ajax({
                    url: 'ajax.php',
                    data: {
                        name: name,
                        dpm: dpm,
                        room: room,
                        exp: exp,
                        device: device,
                        apl: apl,
                        site: site,
                        fun: fun,
                        idc: idc,
                        ctd: ctd,
                        sex: sex,
                        age_val: age_val,
                        age_b: age_b,
                        age_e: age_e,
                        time: time,
                        is_yl: is_yl,
                        type: 'sub_module'
                    },
                    type: 'post',
                    dataType: 'text',
                    async: true,
                    success: function(msg) {
                        if (msg != "") {
                            progress.done();
                            window.location.href = 'module_list.php?d=' + msg;
                            //alert(msg);
                        }

                    }

                });
            })

        } else {
            if ($('#m-wrning').length > 0) {

} else {
                $('.am-g').after("<div class=\"am-alert am-alert-danger\" style=\"position: fixed; width: 70%; top: 60px; z-index: 1;\" data-am-alert id=\"m-wrning\"><button type=\"button\" class=\"am-close\">&times;</button><p>错误：有未填写的项目，请检查无误后再提交！</p></div>");

            }
            //alert(0);
        }
    })

    ////////////////////////////////////管理中心添加项目//////////////////////////////////


    $('#m-p-add-module').click(function() { //当展开选取模块的表格时获取表格内容
        $.ajax({
            url: 'ajax.php',
            data: {
                type: 'get_add_module_con'
            },
            type: 'post',
            dataType: 'text',
            async: true,
            success: function(msg) {
                if (msg != "") {
                    $('#m-p-module-con').html(msg);
                    $('.m-p-checkbox').uCheck();
                    $('#doc-modal-1').modal({
                        width:1200,
                        closeViaDimmer:0
                    });
                }

            }

        });
    })

    $('#m-p-module-con').on('click', 'input[type=checkbox]',
    function() { //当在模块选择列表中选择模块获取数量及名称
        var name_list = '';
        var len = $('#m-p-module-con').find("input[type=checkbox]:checked").length;
        $.each($('.am-table-compact tbody tr'), function(index, val) {
            var is_checked = $(val).find('input[type=checkbox]').prop('checked');
            if (is_checked == undefined) {
                return;
            }
            if (is_checked) {
                name_list += $(val).find('input[type=checkbox]').val() + ',';
            }
        });
        $('#m-p-module-val').val(name_list.substr(0, name_list.length - 1));
        $('#m-p-c-moduleNum').text(len);

    })

    $('#m-p-field-s').change(function() { //当在模块选择列表中选择字段筛选条件时，选为不选择禁用输入框
        var field = $('#m-p-field-s').val();
        if (field != 'no') {
            $('#m-p-field-con').removeAttr("disabled");
        } else {
            $('#m-p-field-con').attr('disabled', true);
            $('#m-p-field-con').val("");
        }
    })

    $('#m-add-mod-s').click(function() { //在模块选择列表中通过条件筛选展现内容
        $('#m-p-filedCon-war').fadeOut();
        var dpm = $('#m-p-m-dpm').val();
        var field = $('#m-p-field-s').val();
        var field_con = $('#m-p-field-con').val();

        if (field != 'no' && field_con == "") {
            $('#m-p-filedCon-war').fadeIn();
            $('#m-p-filedCon-war').find('p').text('注意：当选择搜索条件时，搜索的关键字不能为空');
        } else {
            $('#m-p-filedCon-war').fadeOut();
            progress.start();

            $.ajax({
                url: 'ajax.php',
                data: {
                    dpm: dpm,
                    field: field,
                    field_con: field_con,
                    type: 'get_ck_module_con'
                },
                type: 'post',
                dataType: 'text',
                async: true,
                success: function(msg) {
                    if (msg != "") {
                        progress.done();
                        $('#m-p-module-con').html(msg);
                        $('.m-p-checkbox').uCheck();
                        //alert(msg);
                    } else {
                        progress.done();
                        $('#m-p-filedCon-war').fadeIn();
                        $('#m-p-filedCon-war').find('p').text('搜索结果为空，请更换筛选条件！');
                        $('#m-p-module-con').html('');
                    }

                }

            });
        }
    })

    $('#m-p-module-add').unbind('click').click(function() { //项目添加中选择模块完成后点击添加按钮的操作
        var m_val = $('#m-p-module-val').val();
        // 清空list
        $('.am-table-sort-list').html('');
        if (m_val != "") {
            $.ajax({
                url: 'ajax.php',
                data: {
                    m_val: m_val,
                    type: 'display_add_module'
                },
                type: 'post',
                dataType: 'text',
                async: true,
                success: function(msg) {
                    if (msg != "") {
                        $('#m-p-moule-list').find('select').html(msg);
                        $('#m-p-moule-list').fadeIn();
                        $('#m-p-del-module').fadeIn();
                        $('#m-p-final-module').val($('#m-p-module-val').val());
                        $('#m-p-module-val').val('');
                    }
                }

            });
        }
        $('#doc-modal-1').modal('close');
        $('#m-jump-con').find('select').selected('destroy');
        $('#m-p-m-dpm').val('all');
        $('#m-p-field-s').val('no');
        $('#m-p-field-con').val('');
        $('#m-p-c-moduleNum').text(0);
        $('#m-jump-con').find('select').selected('enable');

    })

    $('#m-p-del-module').click(function() { //删除已经选择的模块
        $('#m-p-moule-list').find('select').html('');
        $('#m-p-module-val').val('');
        $('#m-p-final-module').val('');
        $('#m-p-moule-list').fadeOut();
        $('#m-p-del-module').fadeOut();

    })

    $('#m-p-dpm').change(function() { //添加项目中选择部门获取类别
        var dpm = $(this).val();
        $.ajax({
            url: 'ajax.php',
            data: {
                dpm: dpm,
                type: 'get_project_type'
            },
            type: 'post',
            dataType: 'text',
            async: true,
            success: function(msg) {
                if (msg != "") {
                    $('#m-p-type').html(msg);
                }

            }

        });
    })

    is_num('#m-p-mk_p', '#m-p-mk_p-war'); //判断市场价格是否为数字
    is_num('#m-p-mb_p', '#m-p-mb_p-war'); //判断会员价格是否为数字
    is_num('#m-p-time', '#m-p-time-war'); //判断时间是否为数字

    $('#m-p-name').change(function() { //判断输入的项目名称是否重复
        var project_name = $('#m-p-name').val();
        if (project_name != "") {
        	progress.start();
            $('#m-p-ck_name-ico').show();
            $.ajax({
                url: 'ajax.php',
                data: {
                    project_name: project_name,
                    type: 'judge_projectName'
                },
                type: 'post',
                dataType: 'text',
                async: true,
                success: function(msg) {
                    if (msg == 1) {
                        $('#m-p-name').val('');
                        $('#m-p-name-war').text('错误：输入的项目名称已经存在,请更换名称');
                        $('#m-p-name-war').fadeIn();

                    }else{
                    	$('#m-p-name-war').fadeOut();
                    }
                    	progress.done();
                    	$('#m-p-ck_name-ico').hide();
                    
                }

            });
        }
    })

    $('#m-p-time').change(function(){
    	var time=$('#m-p-time').val();
    	var module=$('#m-p-final-module').val();
    	progress.start();
    	if(module=="" && time!=""){
    		$('#m-p-time').val('');
    		$('#m-p-time-war2').text('请先选择模块后再输入项目时间');
    		$('#m-p-time-war2').fadeIn();
    	}else{
    		$('#m-p-time-war2').fadeOut();
	    	if(time!=""){
	    		$.ajax({
	            url: 'ajax.php',
	            data: {
	                time: time,
	                module:module,
	                type: 'judge_projectTime'
	            },
	            type: 'post',
	            dataType: 'text',
	            async: true,
	            success: function(msg) {
	                if (msg != "ok") {
	                	//alert(msg);
	                	$('#m-p-time').val('');
	                	$('#m-p-time-war2').text('输入的项目时间少于所选的模块总时间，模块总时间为'+msg);
    					$('#m-p-time-war2').fadeIn();
	                }else{
	                	$('#m-p-time-war2').fadeOut();
	                }

	            }

	        });
	    	}
	    }
	    progress.done();
    })

    $('#m-p-sub').click(function(){	//项目提交
    	var name=$('#m-p-name').val();
    	var dpm=$('#m-p-dpm').val();	
    	var p_type=$('#m-p-type').val();
    	var mp_p=$('#m-p-mk_p').val();
    	var mb_p=$('#m-p-mb_p').val();
    	var module=$('#m-p-final-module').val();
    	var describe=$('#m-p-describe').val(); //描述
    	var time=$('#m-p-time').val();

    	// if(name!="" && dpm!="" && p_type!="" && module!="" && time!=""){
        if (true) {
    		 if ($('#p-wrning').length > 0) {
                $('#p-wrning').remove();
	            }
	            $('#m-p-sub-info').modal('open');
	            $("#m-p-last-sub").unbind("click");
	            $("#m-p-last-sub").click(function(){
		            progress.start();
                    // console.log(win.module_list_arr);
                    // return;
		            $.ajax({
			            url: 'ajax.php',
			            data: {
                            name:name,
			                names:win.module_list_arr,
			                dpm:dpm,
			                p_type:p_type,
			                mp_p:mp_p,
			                mb_p:mb_p,
			                module:module,
			                describe:describe,
			                time:time,
			                type: 'sub_project'
			            },
			            type: 'post',
			            dataType: 'text',
			            async: true,
			            success: function(msg) {
			                if (msg != "") {
			                	//alert(msg); 
			                	progress.done();
			                	window.location.href = 'project_list.php?d='+msg;
			                    
			                }
			             
                            win.module_list_arr = [];  

			            }

			        });
		        })
    	}else{
    		if ($('#p-wrning').length > 0) {

			} else {
                $('.am-g').after("<div class=\"am-alert am-alert-danger\" style=\"position: fixed; width: 70%; top: 60px; z-index: 1;\" data-am-alert id=\"p-wrning\"><button type=\"button\" class=\"am-close\">&times;</button><p>错误：有未填写的项目，请检查无误后再提交！</p></div>");

            }
    	}
    })

////////////////////////////////添加标签

  

     $('#m-label-type').change(function(){ //切换标签时获取对应标签名的数据及展现对应的内容
            progress.start();
            var type=$('#m-label-type').val();
            $('.label-con').hide();
            $("#"+type).show();
            get_labe_table(type);
            progress.done();

    })

  

  $('#label-add-ry').click(function(){  //  增加标签---人员
        var dpm=$('#label-ry-dpm').val();
        var title=$('#label-ry-title').val();
        var name=$('#label-ry-name').val();
        var wage=$('#label-ry-wage').val();
        if(title!="" && dpm!="" && name!=""){
            $('#label-ry').find('.am-alert-danger').parent('th').fadeOut();
                        $.ajax({
                    url: 'ajax.php',
                    data: {
                            type: 'add_label_ry',
                            dpm:dpm,
                            title:title,
                            name:name,
                            wage:wage
                    },
                    type: 'post',
                    dataType: 'text',
                    async: true,
                    success: function(msg) {
                        if (msg == "ok") {
                            //alert(msg);
                            alert('提交成功');
                            get_labe_table('label-ry');
                        }else{
                            alert('提交失败');
                        }

                    }

                });
        }else{
            $('#label-ry').find('.am-alert-danger').parent('th').fadeIn();
        }
  })

    $('#label-add-sb').click(function(){  //  增加标签---设备
            var dpm=$('#label-sb-dpm').val();
            var room=$('#label-sb-room').val();
            var code=$('#label-sb-code').val();
            var name=$('#label-sb-name').val();
            var brand=$('#label-sb-brand').val();
            var region=$('#label-sb-region').val();
            var price=$('#label-sb-price').val();
            var cost=$('#label-sb-cost').val();
            var describe=$('#label-sb-describe').val();
            if(code!="" && dpm!="" && name!=""){
                $('#label-sb').find('.am-alert-danger').parent('th').fadeOut();
                            $.ajax({
                        url: 'ajax.php',
                        data: {
                                type: 'add_label_sb',
                                room:room,
                                dpm:dpm,
                                name:name,
                                code:code,
                                brand:brand,
                                region:region,
                                price:price,
                                cost:cost,
                                describe:describe
                        },
                        type: 'post',
                        dataType: 'text',
                        async: true,
                        success: function(msg) {
                            if (msg == "ok") {
                                //alert(msg);
                                alert('提交成功');
                                get_labe_table('label-sb');
                            }else{
                                alert('提交失败');
                            }

                        }

                    });
            }else{
                $('#label-sb').find('.am-alert-danger').parent('th').fadeIn();
            }
      })




    $('#label-add-yp').click(function(){  //  增加标签---用品
            var dpm=$('#label-yp-dpm').val();
            var name=$('#label-yp-name').val();
            var brand=$('#label-yp-brand').val();
            var region=$('#label-yp-region').val();
            var price=$('#label-yp-price').val();
            var cost=$('#label-yp-cost').val();
            var describe=$('#label-yp-describe').val();
            if( dpm!="" && name!=""){
                $('#label-yp').find('.am-alert-danger').parent('th').fadeOut();
                            $.ajax({
                        url: 'ajax.php',
                        data: {
                                type: 'add_label_yp',
                                dpm:dpm,
                                name:name,
                                brand:brand,
                                region:region,
                                price:price,
                                cost:cost,
                                describe:describe
                        },
                        type: 'post',
                        dataType: 'text',
                        async: true,
                        success: function(msg) {
                            if (msg == "ok") {
                                //alert(msg);
                                alert('提交成功');
                                get_labe_table('label-yp');
                            }else{
                                alert('提交失败');
                            }

                        }

                    });
            }else{
                $('#label-yp').find('.am-alert-danger').parent('th').fadeIn();
            }
      })


    $('#label-add-bm').click(function(){  //  增加标签---部门
        var dpm=$('#label-bm-dpm').val();
        var code=$('#label-bm-code').val();
        if(dpm!="" && code!=""){
            $('#label-bm').find('.am-alert-danger').parent('th').fadeOut();
                        $.ajax({
                    url: 'ajax.php',
                    data: {
                            type: 'add_label_bm',
                            dpm:dpm,
                            code:code
                    },
                    type: 'post',
                    dataType: 'text',
                    async: true,
                    success: function(msg) {
                        if (msg == "ok") {
                            //alert(msg);
                            alert('提交成功');
                            get_labe_table('label-bm');
                        }else{
                            alert('提交失败');
                        }

                    }

                });
        }else{
            $('#label-bm').find('.am-alert-danger').parent('th').fadeIn();
        }
  })


    $('#label-add-zs').click(function(){  //  增加标签---部门
        var dpm=$('#label-zs-dpm').val();
        var name=$('#label-zs-name').val();
        if(dpm!="" && name!=""){
            $('#label-zs').find('.am-alert-danger').parent('th').fadeOut();
                        $.ajax({
                    url: 'ajax.php',
                    data: {
                            type: 'add_label_zs',
                            dpm:dpm,
                            name:name
                    },
                    type: 'post',
                    dataType: 'text',
                    async: true,
                    success: function(msg) {
                        if (msg == "ok") {
                            alert('提交成功');
                            get_labe_table('label-zs');
                        }else{
                            alert('提交失败');
                        }

                    }

                });
        }else{
            $('#label-zs').find('.am-alert-danger').parent('th').fadeIn();
        }
  })

    $('#label-add-xmlb').click(function(){  //  增加标签---项目类别
        var dpm=$('#label-xmlb-dpm').val();
        var name=$('#label-xmlb-name').val();
        var code=$('#label-xmlb-code').val();
        if(dpm!="" && name!="" && code!=""){
            $('#label-xmlb').find('.am-alert-danger').parent('th').fadeOut();
                        $.ajax({
                    url: 'ajax.php',
                    data: {
                            type: 'add_label_xmlb',
                            dpm:dpm,
                            name:name,
                            code:code
                    },
                    type: 'post',
                    dataType: 'text',
                    async: true,
                    success: function(msg) {
                        if (msg == "ok") {
                            alert('提交成功');
                            get_labe_table('label-xmlb');
                        }else{
                            alert('提交失败');
                        }

                    }

                });
        }else{
            $('#label-xmlb').find('.am-alert-danger').parent('th').fadeIn();
        }
  })


    $('#label-add-zybw').click(function(){  //  增加标签---作用部位
        var name=$('#label-zybw-name').val();
        if(name!="" ){
            $('#label-zybw').find('.am-alert-danger').parent('th').fadeOut();
                        $.ajax({
                    url: 'ajax.php',
                    data: {
                            type: 'add_label_zybw',
                            name:name
                    },
                    type: 'post',
                    dataType: 'text',
                    async: true,
                    success: function(msg) {
                        if (msg == "ok") {
                            alert('提交成功');
                            get_labe_table('label-zybw');
                        }else{
                            alert('提交失败');
                        }

                    }

                });
        }else{
            $('#label-zybw').find('.am-alert-danger').parent('th').fadeIn();
        }
  })


    $('#label-add-zygn').click(function(){  //  增加标签---作用功能
        var name=$('#label-zygn-name').val();
        if(name!="" ){
            $('#label-zygn').find('.am-alert-danger').parent('th').fadeOut();
                        $.ajax({
                    url: 'ajax.php',
                    data: {
                            type: 'add_label_zygn',
                            name:name
                    },
                    type: 'post',
                    dataType: 'text',
                    async: true,
                    success: function(msg) {
                        if (msg == "ok") {
                            alert('提交成功');
                            get_labe_table('label-zygn');
                        }else{
                            alert('提交失败');
                        }

                    }

                });
        }else{
            $('#label-zygn').find('.am-alert-danger').parent('th').fadeIn();
        }
  })


     $('#label-add-syz').click(function(){  //  增加标签---适应症
        var name=$('#label-syz-name').val();
        if(name!="" ){
            $('#label-syz').find('.am-alert-danger').parent('th').fadeOut();
                        $.ajax({
                    url: 'ajax.php',
                    data: {
                            type: 'add_label_syz',
                            name:name
                    },
                    type: 'post',
                    dataType: 'text',
                    async: true,
                    success: function(msg) {
                        if (msg == "ok") {
                            alert('提交成功');
                            get_labe_table('label-syz');
                        }else{
                            alert('提交失败');
                        }

                    }

                });
        }else{
            $('#label-syz').find('.am-alert-danger').parent('th').fadeIn();
        }
  })


      $('#label-add-jjz').click(function(){  //  增加标签---禁忌症
        var name=$('#label-jjz-name').val();
        if(name!="" ){
            $('#label-jjz').find('.am-alert-danger').parent('th').fadeOut();
                        $.ajax({
                    url: 'ajax.php',
                    data: {
                            type: 'add_label_jjz',
                            name:name
                    },
                    type: 'post',
                    dataType: 'text',
                    async: true,
                    success: function(msg) {
                        if (msg == "ok") {
                            alert('提交成功');
                            get_labe_table('label-jjz');
                        }else{
                            alert('提交失败');
                        }

                    }

                });
        }else{
            $('#label-jjz').find('.am-alert-danger').parent('th').fadeIn();
        }
  })


      $('.label-del').unbind("click").on("click","button",function(){   //删除标签
             var id=$(this).attr('tableid');
             var table=$(this).attr('tablename');
             var con=$(this).attr('tablecon');
             $('#label-sub-info').modal('open');
             $('#label-del').unbind("click").click(function(){
                    $.ajax({
                    url: 'ajax.php',
                    data: {
                            type: 'label_del',
                            id:id,
                            table:table
                    },
                    type: 'post',
                    dataType: 'text',
                    async: true,
                    success: function(msg) {
                        if (msg == "ok") {
                            get_labe_table(con);
                        }else{
                            alert(msg);
                        }

                    }

                });
             })
      })
            
////////////////////////// 并行模块 start //////////////////////////
$('body').on('click', '.am-table-sort-list ul li span', function(e) {
    e.preventDefault();
    if ($(e.target).parents('li').prev('li').length) {
        return false;
    }
    $(e.target).parents('li').addClass('active').siblings('li').removeClass('active').end().parents('ul').siblings().find('li').removeClass('active');
});
// 删除
$('body').on('click', '.remove-list-item', function(e) {
    e.preventDefault();
    var arr = [];
    $(e.target).parents('ul').nextAll().remove();
    if ($(e.target).parents('ul').children().length == 1) {
        $(e.target).parents('ul').remove();
    } else {
        $(e.target).parents('li').remove();
    }
    $.each($('.am-table-sort-list ul'), function(index, val) {
         $.each($(val).find('li'), function(i, v) {
             var id = $(v).data('id');
             arr.push(id);
         });
    });
    $.each($('.am-table-compact tbody tr'), function(index, val) {
        if ($(val).find('input[type="checkbox"]').data('id') == undefined) {
            return;
        }
        var item_id = $(val).find('input[type="checkbox"]').data('id');
        if ($.inArray(item_id, arr) < 0 && $(val).find('input[type="checkbox"]').prop('checked')) {
            // $(val).find('input[type="checkbox"]').prop('checked', false);
            $(val).find('input[type="checkbox"]').trigger('click');
        }
    });
    reSortArr();
});
// 选中item
$('body').on('click', '.am-checkbox', function(e) {
    var is_checked = $(e.target).prop('checked'),
        is_active = $('.am-table-sort-list ul li').hasClass('active'),
        ul_index,
        li_index;
    var name = e.target.value;
    var id = $(e.target).data('id');
    if (is_checked == undefined || is_active == undefined) {
        return;
    }
    if (is_checked && !is_active) {
        ul_index = $('.am-table-sort-list ul').length + 1;
        var ul_item = '<ul>' +
                        '<li data-id="'+id+'">' +
                        '<span>' + '<font>'+ul_index+'</font>' + ',' +
                            '<font>'+name+'</font>' +
                        '</span>' +
                        '<a href="javascript: void(0)" class="am-close am-close-spin remove-list-item">&times;</a>' +
                    '</li>' +
                    '</ul>';
        $('.am-table-sort-list').append(ul_item);
    }
    if (is_checked && is_active) {
        li_index = $('.am-table-sort-list .active').children('li').length + 1;
        var li_item =  '<li data-id="'+id+'">' +
                    '<span>' + '<font>'+li_index+'</font>' +',' +
                        '<font>'+name+'</font>' +
                    '</span>' +
                    '<a href="javascript: void(0)" class="am-close am-close-spin remove-list-item">&times;</a>' +
                '</li>';
        $('.am-table-sort-list ul .active').parents('ul').append(li_item);
    }
    if (!is_checked) {
        $.each($('.am-table-sort-list ul'), function(index, val) {
            $.each($(val).find('li'), function(i, v) {
                if ($(v).data('id') == id) {
                    if ($(val).children('li').length == 1) {
                        $(val).remove();
                    } else {
                        $(v).remove();
                    }
                }
            });
        });
    }
    // console.log(e.target.value, $(e.target).data('id'));
    $('.am-table-sort-list ul li').removeClass('active');
    reSortArr();
});

// 重新排序
function reSortArr () {
    $.each($('.am-table-sort-list ul'), function(index, val) {
        if ($(val).children('li').length == 1) {
            $(val).find('font').first().text(index + 1);
        } else {
            $(val).find('font').first().text(index + 1 + '-1');
            $.each($(val).find('li'), function(i, v) {
                $(v).find('font').first().text((index + 1) + '-' + (i + 1));
            });
        }
    });
    saveListArr();
}

// 存储数组
function saveListArr () {
    var arr = [];
    $.each($('.am-table-sort-list ul'), function(index, val) {
        arr.push([]);
        $.each($(val).find('li'), function(i, v) {
            var name = $(v).text().split(',')[1];
            arr[index].push({id: $(v).data('id'), name: name.substr(0, name.length - 1)});
        });
    });
    win.module_list_arr = arr;
};

//////////////////////// 并行模块 end /////////////////////////////////
     
////////////////////////////////////////////////////编辑模块页面//////////////////////////////////////////////////
	// var url=window.location.pathname;
	//  $.getUrlParam = function (name) {
	//    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
	//    var r = window.location.search.substr(1).match(reg);
	//    if (r != null) return unescape(r[2]); return null;
	//   }

	// if(url=='/project/edit_module.php'){
	// 	var id=$.getUrlParam('id');
	// 	$.ajax({
 //            url: 'ajax.php',
 //            data: {
 //                id: id,
 //                type: 'edit_module'
 //            },
 //            type: 'post',
 //            dataType: 'json',
 //            async: true,
 //            success: function(msg) {
 //                if (msg != "") {
 //                	$('#m-m-con').find('select').selected('destroy');
 //                	$('#m-m-name').val(msg['name']);
 //                    $("#m-m-dpm option[value="+msg['dpm']+"]").attr("selected", true);
 //                    $("#m-m-exp option[value='助理康复师,美容师']").attr("selected", true);
 //                     //$("#select_id option[value='广州市']").attr("selected", true);
 //                     $('#m-m-con').find('select').selected();
 //                     //alert(msg['executor_title']);
                    
 //                }

 //            }

 //        });
	// }
    
})