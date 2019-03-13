<?php
	if($typeFile == 1){
		$title = "ไฟล์ข้อบังคับสมาคม";
	}else{
		$title = "ไฟล์ขออนุญาตการแข่งขัน";
	}
?>
<!-- Breadcrumb for page -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?=$title;?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="#">หน้าแรก</a>
            </li>
            <li class="active">
                <strong><?=$title;?></strong>
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
      <div class="ibox float-e-margins">
          <div class="ibox-content">
              <!-- Contents for page -->
              <div class="row">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                  <a href="<?=site_url('manager/filecontent/form/'.$typeFile);?>">
                  <button class="btn btn-w-m btn-primary btn-sm pull-right">เพิ่มไฟล์</button>
                  </a>
                  <div class="input-group">
                    <input type="text" placeholder="Search" name="search-draw" id="search-draw" class="input-sm form-control">
                    <span class="input-group-btn">
                      <button type="button" id="btnsearch" class="btn btn-sm btn-primary"> ค้นหา</button>
                    </span>
                  </div>
                </div>
              </div>

              <div class="table-responsive">
                <?PHP if(count($listdata) != 0){ ?>
                <table class="table table-striped table-hover dataTables-example" >
                  <thead>
                  <tr>
                      <th style="width:10%;">#</th>
					  <th style="width:40%;">หัวข้อ</th>
					  <th style="width:15%;">เรียง</th>
                      <th style="width:15%;">แก้ไขล่าสุด</th>
                      <th style="width:10%;">จัดการ</th>
                      <th style="width:5%;"></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?PHP
                  foreach ($listdata as $key => $value) {
                  ?>
                  <tr class="gradeX">
                      <td><strong><?="FC".str_pad($value['regu_id'],5,"0",STR_PAD_LEFT);?></strong></td>
                      <td class="project-title">
                        <a href="<?=site_url("uploads/fileregulation/".$value['regu_file']);?>" target="_blank">
                          <?=character_limiter(strip_tags($value['regu_name_th']),30);?>
                        </a><br />
					  </td>
					  <td>
					  	<?=$value['regu_sort'];?>
					  </td>
                      <td>
                        <?=$value['regu_editby'];?><br />
                        <small class="text-muted"><i class="fa fa-clock-o"></i> <?=date('d/m/Y h:i A', strtotime($value['regu_lastedit']));?></small>
                      </td>
                      <td class="center">
                        <div class="btn-group">
                          <button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle" aria-expanded="false">Action <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                              <li><a href="<?=site_url('manager/filecontent/form/'.$typeFile."/".$value['regu_id']);?>"><i class="fa fa-pencil"></i> แก้ไข</a></li>
                              <li><a href="#" class="Btn-delete" data-url="<?=site_url('manager/filecontent/delete/'.$value['regu_id']);?>"><i class="fa fa-trash"></i> ลบ</a></li>
                            </ul>
                        </div>
                      </td>
                      <td class="center">
                        <?PHP if($value['regu_show'] == 1){?>
                          <span class="label label-primary">เปิด</span>
                        <?PHP }else{ ?>
                          <span class="label label-danger">ปิด</span>
                        <?PHP }?>
                      </td>
                  </tr>
                  <?PHP }?>

                  </tbody>
                </table>
                <?PHP }else{echo "No results found in this list.";}?>
              </div>

              <!-- End contents for page -->
          </div>
      </div>
    </div>
</div>
</div>
