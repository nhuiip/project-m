<?PHP
if(isset($listdata) && count($listdata) != 0){
  foreach ($listdata as $key => $value) {
    $Id = $value['regu_id'];
    $typeFile = $value['regu_type'];
    $Text_nameTH = $value['regu_name_th'];
    $Text_nameEN = $value['regu_name_en'];
    $File_regu = $value['regu_file'];
    $Text_sort = $value['regu_sort'];
    $Text_eye = $value['regu_show'];
    $Text_check = $value['regu_status'];
  }
  $TitlePage = "แก้ไขไฟล์";
  $actionUrl = site_url('manager/filecontent/update/');
}else{
  $TitlePage = "เพิ่มไฟล์";
  $actionUrl = site_url('manager/filecontent/create/');
  $Text_eye = 1;
  $Text_check = 1;
}

if($typeFile == 1){
	$title = "ไฟล์ข้อบังคับสมาคม";
}else{
	$title = "ไฟล์ขออนุญาตการแข่งขัน";
}
?>

<!-- Breadcrumb for page -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>
			<?=$TitlePage;?>
		</h2>
		<ol class="breadcrumb">
			<li>
				<a href="#">หน้าแรก</a>
			</li>
			<li>
				<a href="<?=site_url('manager/filecontent/index/'.$typeFile);?>">
					<?=$title?></a>
			</li>
			<li class="active">
				<strong>
					<?=$TitlePage;?></strong>
			</li>
		</ol>
	</div>
	<div class="col-lg-2">

	</div>
</div>
<!-- End breadcrumb for page -->

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<!-- Contents for page -->
			<div class="tabs-container">
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#tab-2" aria-expanded="false"><?=$title?></a></li>
					<div class="mail-tools tooltip-demo">
						<div class="btn-group pull-right">
							<button class="btn btn-white btn-sm btn-reload" data-toggle="tooltip" data-placement="left" title="" data-original-title="Refresh page"><i class="fa fa-refresh"></i> Refresh</button>
							<button class="btn btn-white btn-sm btn-eye" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mark as show">
								<?PHP if($Text_eye == 1){?>
								<i class="fa fa-eye"></i>
								<?PHP }else{ ?>
								<i class="fa fa-eye-slash"></i>
								<?PHP }?>
							</button>
							<button class="btn btn-white btn-sm btn-check" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mark as important">
								<?PHP if($Text_check == 1){?>
								<i class="fa fa-check-square-o"></i>
								<?PHP }else if($Text_check == 2){ ?>
								<i class="fa fa-check-square"></i>
								<?PHP }?>
							</button>
							<?PHP if(!empty($Id)){ ?>
							<button class="btn btn-white btn-sm Btn-delete" data-url="<?=site_url('manager/filecontent/delete/'.$Id);?>"><i class="fa fa-trash-o"></i> </button>
							<?PHP }?>
							<?PHP if(!empty($Id)){ ?>
							<button class="btn btn-warning btn-sm btn-url" data-url="<?=site_url(" uploads/fileregulation/".$File_regu);?>" data-toggle="tooltip" data-placement="left" title="" data-original-title="Preview this pages"><i class="fa fa-search"></i> Preview</button>
							<?PHP }?>
						</div>
					</div>
				</ul>

				<div class="tab-content">
					<div id="tab-2" class="tab-pane active">
						<div class="panel-body">
							<form action="<?=$actionUrl;?>" method="post" enctype="multipart/form-data" name="formFilecontent" id="formFilecontent" class="form-horizontal" novalidate>
								<input type="hidden" name="crffilecontent" id="crffilecontent" value="<?=$crffilecontent;?>">
								<input type="hidden" name="Text_eye" id="Text_eye" class="Text_eye" value="<?PHP if(isset($Text_eye)){echo $Text_eye;}?>">
								<input type="hidden" name="Id" id="Id" value="<?PHP if(isset($Id)){echo $Id;}?>">
								<input type="hidden" name="Text_check" id="Text_check" class="Text_check" value="<?PHP if(isset($Text_check)){echo $Text_check;}?>">
								<?PHP //if($typeFile != 1){?>
								<!--<div class="form-group"><label class="col-sm-2 control-label">ประเภทไฟล์<span class="text-muted">*</span></label>
									<div class="col-sm-10">
									<select name="Text_type" id="Text_type" tabindex="9" class="form-control">
										<option value="2" <?PHP if(isset($typeFile) && $typeFile == 2){echo 'selected';}?>>รายการขออนุญาตการแข่งขัน</option>
										<option value="3" <?PHP if(isset($typeFile) && $typeFile == 3){echo 'selected';}?>>หัวข้อหนังสือรับรอง</option>
										<option value="4" <?PHP if(isset($typeFile) && $typeFile == 4){echo 'selected';}?>>แบบรายงานตรวจสนามแข่งขัน</option>
									</select>
									</div>
								</div>-->
								<?PHP //}else{?>
								<input type="hidden" name="Text_type" id="Text_type" value="<?PHP if(isset($typeFile)){echo $typeFile;}?>">
								<?PHP //}?>
								<div class="form-group"><label class="col-sm-2 control-label">หัวข้อ(TH)<span class="text-muted">*</span></label>
									<div class="col-sm-10"><input type="text" name="Text_nameTH" id="Text_nameTH" class="form-control" value="<?PHP if(isset($Text_nameTH)){echo $Text_nameTH;}?>"></div>
								</div>
								<div class="form-group"><label class="col-sm-2 control-label">หัวข้อ(EN)</label>
									<div class="col-sm-10"><input type="text" name="Text_nameEN" id="Text_nameEN" class="form-control" value="<?PHP if(isset($Text_nameEN)){echo $Text_nameEN;}?>"></div>
								</div>
								<div class="form-group"><label class="col-sm-2 control-label">ไฟล์</label>
									<div class="col-sm-4">
										<input type="file" name="File_regu" id="File_regu" class="form-control">
										<input type="hidden" name="File_regu_old" id="File_regu_old" value="<?PHP if(isset($File_regu)){echo $File_regu;}?>">
									</div>
									<label class="col-sm-2 control-label">Sort</label>
									<div class="col-sm-4">
										<input type="text" name="Text_sort" id="Text_sort" class="form-control" value="<?PHP if(isset($Text_sort)){echo $Text_sort;}?>">
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-6 col-sm-offset-4">
										<a href="<?=site_url('manager/filecontent/index/'.$typeFile);?>">
											<button class="btn btn-w-m btn-danger" type="button">ยกเลิก</button>
										</a>
										<button class="btn btn-w-m btn-primary" type="submit">บันทึก</button>
									</div>
								</div>
							</form>
						</div>
					</div>

				</div>


			</div>
			<!-- End contents for page -->
		</div>
	</div>
</div>
