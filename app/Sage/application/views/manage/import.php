<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Metronic | Form Stuff - Form Wizard</title>
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
   <link rel="shortcut icon" href="favicon.ico" />
   <style type="text/css">
	body {
	    background-color: #FFFFFF !important;
	}
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
                     Form Wizard
                     <small>form wizard sample</small>
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
                           <i class="icon-reorder"></i> Form Wizard - <span class="step-title">Step 1 of 4</span>
                        </h4>
                        <div class="tools hidden-phone">
                           <a href="javascript:;" class="collapse"></a>
                           <a href="#portlet-config" data-toggle="modal" class="config"></a>
                           <a href="javascript:;" class="reload"></a>
                           <a href="javascript:;" class="remove"></a>
                        </div>
                     </div>
                     <div class="portlet-body form">
                        <form action="#" class="form-horizontal">
                           <div class="form-wizard">
                              <div class="navbar steps">
                                 <div class="navbar-inner">
                                    <ul class="row-fluid">
                                       <li class="span2">
                                          <a href="#tab1" data-toggle="tab" class="step active">
                                          <span class="number">1</span>
                                          <span class="desc"><i class="icon-ok"></i> Account Setup</span>   
                                          </a>
                                       </li>
                                       <li class="span2">
                                          <a href="#tab2" data-toggle="tab" class="step">
                                          <span class="number">2</span>
                                          <span class="desc"><i class="icon-ok"></i> Profile Setup</span>   
                                          </a>
                                       </li>
                                       <li class="span2">
                                          <a href="#tab3" data-toggle="tab" class="step">
                                          <span class="number">3</span>
                                          <span class="desc"><i class="icon-ok"></i> Billing Setup</span>   
                                          </a>
                                       </li>
                                       <li class="span2">
                                          <a href="#tab4" data-toggle="tab" class="step">
                                          <span class="number">4</span>
                                          <span class="desc"><i class="icon-ok"></i> Confirm</span>   
                                          </a> 
                                       </li>
                                       <li class="span2">
                                          <a href="#tab5" data-toggle="tab" class="step">
                                          <span class="number">5</span>
                                          <span class="desc"><i class="icon-ok"></i> Confirm</span>   
                                          </a> 
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                              <div id="bar" class="progress progress-success progress-striped">
                                 <div class="bar"></div>
                              </div>
                              <div class="tab-content">
                                 <div class="tab-pane active" id="tab1">
                                    <h3 class="block">Provide your account details</h3>
                                    <div class="control-group">
                                       <label class="control-label">Username</label>
                                       <div class="controls">
                                          <input type="text" class="span6 m-wrap" />
                                          <span class="help-inline">Provide your username</span>
                                       </div>
                                    </div>
                                    <div class="control-group">
                                       <label class="control-label">Password</label>
                                       <div class="controls">
                                          <input type="password" class="span6 m-wrap" />
                                          <span class="help-inline">Provide your username</span>
                                       </div>
                                    </div>
                                    <div class="control-group">
                                       <label class="control-label">Confirm Password</label>
                                       <div class="controls">
                                          <input type="password" class="span6 m-wrap" />
                                          <span class="help-inline">Confirm your password</span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="tab-pane" id="tab2">
                                    <h3 class="block">Provide your profile details</h3>
                                    <div class="control-group">
                                       <label class="control-label">Fullname</label>
                                       <div class="controls">
                                          <input type="text" class="span6 m-wrap" />
                                          <span class="help-inline">Provide your fullname</span>
                                       </div>
                                    </div>
                                    <div class="control-group">
                                       <label class="control-label">Email</label>
                                       <div class="controls">
                                          <input type="text" class="span6 m-wrap" />
                                          <span class="help-inline">Provide your email address</span>
                                       </div>
                                    </div>
                                    <div class="control-group">
                                       <label class="control-label">Phone Number</label>
                                       <div class="controls">
                                          <input type="text" class="span6 m-wrap" />
                                          <span class="help-inline">Provide your phone number</span>
                                       </div>
                                    </div>
                                    <div class="control-group">
                                       <label class="control-label">Gender</label>
                                       <div class="controls">
                                          <label class="radio">
                                          <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked />
                                          Male
                                          </label>
                                          <div class="clearfix"></div>
                                          <label class="radio">
                                          <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2" />
                                          Female
                                          </label>  
                                       </div>
                                    </div>
                                    <div class="control-group">
                                       <label class="control-label">Address</label>
                                       <div class="controls">
                                          <input type="text" class="span6 m-wrap" />
                                          <span class="help-inline">Provide your street address</span>
                                       </div>
                                    </div>
                                    <div class="control-group">
                                       <label class="control-label">City/Town</label>
                                       <div class="controls">
                                          <input type="text" class="span6 m-wrap" />
                                          <span class="help-inline">Provide your city or town</span>
                                       </div>
                                    </div>
                                    <div class="control-group">
                                       <label class="control-label">Remarks</label>
                                       <div class="controls">
                                          <textarea class="span6 m-wrap" rows="3"></textarea>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="tab-pane" id="tab3">
                                    <h3 class="block">Provide your billing and credit card details</h3>
                                    <div class="control-group">
                                       <label class="control-label">Card Holder Name</label>
                                       <div class="controls">
                                          <input type="text" class="span6 m-wrap" />
                                          <span class="help-inline"></span>
                                       </div>
                                    </div>
                                    <div class="control-group">
                                       <label class="control-label">Bank Name</label>
                                       <div class="controls">
                                          <input type="text" class="span6 m-wrap" />
                                          <span class="help-inline"></span>
                                       </div>
                                    </div>
                                    <div class="control-group">
                                       <label class="control-label">Debit/Credit Card Number</label>
                                       <div class="controls">
                                          <input type="text" class="span6 m-wrap" />
                                          <span class="help-inline"></span>
                                       </div>
                                    </div>
                                    <div class="control-group">
                                       <label class="control-label">CVC</label>
                                       <div class="controls">
                                          <input type="text" placeholder="" class="m-wrap" />
                                          <span class="help-inline"></span>
                                       </div>
                                    </div>
                                    <div class="control-group">
                                       <label class="control-label">Expiration Date(MM/YYYY)</label>
                                       <div class="controls">
                                          <input type="text" placeholder="MM" class="m-wrap small" />
                                          <input type="text" placeholder="YYYY" class="m-wrap small" />
                                          <span class="help-inline"></span>
                                       </div>
                                    </div>
                                    <div class="control-group">
                                       <label class="control-label">Payment Options</label>
                                       <div class="controls">
                                          <label class="checkbox line">
                                          <input type="checkbox" value="" /> Auto-Pay with this Credit Card
                                          </label>
                                          <label class="checkbox line">
                                          <input type="checkbox" value="" /> Email me monthly billing
                                          </label>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="tab-pane" id="tab4">
                                    <h3 class="block">Confirm your account</h3>
                                    <div class="control-group">
                                       <label class="control-label">Fullname:</label>
                                       <div class="controls">
                                          <span class="text">Bob Nilson</span>
                                       </div>
                                    </div>
                                    <div class="control-group">
                                       <label class="control-label">Email:</label>
                                       <div class="controls">
                                          <span class="text">bob@nilson.com</span>
                                       </div>
                                    </div>
                                    <div class="control-group">
                                       <label class="control-label">Phone:</label>
                                       <div class="controls">
                                          <span class="text">101234023223</span>
                                       </div>
                                    </div>
                                    <div class="control-group">
                                       <label class="control-label">Credit Card Number:</label>
                                       <div class="controls">
                                          <span class="text">*************1233</span>
                                       </div>
                                    </div>
                                    <div class="control-group">
                                       <label class="control-label"></label>
                                       <div class="controls">
                                          <label class="checkbox">
                                          <input type="checkbox" value="" /> I confirm my account
                                          </label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-actions clearfix">
                                 <a href="javascript:;" class="btn button-previous">
                                 <i class="m-icon-swapleft"></i> Back 
                                 </a>
                                 <a href="javascript:;" class="btn blue button-next">
                                 Continue <i class="m-icon-swapright m-icon-white"></i>
                                 </a>
                                 <a href="javascript:;" class="btn green button-submit">
                                 Submit <i class="m-icon-swapright m-icon-white"></i>
                                 </a>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <!-- END PAGE CONTENT-->         
         </div>
         <!-- END PAGE CONTAINER-->
        
         
   <!-- BEGIN JAVASCRIPTS -->    
   <!-- Load javascripts at bottom, this will reduce page load time -->
   <script src="<?php echo __BASEURL__?>templates/assets/js/jquery-1.8.3.min.js"></script>    
   <script src="<?php echo __BASEURL__?>templates/assets/breakpoints/breakpoints.js"></script>       
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
   <script src="<?php echo __BASEURL__?>templates/assets/js/app.js"></script>     
   <script>
      jQuery(document).ready(function() {       
         // initiate layout and plugins
         App.init();
      });
   </script>
   <!-- END JAVASCRIPTS -->   
</body>
<!-- END BODY -->
</html>
