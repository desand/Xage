<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Import Data System</title>
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
   <link rel="stylesheet" type="text/css" href="<?php echo __BASEURL__?>templates/assets/uniform/css/uniform.default.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo __BASEURL__?>templates/assets/chosen-bootstrap/chosen/chosen.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo __BASEURL__?>templates/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo __BASEURL__?>templates/assets/bootstrap-datepicker/css/datepicker.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo __BASEURL__?>templates/assets/bootstrap-timepicker/compiled/timepicker.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo __BASEURL__?>templates/assets/bootstrap-colorpicker/css/colorpicker.css" />
   <link rel="stylesheet" href="<?php echo __BASEURL__?>templates/assets/bootstrap-toggle-buttons/static/stylesheets/bootstrap-toggle-buttons.css" />
   <link rel="stylesheet" href="<?php echo __BASEURL__?>templates/assets/data-tables/DT_bootstrap.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo __BASEURL__?>templates/assets/bootstrap-daterangepicker/daterangepicker.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo __BASEURL__?>templates/assets/uniform/css/uniform.default.css" />
   
   <link rel="stylesheet" href="<?php echo __BASEURL__?>templates/assets/jquery-file-upload/css/jquery.fileupload-ui.css">
   <noscript>
		<link rel="stylesheet" href="<?php echo __BASEURL__?>templates/assets/jquery-file-upload/css/jquery.fileupload-ui-noscript.css">
   </noscript>
   
   <style type="text/css">
	body {
	    background-color: #FFFFFF !important;
	}
	.form-wizard .step .number{ padding:6px 9px !important}
	#tab3 table.table td{ padding:0 0 0 2px; font-size:12px;}
	#tab3 table.table th{ padding:0 0 0 2px; font-size:13px;}
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
                  	数据处理系统
                     <small>数据匹配</small>
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
                           <i class="icon-reorder"></i>  数据匹配 - <span class="step-title">Step 1 of 3</span>
                        </h4>
                     </div>
                     <div class="portlet-body form form-horizontal">
                           <div class="form-wizard">
                              <div class="navbar steps">
                                 <div class="navbar-inner">
                                    <ul class="row-fluid">
                                       <li class="span4">
                                          <a href="#tab1" data-toggle="tab" class="step active">
                                          <span class="number">1</span>
                                          <span class="desc"><i class="icon-ok"></i> 上传护照仪导出模板</span>   
                                          </a>
                                       </li>
                                       <li class="span4">
                                          <a href="#tab2" data-toggle="tab" class="step">
                                          <span class="number">2</span>
                                          <span class="desc"><i class="icon-ok"></i> 分析护照数据</span>   
                                          </a>
                                       </li>
                                       <li class="span4">
                                          <a href="#tab3" data-toggle="tab" class="step">
                                          <span class="number">3</span>
                                          <span class="desc"><i class="icon-ok"></i> 配对数据</span>   
                                          </a>
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                              <div id="bar" class="progress progress-success progress-striped">
                                 <div class="bar"></div>
                              </div>
                              <div class="tab-content">
                              	 <!-- START Tab 1 -->
                                 <div class="tab-pane active" id="tab1">

	<blockquote>
							<p style="font-size:16px">
							选择您要上传的护照数据，<b style="color:red;">请确保文件名没有中文字符。</b>
							</p>
						</blockquote>
						<br>
 <!-- The file upload form used as target for the file upload widget -->
 						<input type="hidden" value="<?php echo base_url().'templates/assets/jquery-file-upload/server/php/';?>" id="fileuploadurl"/>
 						<input type="hidden" value="<?php echo site_url('admin/manage/analysis/'.$show_id);?>" id="step2url"/>
 						<input type="hidden" value="<?php echo site_url('admin/manage/doindb/'.$show_id);?>" id="doindburl"/>
 						<input type="hidden" value="<?php echo site_url('admin/manage/doanalysis/'.$show_id);?>" id="doanalysisurl"/>
 						
 						<input type="hidden" value="<?php echo site_url('admin/manage/listmatch/'.$show_id);?>" id="step3url"/>
 						
						<form id="fileupload" action="" method="POST" enctype="multipart/form-data">
							<!-- Redirect browsers with JavaScript disabled to the origin page -->
							<noscript><input type="hidden" name="redirect" value="http://blueimp.github.com/jQuery-File-Upload/"></noscript>
							<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
							<div class="row-fluid fileupload-buttonbar">
								<div class="span12">
									<!-- The fileinput-button span is used to style the file input field as button -->
									<span class="btn green fileinput-button">
									<i class="icon-plus icon-white"></i>
									<span>Add files...</span>
									<input type="file" name="files[]" multiple>
									</span>
									<button type="submit" class="btn blue start">
									<i class="icon-upload icon-white"></i>
									<span>Start upload</span>
									</button>
									<button type="reset" class="btn yellow cancel">
									<i class="icon-ban-circle icon-white"></i>
									<span>Cancel upload</span>
									</button>
									<button type="button" class="btn red delete">
									<i class="icon-trash icon-white"></i>
									<span>Delete</span>
									</button>
									<input type="checkbox" class="toggle fileupload-toggle-checkbox">
								</div>
								<!-- The global progress information -->
								<div class="span5 fileupload-progress fade">
									<!-- The global progress bar -->
									<div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
										<div class="bar" style="width:0%;"></div>
									</div>
									<!-- The extended global progress information -->
									<div class="progress-extended">&nbsp;</div>
								</div>
							</div>
							<!-- The loading indicator is shown during file processing -->
							<div class="fileupload-loading"></div>
							<br>
							<!-- The table listing the files available for upload/download -->
							<table role="presentation" class="table table-striped">
								<tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody>
							</table>
						</form>

                                 
                                 </div>
                                 <!-- END Tab 1 -->
                                 <div class="tab-pane" id="tab2">
									<div class="alert alert-info"><b>操作步骤:</b> <br/> 1. 点击"入库"按钮, 等待系统返回结果<br/> 2. 点击"分析"按钮, 等待系统返回结果<br/> 3. 点击"配对"按钮, 等待系统返回结果</div>
									<div class="span12" style="margin-left:0;">
						<!-- BEGIN SAMPLE TABLE PORTLET-->
						<div class="portlet box blue">
							<div class="portlet-title">
								<h4><i class="icon-table"></i>文件列表</h4>
							</div>
							<div class="portlet-body">
								<table class="table table-striped table-hover" id="filestable">
									<thead>
										<tr>
											<th>#</th>
											<th>文件名</th>
											<th>数据量</th>
											<th>入库时间</th>
											<th>分析结果</th>
											<th class="hidden-480">状态</th>
											<th>操作</th>
										</tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
							</div>
						</div>
						<!-- END SAMPLE TABLE PORTLET-->
					</div>
			                                    
                                 </div>
                                 
                                  <div class="tab-pane" id="tab3">
                                  </div>
                                 
                              </div>
                              <div class="form-actions clearfix">
                                 <a href="javascript:;" class="btn button-previous">
                                 <i class="m-icon-swapleft"></i> 上一步 
                                 </a>
                                 <a href="javascript:;" class="btn blue button-next">
                                 下一步 <i class="m-icon-swapright m-icon-white"></i>
                                 </a>
                                 <a href="javascript:;" class="btn green button-submit">
                                 完成	 <i class="m-icon-swapright m-icon-white"></i>
                                 </a>
                              </div>
                           </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- END PAGE CONTENT-->      
            
            <!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid">
					<div class="span12">
						<script id="template-upload" type="text/x-tmpl">
							{% for (var i=0, file; file=o.files[i]; i++) { %}
							    <tr class="template-upload fade">
							        <td class="preview"><span class="fade"></span></td>
							        <td class="name"><span>{%=file.name%}</span></td>
							        <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
							        {% if (file.error) { %}
							            <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
							        {% } else if (o.files.valid && !i) { %}
							            <td>
							                <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="bar" style="width:0%;"></div></div>
							            </td>
							            <td class="start">{% if (!o.options.autoUpload) { %}
							                <button class="btn">
							                    <i class="icon-upload icon-white"></i>
							                    <span>Start</span>
							                </button>
							            {% } %}</td>
							        {% } else { %}
							            <td colspan="2"></td>
							        {% } %}
							        <td class="cancel">{% if (!i) { %}
							            <button class="btn red">
							                <i class="icon-ban-circle icon-white"></i>
							                <span>Cancel</span>
							            </button>
							        {% } %}</td>
							    </tr>
							{% } %}
						</script>
						<!-- The template to display files available for download -->
						<script id="template-download" type="text/x-tmpl">
							{% for (var i=0, file; file=o.files[i]; i++) { %}
							    <tr class="template-download fade">
							        {% if (file.error) { %}
							            <td></td>
							            <td class="name"><span>{%=file.name%}</span></td>
							            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
							            <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
							        {% } else { %}
							            <td class="preview">
							            {% if (file.thumbnail_url) { %}
							                <a class="fancybox-button" data-rel="fancybox-button" href="{%=file.url%}" title="{%=file.name%}">
							                	<img src="{%=file.thumbnail_url%}">
							                </a>
							            {% } %}</td>
							            <td class="name">
							                <a href="{%=file.url%}" title="{%=file.name%}" data-gallery="{%=file.thumbnail_url&&'gallery'%}" download="{%=file.name%}">{%=file.name%}</a>
							            </td>
							            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
							            <td colspan="2"></td>
							        {% } %}
							        <td class="delete">
							            <button class="btn red" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}"{% if (file.delete_with_credentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
							                <i class="icon-trash icon-white"></i>
							                <span>Delete</span>
							            </button>
							            <input type="checkbox" class="fileupload-checkbox hide" name="delete" value="1">
							        </td>
							    </tr>
							{% } %}
						</script>
					</div>
				</div>
				<!-- END PAGE CONTENT-->   
         </div>
         <!-- END PAGE CONTAINER-->
        
         
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
   <script type="text/javascript" src="<?php echo __BASEURL__?>templates/assets/uniform/jquery.uniform.min.js"></script>
   <script type="text/javascript" src="<?php echo __BASEURL__?>templates/assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script> 
   <script type="text/javascript" src="<?php echo __BASEURL__?>templates/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
   <script type="text/javascript" src="<?php echo __BASEURL__?>templates/assets/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
   <script type="text/javascript" src="<?php echo __BASEURL__?>templates/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
   <script type="text/javascript" src="<?php echo __BASEURL__?>templates/assets/bootstrap-daterangepicker/date.js"></script>
   <script type="text/javascript" src="<?php echo __BASEURL__?>templates/assets/bootstrap-daterangepicker/daterangepicker.js"></script> 
   <script type="text/javascript" src="<?php echo __BASEURL__?>templates/assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>  
   <script type="text/javascript" src="<?php echo __BASEURL__?>templates/assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
   
  <!-- BEGIN:File Upload Plugin JS files-->
	<script src="<?php echo __BASEURL__?>templates/assets/jquery-file-upload/js/vendor/jquery.ui.widget.js"></script>
	<!-- The Templates plugin is included to render the upload/download listings -->
	<script src="<?php echo __BASEURL__?>templates/assets/jquery-file-upload/js/vendor/tmpl.min.js"></script>
	<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
	<script src="<?php echo __BASEURL__?>templates/assets/jquery-file-upload/js/vendor/load-image.min.js"></script>
	<!-- The Canvas to Blob plugin is included for image resizing functionality -->
	<script src="<?php echo __BASEURL__?>templates/assets/jquery-file-upload/js/vendor/canvas-to-blob.min.js"></script>
	<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
	<script src="<?php echo __BASEURL__?>templates/assets/jquery-file-upload/js/jquery.iframe-transport.js"></script>
	<!-- The basic File Upload plugin -->
	<script src="<?php echo __BASEURL__?>templates/assets/jquery-file-upload/js/jquery.fileupload.js"></script>
	<!-- The File Upload file processing plugin -->
	<script src="<?php echo __BASEURL__?>templates/assets/jquery-file-upload/js/jquery.fileupload-fp.js"></script>
	<!-- The File Upload user interface plugin -->
	<script src="<?php echo __BASEURL__?>templates/assets/jquery-file-upload/js/jquery.fileupload-ui.js"></script>
	<!-- The main application script -->
	<script src="<?php echo __BASEURL__?>templates/assets/jquery-file-upload/js/main.js"></script>
	<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE8+ -->
	<!--[if gte IE 8]><script src="<?php echo __BASEURL__?>templates/js/cors/jquery.xdr-transport.js"></script><![endif]-->
	<!-- END:File Upload Plugin JS files-->

   
   <script src="<?php echo __BASEURL__?>templates/assets/js/app.js"></script>     
   <script>
      jQuery(document).ready(function() {       
         // initiate layout and plugins
         App.init();
         App.initUniform('.fileupload-toggle-checkbox'); // initialize uniform checkboxes
      });

      function _block(msg){
          if(msg == false){
        	  setTimeout($.unblockUI, 1000);
          }else{
	          $.blockUI({
				message: msg,
				css: {
					border: 'none',
					padding: '15px',
					backgroundColor: '#000',
					opacity: 0.7,
					color: '#fff'
				}
			  });
          }
      }
   </script>
   <!-- END JAVASCRIPTS -->   
</body>
<!-- END BODY -->
</html>
