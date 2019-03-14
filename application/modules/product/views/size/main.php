<?php 
  $status1 = 1;
  $status2 = 2;
?>
<!---------- 
  breadcrumb for page 
----------->
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>ข้อมูลขนาดเครื่องแบบ</h2>
    <ol class="breadcrumb">
      <li><a href="#">หน้าแรก</a></li>
      <li class="active"><strong>ข้อมูลขนาดเครื่องแบบ</strong></li>
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
  Contents for page 
----------->
<div class="col-sm-6"><!-- เสื้อ -->
<div class="ibox float-e-margins">
  <div class="ibox-title">
    <h5>เสื้อ</h5>
  </div>
  <div class="ibox-content">

    <div class="row"><!-- add & search -->
      <div class="col-sm-12">
        <a href="<?=site_url('product/size/form/'.$status1);?>"><!-- btn insert -->
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

    <?PHP if(count($listsize1) != 0){ ?>
    <table class="table table-striped table-hover dataTables-example" width="100%">
      <thead>
        <tr>
          <th width="5%">#</th>
          <th width="15%">รหัส</th>
          <th width="25%">ขนาด</th>
          <th width="20%">จัดการ</th>
          <th width="35%">แก้ไขล่าสุด</th>
        </tr>
      </thead>
      <tbody>
      <?PHP
        $numrows = 1;
        foreach ($listsize1 as $key => $value) { 
      ?>
        <tr class="gradeX">
          <td width="5%"><strong><?=$numrows;?></strong></td>
          <td width="15%"><strong><?="SIZE".str_pad($value['size_id'],3,"0",STR_PAD_LEFT);?></strong></td>
          <td width="25%" class="project-title"><?=$value['size_name'];?></td>
          <td width="20%"><!--- Action --->
            <div class="btn-group" style="width:100%">
              <button class="btn btn-sm btn-default " type="button" style="width:70%">Action</button>
              <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:30%;">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
              </button>
              <ul class="dropdown-menu" style="width:30%">
                  <li><a href="<?=site_url('product/size/form/'.$value['size_status'].'/'.$value['size_id']);?>"><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;แก้ไขข้อมูล</a></li>
                  <li><a href="#" class="btn-checkdelete" data-url="<?=site_url('product/size/delete/'.$value['size_id']);?>" data-urlCheck="<?=site_url('product/size/checkdelete/'.$value['size_id']);?>"><i class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;ลบข้อมูล</a></li>
              </ul>
            </div>
          </td><!--- end Action --->
          <td width="35%"><!--- lastedit --->
            <?=$value['size_lastedit_name'];?><br />
            <small class="text-muted">
              <i class="fa fa-clock-o"></i> 
              <?=date('d/m/Y h:i A', strtotime($value['size_lastedit_date']));?>
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

  </div>
</div>
</div><!-- end -->

<div class="col-sm-6"><!-- กางเกง/กระโปรง -->
<div class="ibox float-e-margins"><!-- no size -->
  <div class="ibox-title">
    <h5>กางเกง / กระโปรง</h5>
  </div>
  <div class="ibox-content">

    <div class="row"><!-- add & search -->
      <div class="col-sm-12">
        <a href="<?=site_url('product/size/form/'.$status2);?>"><!-- btn insert -->
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

    <?PHP if(count($listsize2) != 0){ ?>
    <table class="table table-striped table-hover dataTables-example" width="100%">
      <thead>
        <tr>
          <th width="5%">#</th>
          <th width="15%">รหัส</th>
          <th width="25%">ขนาด</th>
          <th width="20%">จัดการ</th>
          <th width="35%">แก้ไขล่าสุด</th>
        </tr>
      </thead>
      <tbody>
      <?PHP
        $numrows = 1;
        foreach ($listsize2 as $key => $value) { 
      ?>
        <tr class="gradeX">
          <td width="5%"><strong><?=$numrows;?></strong></td>
          <td width="15%"><strong><?="SIZE".str_pad($value['size_id'],3,"0",STR_PAD_LEFT);?></strong></td>
          <td width="25%" class="project-title"><?=$value['size_name'];?></td>
          <td width="20%"><!--- Action --->
            <div class="btn-group" style="width:100%">
              <button class="btn btn-sm btn-default " type="button" style="width:70%">Action</button>
              <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:30%;">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
              </button>
              <ul class="dropdown-menu" style="width:30%">
                  <li><a href="<?=site_url('product/size/form/'.$value['size_status'].'/'.$value['size_id']);?>"><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;แก้ไขข้อมูล</a></li>
                  <li><a href="#" class="btn-checkdelete" data-url="<?=site_url('product/size/delete/'.$value['size_id']);?>" data-urlCheck="<?=site_url('product/size/checkdelete/'.$value['size_id']);?>"><i class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;ลบข้อมูล</a></li>
              </ul>
            </div>
          </td><!--- end Action --->
          <td width="35%"><!--- lastedit --->
            <?=$value['size_lastedit_name'];?><br />
            <small class="text-muted">
              <i class="fa fa-clock-o"></i> 
              <?=date('d/m/Y h:i A', strtotime($value['size_lastedit_date']));?>
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

  </div>
</div>
</div><!-- end -->

<!---------- 
  end contents for page 
----------->

</div><!-- /col12 -->
</div><!-- /row -->
</div><!-- /wrapper -->
<div style="margin:10px 0px;">.</div>
