<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Visa System</title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="" name="author" />
   <link href="<?php echo __BASEURL__?>templates/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
   <link href="<?php echo __BASEURL__?>templates/assets/css/metro.css" rel="stylesheet" />
   <link href="<?php echo __BASEURL__?>templates/assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
   <link href="<?php echo __BASEURL__?>templates/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
   <link href="<?php echo __BASEURL__?>templates/assets/css/style.css" rel="stylesheet" />
   <link href="<?php echo __BASEURL__?>templates/assets/css/style_responsive.css" rel="stylesheet" />
   <link href="<?php echo __BASEURL__?>templates/assets/css/style_default.css" rel="stylesheet" id="style_color" />
   <link rel="stylesheet" type="text/css" href="<?php echo __BASEURL__?>templates/assets/gritter/css/jquery.gritter.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo __BASEURL__?>templates/assets/chosen-bootstrap/chosen/chosen.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo __BASEURL__?>templates/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo __BASEURL__?>templates/assets/bootstrap-datepicker/css/datepicker.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo __BASEURL__?>templates/assets/bootstrap-timepicker/compiled/timepicker.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo __BASEURL__?>templates/assets/bootstrap-colorpicker/css/colorpicker.css" />
   <link rel="stylesheet" href="<?php echo __BASEURL__?>templates/assets/bootstrap-toggle-buttons/static/stylesheets/bootstrap-toggle-buttons.css" />
   <link rel="stylesheet" href="<?php echo __BASEURL__?>templates/assets/data-tables/DT_bootstrap.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo __BASEURL__?>templates/assets/bootstrap-daterangepicker/daterangepicker.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo __BASEURL__?>templates/assets/uniform/css/uniform.default.css" />
   
   <style type="text/css">
	body {
	    background-color: #FFFFFF !important;
	}
	.form-wizard .step .number{ padding:6px 9px !important}
   </style>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-top">
   <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->   
            <div class="row-fluid">
               <div class="span12">
                  <h3 class="page-title">
                  	签证约签系统
                     <small>签证约签登记表</small>
                  </h3>
               </div>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">
               <div class="span12">
              
                  <div class="portlet box blue" id="form_wizard_1">
                  
                     <div class="portlet-title">
                        <h4>
                           <i class="icon-reorder"></i>  签证约签</span>
                        </h4>
                     </div>
                     <div class="portlet-body">
                          <div class="controls controls-row">
                          	<div class="span7">
                          		<div class="control-group">
                                	<label for="barcode" class="control-label">二维码编号</label>
                                    <div class="controls">
                                    	<input type="text" placeholder="Barcode" class="m-wrap span12" id="barcode">
                                        <span class="help-block"><button class="btn blue" type="button" onclick="visasearch();"><i class="icon-barcode"></i> 查询</button>（请用二维码扫描枪扫描护照上帖子编码或人工录入）</span>
                                    </div>
                                </div>
                                <div class="portlet box yellow">
                                	<div class="portlet-title black"><h4>1. 确定约签时间</h4></div>
                                	<div class="portlet-body form-horizontal step1 steps">
	                                    <div class="control-group">
	                                       <label class="control-label" for="datetime">时间</label>
	                                       <div class="controls">
	                                          <input type="text" class="m-wrap small  date-picker" placeholder="YYYY-mm-dd" id="date">
	                                          <input type="text" class="m-wrap small  timepicker-24" placeholder="HH:ii:ss" id="time">
	                                       </div>
	                                    </div>
	                                    <div class="control-group">
	                                       <label class="control-label" for="location">地点</label>
	                                       <div class="controls">
	                                          <input type="text" class="m-wrap large" placeholder="地点" id="location">
	                                       </div>
	                                    </div>
	                                    <div class="control-group">
	                                       <label class="control-label" for="remark">备注</label>
	                                       <div class="controls">
	                                          <input type="text" class="m-wrap large" placeholder="备注" id="remark">
	                                       </div>
	                                    </div>
	                                    <div class="control-group">
	                                    	<label class="control-label"></label>
	                                    	<div class="controls">
	                                        	<button class="btn green" type="submit" id="confirm">确定约签</button>
	                                        	<span class="help-block">操作时间:<span class="times _insertdatetime"></span></span>
	                                        	
	                                        </div>
	                                    </div>
                                    </div>
                                </div>
                                <div class="portlet box blue">
                                	<div class="portlet-title black"><h4>2. 签证进行中...</h4></div>
                                	<div class="portlet-body  step2 steps" style="height:auto; overflow:hidden;">
	                                    
                                    	<div class="control-group span3">
	                                       <label class="control-label">面签前护照出库</label>
	                                       <div class="controls">
	                                          <button class="btn blue btnstep" val="2" type="button">护照出库</button>
	                                          <span class="help-block">操作时间：<br/><span class="times _time_a"></span></span>
	                                       </div>
	                                    </div>
	                                    
	                                    <div class="control-group span3">
	                                       <label class="control-label">护照进入领使馆</label>
	                                       <div class="controls">
	                                          <button class="btn blue btnstep" val="3" type="button">进入领使馆</button>
	                                          <span class="help-block">操作时间：<br/><span class="times _time_b"></span></span>
	                                       </div>
	                                    </div>
	                                    
	                                    <div class="control-group span3">
	                                       <label class="control-label">签证通过</label>
	                                       <div class="controls">
	                                          <button class="btn blue btnstep" val="4" type="button">签证通过</button>
	                                          <span class="help-block">操作时间：<br/><span class="times _time_c"></span></span>
	                                       </div>
	                                    </div>
	                                    
	                                    <div class="control-group span3">
	                                       <label class="control-label">护照入库</label>
	                                       <div class="controls">
	                                          <button class="btn blue btnstep" val="5" type="button">护照入库</button>
	                                          <span class="help-block">操作时间：<br/><span class="times _time_d"></span></span>
	                                       </div>
	                                    </div>
	                                    
                                    </div>
                                </div>
                          	</div>
                            <div class="span5">
                            	<div class="portlet box blue">
									<div class="portlet-title">
										<h4><i class="icon-user"></i>客户信息</h4>
									</div>
									<div class="portlet-body">
										<?php 
										$keys = array('barcode','name','H','AF','AI','AG','AK','AL','AH','Z','AA','AB','AC','AD','AM');
										$vals = array('二维码','姓名','身份证号','护照号码','出生地','签发日期','发证机关','发证机关拼音','护照到期','中文姓名','汉语拼音','性别','出生日期','国籍','快递单号');
										?>
										<table class="table table-bordered table-hover">
											<tbody>
												<?php foreach($keys as $k=>$v):?>
												<tr>
													<td width="40%"><?php echo $vals[$k];?></td>
													<td width="60%" class="_keys _<?php echo $v?>"></td>
												</tr>
												<?php endforeach;?>
											</tbody>
										</table>
									</div>
								</div>
                          	</div>
                          </div>
					</div>
				</div>
				<!-- END PAGE CONTENT-->   
         </div>
         <!-- END PAGE CONTAINER-->
         <input type="hidden" value="<?php echo site_url('admin/manage/loadvisadata/'.$show_id);?>" id="loadvisadataurl"/>
         <input type="hidden" value="<?php echo site_url('admin/manage/visasteps/'.$show_id);?>" id="visastepsurl"/>
        
         
   <!-- BEGIN JAVASCRIPTS -->    
   <!-- Load javascripts at bottom, this will reduce page load time -->
   <script src="<?php echo __BASEURL__?>templates/assets/js/jquery-1.8.3.min.js"></script>    
   <script src="<?php echo __BASEURL__?>templates/assets/breakpoints/breakpoints.js"></script>       
   <script src="<?php echo __BASEURL__?>templates/assets/jquery-slimscroll/jquery-ui-1.9.2.custom.min.js"></script>	
   <script src="<?php echo __BASEURL__?>templates/assets/bootstrap/js/bootstrap.min.js"></script>
   <script src="<?php echo __BASEURL__?>templates/assets/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
   <script src="<?php echo __BASEURL__?>templates/assets/js/jquery.blockui.js"></script>
   <script src="<?php echo __BASEURL__?>templates/assets/js/jquery.cookie.js"></script>
   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="<?php echo __BASEURL__?>templates/assets/js/excanvas.js"></script>
   <script src="<?php echo __BASEURL__?>templates/assets/js/respond.js"></script>
   <![endif]-->
   <script type="text/javascript" src="<?php echo __BASEURL__?>templates/assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
   <script type="text/javascript" src="<?php echo __BASEURL__?>templates/assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script> 
   <script type="text/javascript" src="<?php echo __BASEURL__?>templates/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
   <script type="text/javascript" src="<?php echo __BASEURL__?>templates/assets/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
   <script type="text/javascript" src="<?php echo __BASEURL__?>templates/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
   <script type="text/javascript" src="<?php echo __BASEURL__?>templates/assets/bootstrap-daterangepicker/date.js"></script>
   <script type="text/javascript" src="<?php echo __BASEURL__?>templates/assets/bootstrap-daterangepicker/daterangepicker.js"></script> 
   <script type="text/javascript" src="<?php echo __BASEURL__?>templates/assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>  
   <script type="text/javascript" src="<?php echo __BASEURL__?>templates/assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
   
   <script src="<?php echo __BASEURL__?>templates/assets/js/app.js"></script>     
   <script>
      jQuery(document).ready(function() {       
         // initiate layout and plugins
         App.init();
         clean();

         $(document).keyup(function () {
        	 var event = window.event || arguments.callee.caller.arguments[0];
             var keyCode = event.keyCode;
             switch (keyCode) {
                 case 27:
                	 clean();
                     break;
                 default:
                     break;
             }
         });

         $('#barcode').keyup(function(){
             var event = window.event || arguments.callee.caller.arguments[0];
             if (event.keyCode == 13)
             {
            	 visasearch();
             }
         });

         $('#confirm').click(function(){
            var keys = ['date','time','location','remark'];
            var must = ['date','time','location'];

            var go = true;
            $.each(must,function(i,v){
            	if($('#'+v).val() == ''){
                    go = false;
                }
            });
            if(!go){
                alert('请把日期时间和地点填写完整.');
                return false;
            }

            var object = new Object();
            $.each(keys,function(i,v){
            	object[v] = $('#'+v).val();
            });
            object.barcode = $('#barcode').val();
            if(object.barcode == ''){
            	alert('二维码输入错误!');
                return false;
            }
            object.step = 1;

            var go = confirm("请再次确定约签...");
            if(!go){
                return false;
            }
            var ajurl = $('#visastepsurl').attr('value');
       		$.ajax({
       			url: ajurl,
       			type: "POST",
       			data: object,
       			dataType: 'json',
       			async: true,//是否采取异步形式,false为同步
       			error: function(){alert('error');},
       			success: function (result){
       				visasearch();
       			}
       		});
         });

         $('#form_wizard_1').find('.btnstep').each(function(){
             $(this).click(function(){
            	 var object = new Object();
            	 object.barcode = $('#barcode').val();
                 if(object.barcode == ''){
                 	 alert('二维码输入错误!');
                     return false;
                 }
            	 object.step = $(this).attr('val');

                 var ajurl = $('#visastepsurl').attr('value');
            		$.ajax({
            			url: ajurl,
            			type: "POST",
            			data: object,
            			dataType: 'json',
            			async: true,//是否采取异步形式,false为同步
            			error: function(){alert('error');},
            			success: function (result){
            				visasearch();
            			}
            		});
             });
         });
      });
      var visasearch = function(){
          var barcode = $('#barcode').val();
          if(barcode == ''){
              return false;
          }

          var ajurl = $('#loadvisadataurl').attr('value');
    		$.ajax({
    			url: ajurl,
    			type: "POST",
    			data: 'barcode='+barcode,
    			dataType: 'json',
    			async: true,//是否采取异步形式,false为同步
    			error: function(){alert('error');},
    			success: function (result){
    				if(result.error){
        				alert(result.error);
        			}else{
            			if(result.data.datetime != undefined){
	            			var datetime = result.data.datetime.split(' ');
	            			//alert(datetime);
	            			result.data.date = datetime[0];
	            			result.data.time = datetime[1];
            			}else{
            				result.data.date = '';
	            			result.data.time = '';
                		}
            			$.each(result.data,function(k,v){
                			$('#form_wizard_1').find('input#'+k).val(v?v:'');
                			$('#form_wizard_1').find('._'+k).text(v?v:'');
                		});
                		if(result.data.step){
                    		switch(result.data.step){
                    			case '1':{
                        			$('.step2').find('.span3').hide();
                        			$('.step2').find('.span3:eq(0)').show();
                        			break;
                        		}
                    			case '2':{
                        			$('.step2').find('.span3').hide();
                        			$('.step2').find('.span3:eq(0)').show();
                        			$('.step2').find('.span3:eq(1)').show();
                        			break;
                        		}
                    			case '3':{
                        			$('.step2').find('.span3').hide();
                        			$('.step2').find('.span3:eq(0)').show();
                        			$('.step2').find('.span3:eq(1)').show();
                        			$('.step2').find('.span3:eq(2)').show();
                        			break;
                        		}
                    			case '4':{
                        			$('.step2').find('.span3').show();
                        			break;
                        		}
                    			default:{
                        			
                        			break;
                        		}
                    		}
                    		$('.step2').show();
                    	}else{
                    		$('.step2').hide();
                        }
            		}
    			}
    		});
      }
      var clean = function(){
    	  $('#form_wizard_1').find('input[type="text"]').val('');
    	  $('#form_wizard_1').find('._keys').text('');
    	  $('#form_wizard_1').find('.times').text('');
      }
   </script>
   <!-- END JAVASCRIPTS -->   
</body>
<!-- END BODY -->
</html>
