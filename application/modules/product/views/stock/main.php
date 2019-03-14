<?PHP
$type = $typeproduct;
if($type == 1){
  $pagetitle = 'ข้อมูลเครื่องแบบ';
} elseif ($type == 2) {
  $pagetitle = 'ข้อมูลเครื่องหมายและอุปกรณ์';
}
if(isset($listproduct) && count($listproduct) != 0){
  foreach ($listproduct as $key => $value) {
    $product_id	  = $value['product_id'];
    $product_name = $value['product_name'];
  }
}
$error = "s";
?>
<!----------
  breadcrumb for page
----------->
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2><strong>STOCK:</strong> <?=$product_name?></h2>
    <ol class="breadcrumb">
      <li><a href="#">หน้าแรก</a></li>
      <li><a href="<?=site_url('product/product/index/'.$type);?>"><?=$pagetitle;?></a></li>
      <li class="active"><strong>STOCK: <?=$product_name?></strong></li>
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
  <div class="ibox-title">

  </div>
  <div class="ibox-content">
<!----------
  Contents for page
----------->
<div class="row"><!-- add & search -->
<div class="col-sm-6"></div>
<div class="col-sm-6">
  <a href="<?=site_url('product/stock/form/'.$type.'/'.$product_id);?>"><!-- btn insert -->
    <button class="btn btn-w-m btn-default btn-sm pull-right">
      <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
      &nbsp;&nbsp;เพิ่มรายการ
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

<?PHP if(count($liststock) != 0){ ?>
<table class="table table-striped table-hover dataTables-example" width="100%">
  <thead>
    <tr>
      <th width="5%">#</th>
      <th width="50%">รายการ</th>
      <th width="10%">Size</th>
      <th width="10%">จำนวน</th>
      <th width="10%">จัดการ</th>
      <th width="15%">แก้ไขล่าสุด</th>
    </tr>
  </thead>
  <tbody>
  <?PHP
    $numrows = 1;
    foreach ($liststock as $key => $value) {
  ?>
    <tr class="gradeX">
      <td width="5%"><strong><?=$numrows;?></strong></td>
      <td width="50%" class="project-title"><?=$value['product_name'];?></td>
      <td width="10%" class="project-title"><?=$value['size_name'];?></td>
      <td width="10%" class="project-title">
        <? if($value['amount'] <= 50) { ?>
          <b style="color: #FF0000"><?=$value['amount']?></b>
        <? } else { ?>
          <?=$value['amount']?>
        <? } ?>
      </td>
      <td width="10%"><!--- Action --->
        <div class="btn-group" style="width:100%">
          <button class="btn btn-sm btn-default " type="button" style="width:70%">Action</button>
          <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:30%;">
              <span class="caret"></span>
              <span class="sr-only">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu" style="width:30%">
              <li><a href="<?=site_url('product/stock/form/'.$type.'/'.$value['product_id'].'/'.$value['size_id']);?>"><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;แก้ไขข้อมูล</a></li>
              <li><a href="#" class="btn-delete" data-url="<?=site_url('product/stock/delete/'.$type.'/'.$value['product_id'].'/'.$value['size_id']);?>"><i class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;ลบข้อมูล</a></li>
          </ul>
        </div>
      </td><!--- end Action --->
      <td width="15%"><!--- lastedit --->
        <?=$value['lastedit_name'];?><br />
        <small class="text-muted">
          <i class="fa fa-clock-o"></i>
          <?=date('d/m/Y h:i A', strtotime($value['lastedit_date']));?>
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
