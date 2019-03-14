<!---------- 
  breadcrumb for page 
----------->
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>เซตเครื่องแบบ</h2>
    <ol class="breadcrumb">
      <li><a href="#">หน้าแรก</a></li>
      <li><a href="<?=site_url('package/package/indexdept/'.$facid);?>">สาขา</a></li>
      <li class="active"><strong>เซตเครื่องแบบ</strong></li>
    </ol>
  </div>
</div>
<!----------
  end breadcrumb for page 
----------->
<div class="wrapper wrapper-content animated fadeInRight" style="padding: 20px 0px;">
<div class="row">
<div class="col12" id="boxs-consfix"> 
<!----------
  Contents for box 
----------->
<div class="ibox float-e-margins">
  <div class="ibox-title">

  </div>
  <div class="ibox-content">
<!----------
  Contents for page 
----------->
<div class="row"><!-- add & search -->
<div class="col-sm-6"></div>
<div class="col-sm-6">
  <a href="<?=site_url('package/package/form/'.$deptid);?>"><!-- btn insert -->
    <button class="btn btn-w-m btn-default btn-sm pull-right">
      <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
      &nbsp;&nbsp;เพิ่มข้อมูล
    </button>
  </a>
  <div class="input-group"><!-- search table -->
      <input type="text" placeholder="Search" name="search-draw" id="search-draw" class="input-sm form-control">
      <span class="input-group-btn">
        <button type="button" id="btnsearch" class="btn btn-sm btn-primary"> ค้นหา</button>
      </span>
  </div>
</div>
</div><!-- end add & search -->

<?PHP if(count($listpackage) != 0){ ?>
<table class="table table-striped table-hover dataTables-example" width="100%">
  <thead>
    <tr>
      <th width="5%">#</th>
      <th width="10%">รหัส</th>
      <th width="35%">สาขา</th>
      <th width="10%">เพศ</th>
      <th width="10%">หลักสูตร</th>
      <th width="10%"></th>
      <th width="15%">แก้ไขล่าสุด</th>
    </tr>
  </thead>
  <tbody>
  <?PHP
    $numrows = 1;
    foreach ($listpackage as $key => $value) { 
      if($value['course_status'] == 1){ $course_status = '4 ปีปกติ'; }
      elseif($value['course_status'] == 2){ $course_status = '4 เทียบโอน'; }
  ?>
    <tr class="gradeX">
      <td width="5%"><strong><?=$numrows;?></strong></td>
      <td width="10%"><strong><?="PACK".str_pad($value['pack_id'],3,"0",STR_PAD_LEFT);?></strong></td>
      <td width="35%" class="project-title"><?=$value['dept_name'];?></td>
      <td width="10%"><?=$value['sex_name'];?></td>
      <td width="10%"><?=$course_status;?></td>
      <td width="10%"><!--- Action --->
      <div class="btn-group" style="width:100%">
          <button class="btn btn-sm btn-default " type="button" style="width:70%">Action</button>
          <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:30%;">
              <span class="caret"></span>
              <span class="sr-only">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu" style="width:30%">
              <li><a href="<?=site_url('package/detailpackage/form/'.$value['pack_id']);?>"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;จัดเซต</a></li>
              <li><a href="<?=site_url('package/package/form/'.$deptid.'/'.$value['pack_id']);?>"><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;แก้ไขข้อมูล</a></li>
              <li><a href="#" class="btn-delete" data-url="<?=site_url('package/package/delete/'.$value['pack_id'].'/'.$value['dept_id']);?>"><i class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;ลบข้อมูล</a></li>
          </ul>
        </div>
      </td><!--- end Action --->
      <td width="15%"><!--- lastedit --->
        <?=$value['dept_lastedit_name'];?><br />
        <small class="text-muted">
          <i class="fa fa-clock-o"></i> 
          <?=date('d/m/Y h:i A', strtotime($value['dept_lastedit_date']));?>
        </small>
      </td><!--- end lastedit --->
    </tr>
  <?PHP $numrows++; }?>
  </tbody>
</table>
<?php }else{ ?>
  <hr>
  <center><p style="color:#95a5a6;">"ไม่พบข้อมูลในรายการนี้"</p><center>
<?php } ?>
</div><!-- /ibox-content -->
</div><!-- /ibox float-e-margins -->
<!---------- 
  end contents for page 
----------->
</div><!-- /col12 -->
</div><!-- /row -->
</div><!-- /wrapper -->
<div style="margin:10px 0px;">.</div>