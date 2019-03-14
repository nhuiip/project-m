<!---------- 
  breadcrumb for page 
----------->
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>จัดเซตเครื่องแบบ: สาขา</h2>
    <ol class="breadcrumb">
      <li><a href="#">หน้าแรก</a></li>
      <li><a href="<?=site_url('package/package/indexfac');?>">คณะ</a></li>
      <li class="active"><strong>จัดเซตเครื่องแบบ: สาขา</strong></li>
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
<div class="col-sm-8"></div>
<div class="col-sm-4">
  <div class="input-group"><!-- search table -->
      <input type="text" placeholder="Search" name="search-draw" id="search-draw" class="input-sm form-control">
      <span class="input-group-btn">
        <button type="button" id="btnsearch" class="btn btn-sm btn-primary"> ค้นหา</button>
      </span>
  </div>
</div>
</div><!-- end add & search -->

<?PHP if(count($listdept) != 0){ ?>
<table class="table table-striped table-hover dataTables-example" width="100%">
  <thead>
    <tr>
      <th width="5%">#</th>
      <th width="65%">ชื่อสาขา</th>
      <th width="15%"></th>
      <th width="15%">แก้ไขล่าสุด</th>
    </tr>
  </thead>
  <tbody>
  <?PHP
    $numrows = 1;
    foreach ($listdept as $key => $value) { 
  ?>
    <tr class="gradeX">
      <td width="5%"><strong><?=$numrows;?></strong></td>
      <td width="65%" class="project-title"><?=$value['dept_name'];?></td>
      <td width="15%"><!--- Action --->
      <a href="<?=site_url('package/package/index/'.$value['dept_id']);?>">
        <span class="badge" style="width:100%;text-align:center">จัดการเซตเครื่องแบบ</span>
      </a>  
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