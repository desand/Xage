<?php
$match_summary = json_decode($details['result'],true);
$atom = json_decode($details['result_details'],true);

$thisattendee = array();
foreach ($attendee as $each){
	$thisattendee[$each['name']][$each['AC']][$each['G']][] = $each;
}
//print_r($thisattendee);exit;
//print_r($atom);exit;

$thiskeys = array();
foreach($keys as $i=>$k){
	$thiskeys[$k] = $vals[$i];
}

?>
<div class="span12">
	<div class="alert alert-error"><b>在配对操作结束后, 请点击最下方"完成"按钮</b></div>
	<!--BEGIN TABS-->
	<div class="tabbable tabbable-custom">
		<?php if(count($match_summary)>0):?>
		<ul class="nav nav-tabs">
			<?php $i = 0;foreach($match_summary as $key=>$val):?>
			<li <?php if($i==0):?>class="active"<?php endif;?>><a data-toggle="tab" href="#tab_1_<?php echo $i+1;?>"><?php print_r(str_replace(array('matchno','matchone','matchmore'),array('完全没能配对','成功配对','存在配对1对N情况'),$key.'('.$val.')'))?></a></li>
			<?php $i++; endforeach;?>
		</ul>
		<div class="tab-content">
			<?php $i = 0;foreach($match_summary as $key=>$val):?>
			<div id="tab_1_<?php echo $i+1;?>" class="tab-pane <?php if($i==0):?>active<?php endif;?>">
				<!-- BEGIN SAMPLE TABLE PORTLET-->
				<div class="portlet box green">
					<div class="portlet-title">
						<h4><i class="icon-table"></i><?php print_r(str_replace(array('matchno','matchone','matchmore'),array('完全没能配对','成功配对','存在配对1对N情况'),$key.'('.$val.')'))?></h4>
					</div>
					
					<?php if($key == 'matchno'):?>
					<div class="portlet-body">
						<div class="clearfix">
							<div class="btn-group pull-right open">
								<button data-toggle="dropdown" class="btn dropdown-toggle">Tools <i class="icon-angle-down"></i>
								</button>
								<ul class="dropdown-menu">
									<li><a href="javascript:void(0)" class="_export" val="<?php echo $id;?>" key="<?php echo $key;?>">导出到Excel</a></li>
								</ul>
							</div>
						</div>
						<table class="table table-striped table-hover" id="<?php echo $key;?>">
							<thead>
								<tr>
									<?php foreach($dkeys as $k):?>
									<th class="_<?php echo $k;?>"><?php echo $thiskeys[$k];?></th>
									<?php endforeach;?>
								</tr>
							</thead>
							<?php if($val>0):?>
								<tbody>
									<?php foreach($atom[$key] as $each):?>
									<tr>
										<?php foreach($dkeys as $k):?>
										<td><?php echo isset($each[$k])?$each[$k]:'';?></td>
										<?php endforeach;?>
									</tr>
									<?php endforeach;?>
								</tbody>
							<?php endif;?>
						</table>
					</div>
					<?php endif;?>
					
					<?php if($key == 'matchone'):?>
					<div class="portlet-body">
						<div class="clearfix">
							<div class="btn-group pull-right open">
								<button data-toggle="dropdown" class="btn dropdown-toggle">Tools <i class="icon-angle-down"></i>
								</button>
								<ul class="dropdown-menu">
									<li><a class="btn_domatch_all" href="javascript:void(0)">全部确认配对</a></li>
									<li><a href="javascript:void(0)" class="_export" val="<?php echo $id;?>" key="<?php echo $key;?>">导出到Excel</a></li>
								</ul>
							</div>
						</div>
						<table class="table table-bordered datatable" id="<?php echo $key;?>">
							<thead>
								<tr>
									<th>#</th>
									<?php foreach($dkeys as $k):?>
									<th class="_<?php echo $k;?>"><?php echo $thiskeys[$k];?></th>
									<?php endforeach;?>
								</tr>
							</thead>
							<?php if($val>0):?>
								<tbody>
									<?php foreach($atom[$key] as $j=>$each):?>
									<tr id="ori_<?php echo $j;?>">
										<td class="alert-error"><i class="icon-list-ul"></i> <?php echo $j+1;?></td>
										<?php foreach($dkeys as $k):?>
										<td class="ori" key="<?php echo $k;?>"><?php echo isset($each[$k])?$each[$k]:'';?></td>
										<?php endforeach;?>
									</tr>
									<tr class="ori_<?php echo $j;?>">
										<td style="border-bottom:2px solid #333;">&nbsp;</td>
										<td colspan="<?php echo count($dkeys);?>" style="border-bottom:2px solid #333;">
											<?php if(isset($thisattendee[$each['Z']][$each['AC']][$each['AB']])):?>
											<table class="table table-striped table-hover">
												<thead>
													<tr>
														<?php foreach($atkeys as $k):?>
														<th class="_<?php echo $k;?>"><?php echo $thiskeys[$k];?></th>
														<?php endforeach;?>
														<th>操作</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach($thisattendee[$each['Z']][$each['AC']][$each['AB']] as $thiseach):?>
													<tr class="tar_<?php echo $thiseach['id'];?>" ori="<?php echo $j;?>" val="<?php echo $thiseach['id'];?>">
														<?php foreach($atkeys as $k):?>
														<td class="_<?php echo $k;?>"><?php echo $thiseach[$k];?></td>
														<?php endforeach;?>
														<td><a class="btn mini green btn_domatch" style="width:30px;" href="javascript:void(0)">确认</a></td>
													</tr>
													<?php endforeach;?>
												</tbody>
											</table>
											<?php endif;?>
										</td>
									</tr>
									<?php endforeach;?>
								</tbody>
							<?php endif;?>
						</table>
					</div>
					<?php endif;?>
					
					
					<?php if($key == 'matchmore'):?>
					<div class="portlet-body">
						<div class="clearfix">
							<div class="btn-group pull-right open">
								<button data-toggle="dropdown" class="btn dropdown-toggle">Tools <i class="icon-angle-down"></i>
								</button>
								<ul class="dropdown-menu">
									<li><a href="javascript:void(0)" class="_export" val="<?php echo $id;?>" key="<?php echo $key;?>">导出到Excel</a></li>
								</ul>
							</div>
						</div>
						<table class="table table-bordered datatable" id="<?php echo $key;?>">
							<thead>
								<tr>
									<th>#</th>
									<?php foreach($dkeys as $k):?>
									<th class="_<?php echo $k;?>"><?php echo $thiskeys[$k];?></th>
									<?php endforeach;?>
								</tr>
							</thead>
							<?php if($val>0):?>
								<tbody>
									<?php foreach($atom[$key] as $j=>$each):?>
									<tr id="ori_<?php echo $j;?>">
										<td class="alert-error"><i class="icon-list-ul"></i> <?php echo $j+1;?></td>
										<?php foreach($dkeys as $k):?>
										<td class="ori" key="<?php echo $k;?>"><?php echo isset($each[$k])?$each[$k]:'';?></td>
										<?php endforeach;?>
									</tr>
									<tr class="ori_<?php echo $j;?>">
										<td>&nbsp;</td>
										<td colspan="<?php echo count($dkeys);?>">
											<div class="tabbable tabbable-custom tabs-below">
												<div class="tab-content">
													<div id="tab_2_<?php echo $j?>_1" class="tab-pane active">
														<?php
														$ma = array('a'=>0,'b'=>0); 
														if(isset($thisattendee[$each['Z']][$each['AC']])):
														$errorkey = array('AB'=>'G');
														?>
														<table class="table table-striped table-hover">
															<thead>
																<tr>
																	<?php foreach($atkeys as $k):?>
																	<th class="_<?php echo $k;?>"><?php echo $thiskeys[$k];?></th>
																	<?php endforeach;?>
																	<th>操作</th>
																</tr>
															</thead>
															<tbody>
																<?php foreach($thisattendee[$each['Z']][$each['AC']] as $abeach):?>
																	<?php foreach($abeach as $thiseach):?>
																	<tr class="tar_<?php echo $thiseach['id'];?>" ori="<?php echo $j;?>" val="<?php echo $thiseach['id'];?>">
																		<?php foreach($atkeys as $k):?>
																		<td class="_<?php echo $k;?> <?php $havek = array_search($k,$errorkey);if($havek && $each[$havek]!=$thiseach[$k]):?>alert-error<?php endif;?>"><?php echo $thiseach[$k];?></td>
																		<?php endforeach;?>
																		<td><a class="btn mini green btn_domatch" style="width:30px;" href="javascript:void(0)">确认</a></td>
																	</tr>
																	<?php $ma['a']++;endforeach;?>
																<?php endforeach;?>
															</tbody>
														</table>
														<?php unset($thisattendee[$each['Z']][$each['AC']]);endif;?>
													</div>
													<div id="tab_2_<?php echo $j?>_2" class="tab-pane">
														<?php if(isset($thisattendee[$each['Z']])&&count($thisattendee[$each['Z']])>0):
														$errorkey = array('AB'=>'G','AC'=>'AC');?>
														<table class="table table-striped table-hover">
															<thead>
																<tr>
																	<?php foreach($atkeys as $k):?>
																	<th class="_<?php echo $k;?>"><?php echo $thiskeys[$k];?></th>
																	<?php endforeach;?>
																	<th>操作</th>
																</tr>
															</thead>
															<tbody>
																<?php foreach($thisattendee[$each['Z']] as $aceach):?>
																	<?php foreach($aceach as $abeach):?>
																		<?php foreach($abeach as $thiseach):?>
																		<tr class="tar_<?php echo $thiseach['id'];?>" ori="<?php echo $j;?>" val="<?php echo $thiseach['id'];?>">
																			<?php foreach($atkeys as $k):?>
																			<td class="_<?php echo $k;?> <?php $havek = array_search($k,$errorkey);if($havek && $each[$havek]!=$thiseach[$k]):?>alert-error<?php endif;?>"><?php echo $thiseach[$k];?></td>
																			<?php endforeach;?>
																			<td><a class="btn mini green btn_domatch" style="width:30px;" href="javascript:void(0)">确认</a></td>
																		</tr>
																		<?php $ma['b']++;endforeach;?>
																	<?php endforeach;?>
																<?php endforeach;?>
															</tbody>
														</table>
														<?php //unset($thisattendee[$each['Z']]); 
														endif;?>
													</div>
												</div>
												<ul class="nav nav-tabs">
													<li class="active"><a data-toggle="tab" href="#tab_2_<?php echo $j?>_1">匹配[姓名+出生日期] (<?php echo $ma['a']?>)</a></li>
													<li><a data-toggle="tab" href="#tab_2_<?php echo $j?>_2">匹配[姓名] (<?php echo $ma['b']?>)</a></li>
												</ul>
											</div>
										
											
											
											
										</td>
									</tr>
									<?php endforeach;?>
								</tbody>
							<?php endif;?>
						</table>
					</div>
					<?php endif;?>
					
					
				</div>
				<!-- END SAMPLE TABLE PORTLET-->
			</div>
			<?php $i++; endforeach;?>
		</div>
		<?php endif;?>
	</div>
	<!--END TABS-->
	<input type="hidden" value="<?php echo site_url('admin/manage/domatch/'.$show_id);?>" id="domatchurl"/>
	<input type="hidden" value="<?php echo site_url('admin/manage/domatchall/'.$show_id);?>" id="domatchallurl"/>
	<input type="hidden" value="<?php echo site_url('admin/manage/donematch/'.$show_id);?>" id="donematchurl"/>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('#form_wizard_1 .button-submit').attr('val','<?php echo $id;?>');
	$('#tab3 ._export').click(function(){
		window.open('<?php echo site_url('admin/manage/exportrequest/'.$show_id)?>?id='+$(this).attr('val')+'&key='+$(this).attr('key'));
		/*var ulhtm = $(this).parents('.btn-group').parent().next().clone();
		//var val = 'html='+ulhtm.html();

		var form = $("<form>");   //定义一个form表单
		form.attr('style','display:none');   //在form表单中添加查询参数
		form.attr('target','');
		form.attr('method','post');
		form.attr('action',"");

		var input1 = $('<input>');
		input1.attr('type','hidden');
		input1.attr('name','html');
		input1.attr('value',ulhtm.html());

		$('body').append(form);  //将表单放置在web中
		form.append(input1);
		form.submit();*/
		
	});
	$('#tab3 .btn_domatch').click(function(){
		//_block("<div style='height:200px'>正在处理中...</div>");
		var tar = $(this).parent().parent();
		
		var data = new Object();
		var params = new Object();

		data.id = tar.attr('val');
		data.ori = tar.attr('ori');
		tar.parents('table.datatable').find('tr#ori_'+data.ori).find('td.ori').each(function(){
			params[$(this).attr('key')] = $(this).text();
		});

		data.params = params;

		var ajurl = $('#domatchurl').attr('value');
		$.ajax({
			url: ajurl,
			type: "POST",
			data: data,
			dataType: 'json',
			async: true,//是否采取异步形式,false为同步
			error: function(){alert('error');},
			success: function (result){
				//_block(false);
				if(result.error){
					alert(result.error);
				}else{
					if(result.ori){
						tar.parents('table.datatable').find('tr.ori_'+result.ori).each(function(){$(this).find('a').remove()});
						tar.find('td:last-child').html('<i class="icon-ok"></i> ');
					}
				}
			}
		});
	});

	$('#tab3 .btn_domatch_all').click(function(){
		_block("<div style='height:200px'>正在处理中...</div>");
		var all = new Object();

		$('table#matchone').find('.btn_domatch').each(function(i){
			var tar = $(this).parent().parent();
			var data = new Object();
			var params = new Object();

			data.id = tar.attr('val');
			data.ori = tar.attr('ori');
			tar.parents('table.datatable').find('tr#ori_'+data.ori).find('td.ori').each(function(){
				params[$(this).attr('key')] = $(this).text();
			});

			data.params = params;
			all[i] = data;
		});

		var ajurl = $('#domatchallurl').attr('value');
		$.ajax({
			url: ajurl,
			type: "POST",
			data: all,
			dataType: 'json',
			async: true,//是否采取异步形式,false为同步
			error: function(){_block(false);alert('error');},
			success: function (result){
				_block(false);
				if(result.error){
					alert(result.error);
				}else{
					$.each(result,function(i,v){
						if(v.ori){
							//$('table#matchone tbody').find('tr.ori_'+v.ori).each(function(){$(this).find('a').remove()});
							$('table#matchone tbody').find('tr.ori_'+v.ori).find('a.btn_domatch').parent().html('<i class="icon-ok"></i> ');
						}
					});
					
				}
			}
		});
	});
});
</script>
