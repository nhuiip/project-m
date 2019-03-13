<!---------- 
  breadcrumb for page 
----------->
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>ข้อมูลนักศึกษา: คณะ</h2>
    <ol class="breadcrumb">
      <li><a href="#">หน้าแรก</a></li>
      <li class="active"><strong>ข้อมูลนักศึกษา: คณะ</strong></li>
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

<?PHP if(count($listfac) != 0){ ?>
<table class="table table-striped table-hover dataTables-example" width="100%">
  <thead>
    <tr>
      <th width="5%">#</th>
      <th width="75%">ชื่อคณะ</th>
      <th width="5%">สาขา</th>
      <th width="15%">แก้ไขล่าสุด</th>
    </tr>
  </thead>
  <tbody>
  <?PHP
    $numrows = 1;
    foreach ($listfac as $key => $value) { 
  ?>
    <tr class="gradeX">
      <td width="5%"><strong><?=$numrows;?></strong></td>
      <td width="75%" class="project-title"><?=$value['fac_name'];?></td>
      <td width="5%"><!--- Action --->
      <a href="<?=site_url('student/student/indexdept/'.$value['fac_id']);?>">
        <span class="badge" style="width:100%;text-align:center">สาขา</span>
      </a>  
      </td><!--- end Action --->
      <td width="15%"><!--- lastedit --->
        <?=$value['fac_lastedit_name'];?><br />
        <small class="text-muted">
          <i class="fa fa-clock-o"></i> 
          <?=date('d/m/Y h:i A', strtotime($value['fac_lastedit_date']));?>
        </small>
      </td><!--- end lastedit --->
    </tr>
  <?PHP $numrows++; }?>
  </tbody>
</table>
<?php }else{ ?>
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