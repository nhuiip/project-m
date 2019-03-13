<!----------
  breadcrumb for page
----------->
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>ข้อมูลคณะ</h2>
    <ol class="breadcrumb">
      <li><a href="#">หน้าแรก</a></li>
      <li class="active"><strong>ข้อมูลคณะ</strong></li>
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
<div class="col-sm-6"></div>
<div class="col-sm-6">
  <a href="<?=site_url('faculty/faculty/form');?>"><!-- btn insert -->
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

<?PHP if(count($listfac) != 0){ ?>
<table class="table table-striped table-hover dataTables-example" width="100%">
  <thead>
    <tr>
      <th width="5%">#</th>
      <th width="10%">รหัสคณะ</th>
      <th width="60%">ชื่อคณะ</th>
      <th width="10%">จัดการ</th>
      <th width="15%">แก้ไขล่าสุด</th>
    </tr>
  </thead>  
  <tbody>
  <?PHP
    $numrow = 1;
    foreach ($listfac as $key => $value) {
  ?>
    <tr class="gradeX">
      <td width="5%"><strong><?=$numrow;?></strong></td>
      <td width="10%"><strong><?="FAC".str_pad($value['fac_id'],3,"0",STR_PAD_LEFT);?></strong></td>
      <td width="60%" class="project-title"><?=$value['fac_name'];?></td>
      <td width="10%"><!--- Action --->
        <div class="btn-group" style="width:100%">
          <button class="btn btn-sm btn-default " type="button" style="width:70%">Action</button>
          <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:30%;">
              <span class="caret"></span>
              <span class="sr-only">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu" style="width:30%">
              <li><a href="<?=site_url('faculty/faculty/form/'.$value['fac_id']);?>"><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;แก้ไขข้อมูล</a></li>
              <li><a href="#" class="btn-checkdelete" data-url="<?=site_url('faculty/faculty/delete/'.$value['fac_id']);?>" data-urlCheck="<?=site_url('faculty/faculty/checkdelete/'.$value['fac_id']);?>"><i class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;ลบข้อมูล</a></li>
          </ul>
        </div>
      </td><!--- end Action --->
      <td width="15%"><!--- lastedit --->
        <?=$value['fac_lastedit_name'];?><br /> 
        <small class="text-muted">
          <i class="fa fa-clock-o"></i>
          <?=date('d/m/Y h:i A', strtotime($value['fac_lastedit_date']));?>
        </small>
      </td><!--- end lastedit --->
    </tr>
  <?PHP $numrow++ ; } ?>
  </tbody>
</table>
<?php } else { ?>
  <hr>
  <center><p style="color:#95a5a6;">"No results found in this list."</p><center>
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
