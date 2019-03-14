<?
if($type == 1){
  $title = 'ข้อมูลใบสั่งซื้อ: บังคับซื้อ';
} else {
  $title = 'ข้อมูลใบสั่งซื้อ: สั่งซื้อเพิ่มเติม';
}
?>
<!----------
  breadcrumb for page
----------->
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2><?=$title;?></h2>
    <ol class="breadcrumb">
      <li><a href="#">หน้าแรก</a></li>
      <li class="active"><strong><?=$title;?></strong></li>
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
<div class="ibox float-e-margins"><!-- have size -->
  <div class="ibox-title"></div>
  <div class="ibox-content">
<!----------
  Contents for page
----------->
<div class="row"><!-- add & search -->
<div class="col-sm-8">
  <button class="btn btn-default btn-sm btnsubdel" data-url="<?=site_url('orders/orders/mutidelete/'.$type);?>"><i class="fa fa-trash"></i>&nbsp;&nbsp; ลบข้อมูล</button>
  <button class="btn btn-default btn-sm btnsubatv" data-url="<?=site_url('orders/orders/mutiactivate/'.$type);?>"><i class="fa fa-check"></i>&nbsp;&nbsp; รับของแล้ว</button>
  <button class="btn btn-default btn-sm" id="btnexportB"><i class="fa fa-file-excel-o"></i>&nbsp;&nbsp; Excel</button>
  <button class="btn btn-default btn-sm" id="btnprintB"><i class="fa fa-print"></i>&nbsp;&nbsp; Print</button>
</div>
<div class="col-sm-4">
  <div class="input-group"><!-- search table -->
      <input type="text" placeholder="Search" name="search-draw" id="search-drawB" class="input-sm form-control">
      <span class="input-group-btn">
        <button type="button" id="btnsearchB" class="btn btn-sm btn-primary"> ค้นหา</button>
      </span>
  </div>
</div>
</div><!-- end add & search -->

<?PHP if(count($listOders) != 0){ ?>
<form action="" method="post" enctype="multipart/form-data" name="formMuti" id="formMuti" class="form-horizontal" validate>
<table class="table table-striped table-hover dataTables-exampleB" width="100%">
  <thead>
    <tr>
      <th width="5%">
      <div class="checkbox">
        <label>
          <input type="checkbox" name="checkall" id="checkall">
        </label>
      </div>
      </th>
      <th width="15%">รหัสใบสั่งซื้อ</th>
      <th width="10%">รหัสนักศึกษา</th>
      <th width="5%"></th>
      <th width="15%">ชื่อ-นามสกุล</th>
      <th width="15%">คณะ</th>
      <th width="15%">สาขา</th>
      <th width="5%">หลักสูตร</th>
      <th width="10%">จัดการ</th>
      <th width="5%">สถานะ</th>
    </tr>
  </thead>  
  <tbody>
  <?PHP
    $numrow = 1;
    foreach ($listOders as $key => $value) {
  ?>
    <tr class="gradeX">
        <td width="5%">
        <div class="checkbox">
          <label>
            <input type="checkbox" value="<?=$value['orders_id'];?>" class="item" name="select[]" id="select">
            <input type="hidden" value="<?=$value['orders_status'];?>" name="orders_status[]" id="orders_status">
          </label>
        </div>
        </td>
        <td width="15%"><?=$value['orders_number'];?></td>
        <td width="10%" class="project-title"><?=$value['student_id'];?></td>
        <td width="5%" class="project-title"><?=$value['name_title'];?></td>
        <td width="15%" class="project-title">
          <?=$value['student_fname'].' '.$value['student_lname'];?>
        </td>
        <td width="15%" class="project-title">
          <!-- คณะ/สาขา -->
          <?
            $this->db->select("*");
            $this->db->from('tb_department');	
            $this->db->join('tb_faculty', 'tb_faculty.fac_id = tb_department.fac_id');
            $this->db->where(array('tb_department.dept_id' => $value['dept_id']));
            $query = $this->db->get();
            $listsize = $query->result_array();

            echo $listsize[0]['fac_name'];
          ?>
        </td>
        <td width="15%" class="project-title"><?=$listsize[0]['dept_name'];?></td>
        <td width="5%" class="project-title">
          <? 
          if($value['course_status'] == 1){
            echo '4ปีปกติ';
          } elseif($value['course_status'] == 2){
            echo '4ปีเทียบโอน';
          }
          ?>
        </td>
        <td width="10%"><!--- Action --->
            <div class="btn-group" style="width:100%">
            <button class="btn btn-sm btn-default " type="button" style="width:70%">Action</button>
            <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:30%;">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" style="width:30%">
                <li><a href="<?=site_url('orders/detailorders/index/'.$value['orders_id'].'/'.$type);?>"><i class="fa fa-list"></i>&nbsp;&nbsp;&nbsp;รายละเอียด</a></li>
                <li><a href="#" class="btn-activate" data-url="<?=site_url('orders/orders/activate/'.$value['orders_id'].'/'.$value['orders_status'].'/'.$type);?>"><i class="fa fa-check"></i>&nbsp;&nbsp;&nbsp;รับของแล้ว</a></li>
                <li><a href="#" class="btn-delete" data-url="<?=site_url('orders/orders/delete/'.$value['orders_id'].'/'.$type);?>"><i class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;ลบข้อมูล</a></li>
            </ul>
            </div>
        </td><!--- end Action --->
        <td width="5%"><!--- lastedit --->
            <? if($value['orders_status'] == 1){ ?>
                <span class="badge badge-warning">warning</span>
            <? } else { ?>
                <span class="badge badge-success">success</span>
            <? } ?>
        </td><!--- end lastedit --->
    </tr>
  <?PHP $numrow++ ; } ?>
  </tbody>
  
</table>
</form>
<?php } else { ?>
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
