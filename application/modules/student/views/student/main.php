<?php
  if($course == 1){ $course_status = '4ปีปกติ';}
  elseif($course == 2){$course_status = '4ปีเทียบโอน';}
?>
<!---------- 
  breadcrumb for page 
----------->
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>ข้อมูลนักศึกษา : <?=$dept_name;?> : <?=$course_status;?></h2>
    <ol class="breadcrumb">
      <li><a href="#">หน้าแรก</a></li>
      <li><a href="<?=site_url('student/student/indexdept/'.$fac_id);?>">สาขา</a></li>
      <li class="active"><strong>ข้อมูลนักศึกษา</strong></li>
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
  <div class="ibox-title"></div>
  <div class="ibox-content">
<!----------
  Contents for page 
----------->
<div class="row"><!-- add & search -->
<div class="col-sm-6">
<button class="btn btn-default btn-sm btnsubdel" data-url="<?=site_url('student/student/mutidelete/'.$dept_id.'/'.$course);?>"><i class="fa fa-trash"></i>&nbsp;&nbsp; ลบข้อมูล</button>
  <button class="btn btn-default btn-sm" id="btnexportS"><i class="fa fa-file-excel-o"></i>&nbsp;&nbsp; Excel</button>
</div>
<div class="col-sm-6">
  <button class="btn btn-w-m btn-default btn-sm pull-right" data-toggle="modal" data-target="#myModal">
    <span class="glyphicon glyphicon glyphicon-save-file" aria-hidden="true"></span>
    &nbsp;&nbsp;Import
  </button>
  <a href="<?=site_url('student/student/form/'.$dept_id.'/'.$course);?>"><!-- btn insert -->
    <button class="btn btn-w-m btn-default btn-sm pull-right">
      <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
      &nbsp;&nbsp;เพิ่มข้อมูล
    </button>
  </a>
  <div class="input-group"><!-- search table -->
      <input type="text" placeholder="Search" name="search-draw" id="search-drawS" class="input-sm form-control">
      <span class="input-group-btn">
        <button type="button" id="btnsearchS" class="btn btn-sm btn-primary"> ค้นหา</button>
      </span>
  </div>
</div>
</div><!-- end add & search -->

<?PHP if(count($liststudent) != 0){ ?>
<form action="" method="post" enctype="multipart/form-data" name="formMuti" id="formMuti" class="form-horizontal" validate>
<table class="table table-striped table-hover dataTables-exampleS" width="100%">
  <thead>
    <tr>
      <th width="15%">
      <div class="checkbox">
        <label>
          <input type="checkbox" name="checkall" id="checkall">
        </label>
      </div>
      </th>
      <th width="10%">คำนำหน้า</th>
      <th width="20%">ชื่อ - นามสกุล</th>
      <th width="10%">เพศ</th>
      <th width="10%">หลักสูตร</th>
      <th width="20%">สาขา</th>
      <th width="10%"></th>
      <th width="5%">status</th>
    </tr>
  </thead>
  <tbody>
  <?PHP
    foreach ($liststudent as $key => $value) { 
      if($value['course_status'] == 1){ $course_status = '4 ปีปกติ'; }
      elseif($value['course_status'] == 2){ $course_status = '4 เทียบโอน'; }
  ?>
    <tr class="gradeX">
      <td width="15%">
      <div class="checkbox">
        <label>
          <input type="checkbox" value="<?=$value['student_id'];?>" class="item" name="select[]" id="select">
          &nbsp;&nbsp;&nbsp;<strong><?=$value['student_id'];?></strong>
        </label>
      </div>
      </td>
      <td width="10%" class="project-title"><?=$value['name_title'];?></td>
      <td width="20%"><?=$value['student_fname'];?> <?=$value['student_lname'];?></td>
      <td width="10%"><?=$value['sex_name'];?></td>
      <td width="10%"><?=$course_status;?></td>
      <td width="20%"><?=$value['dept_name'];?></td>
      <td width="10%"><!--- Action --->
      <a href="<?=site_url('student/student/form/'.$value['dept_id'].'/'.$value['course_status'].'/'.$value['student_id']);?>">
        <button class="btn btn-block btn-sm btn-default" type="button">แก้ไขข้อมูล</button>
      </a>
      </td><!--- end Action --->
      <td width="5%">
        <center>
        <?
        $this->db->select("*");
        $this->db->where(array('student_id' => $value['student_id'], 'orders_delete_status' => 1, 'orders_type' => 1));
        $query = $this->db->get('tb_orders');
        $liststatus = $query->result_array();

        if(count( $liststatus) != 0){ ?>
        <span class="badge badge-success badge-sm">Ordered</span>
        <? } else { ?>
          <span class="badge badge-danger badge-sm">Nope</span>
        <? } ?>
        </center>
      </td>
    </tr>
  <?PHP } ?>
  </tbody>
</table>
</form>
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

<!-- modal -->
  <div class="modal fade bs-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">IMPORT FILE</h4>
        </div>
        <form action="<?=site_url('student/student/import');?>" method="post" enctype="multipart/form-data" name="formImport" id="formImport" class="form-horizontal" novalidate>
        <div class="modal-body">
          <input type="hidden" name="dept_id" id="dept_id" value="<?=$dept_id;?>">
          <input type="hidden" name="course_status" id="course_status" value="<?=$course;?>">
          <input type="file" class="form-control" name="csv_file" id="csv_file" require accept=".csv">
          <hr>
          <center>
            <a href="<?=site_url('uploads/manual/format-csv.csv');?>" target="_blank"><u>format file CSV สำหรับนำเข้าข้อมูล</u></a>
          </center>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
          <button type="submit" class="btn btn-primary" id="csv-submit">ตกลง</button>
        </div>
        </form>
      </div>
    </div>
  </div>