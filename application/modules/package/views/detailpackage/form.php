<!----------
  request data db
----------->
<?php $actionUrl = site_url('package/detailpackage/update'); ?>
<!----------
  breadcrumb for page
----------->
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2><?=$dept_name.' : '.$sex_name.' : '.$course_status;?></h2>
    <ol class="breadcrumb">
      <li><a href="#">หน้าแรก</a></li>
      <li><a href="<?=site_url('package/package/index/'.$dept_id);?>">เซตเครื่องแบบ</a></li>
      <li class="active">จัดการเซตเครื่องแบบ</li>
    </ol>
  </div>
</div>
<!----------
  end breadcrumb for page
----------->
<div class="wrapper wrapper-content animated fadeInRight" style="padding: 20px 0px;">
<div class="row">
<!----------
  Contents for page
----------->
  <div class="ibox-content">
  <div class="row"><!-- add & search -->
    <div class="col-sm-8"></div>
    <div class="col-sm-4">
      <div class="input-group"><!-- search table -->
          <input type="text" placeholder="Search" name="search-draw" id="search-drawT" class="input-sm form-control">
          <span class="input-group-btn">
            <button type="button" id="btnsearchT" class="btn btn-sm btn-primary"> ค้นหา</button>
          </span>
      </div>
    </div>
  </div><!-- end add & search -->
  <?PHP if(count($listdetailpackage) != 0){ ?>
  <hr>
  <table class="table table-striped table-hover dataTables-total" width="100%">
  <thead>
    <tr>
      <th width="10%">#</th>
      <th width="25%">รายการ</th>
      <th width="10%">ราคา</th>
      <th width="10%"><center>จำนวน</center></th>
      <th width="15%">แก้ไขล่าสุด</th>
      <th width="10%"></th>
      <th width="10%"></th>
      <th width="10%">ราคารวม</th>

    </tr>
  </thead>
  <tbody>
    <? $numrows = 1; foreach ($listdetailpackage as $key => $value) { ?>
    <tr>
      <td width="10%"><?=$numrows;?></td>
      <td width="25%"><?=$value['product_name'];?></td>
      <td width="10%"><?=number_format($value['product_price']);?></td>
      <td width="10%"><center><?=$value['pieces'];?></center></td>
      <td width="15%"><!--- lastedit --->
        <?=$value['detail_lastedit_name'];?><br />
        <small class="text-muted">
          <i class="fa fa-clock-o"></i>
          <?=date('d/m/Y h:i A', strtotime($value['detail_lastedit_date']));?>
        </small>
      </td><!--- end lastedit --->
      <td width="10%">
        <a class="edit"
        data-pack = "<?=$value['pack_id'];?>"
        data-product = "<?=$value['product_id'];?>"
        data-pieces = "<?=$value['pieces'];?>" data-toggle="modal" data-target="#myModal">
        <button class="btn btn-sm btn-default">
          แก้ไขจำนวน
        </button>
        </a>
      </td>
      <td width="10%">
        <button class="btn btn-sm btn-danger btn-delete" data-url="<?=site_url('package/detailpackage/deleteData/'.$pack_id.'/'.$value['product_id']);?>">
          ลบข้อมูล
        </button>
      </td>
      <td width="20%"><?=$value['total_price'];?></td>
    </tr>
    <?PHP $numrows++; }?>
    </tbody>
    <tfoot style="border-top: 1px double #333;">
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th style="font-size: 20px;">ราคารวม</th>
      <th style="font-size: 20px;color: #FF0000;"></th>
    </tfoot>
  </table>
  <?php } else { ?>
  <hr>
  <center><p style="color:#95a5a6;">"No results found in this list."</p><center>
  <?php } ?>
  </div><!--/ibox-content-->
  <hr>
  <div class="row">

  <div class="col-sm-4">
  <div class="ibox float-e-margins">
  <div class="ibox-title">
    <b>เครื่องแบบ</b>

  </div>
  <div class="ibox-content">

  <table class="table table-striped table-hover dataTables-package" width="100%">
    <thead>
    <tr>
      <th width="80%">รายการ</th>
      <th width="20%"></th>
    </tr>
    </thead>
    <tbody>
    <? foreach ($listproduct1 as $key => $value) { ?>
    <tr>
      <td width="80%"><?=$value['product_name'];?></td>
      <td width="20%">
      <button class="btn btn-sm btn-block btn-default btn-choose" data-urlCheck ="<?=site_url('package/detailpackage/checkchoose/'.$pack_id.'/'.$value['product_id']);?>" data-url="<?=site_url('package/detailpackage/choose/'.$pack_id.'/'.$value['product_id']);?>">เลือก</button>
      </td>
    </tr>
    <? } ?>
    </tbody>
  </table>

  </div><!--/ibox-content-->
  </div><!--/ibox float-e-margins-->
  </div><!--/col-sm-4-->

  <div class="col-sm-4">

      <div class="ibox float-e-margins">
      <div class="ibox-title">
        <b>อุปกรณ์</b>
      </div>
      <div class="ibox-content">

      <table class="table table-striped table-hover dataTables-package" width="100%">
        <thead>
        <tr>
          <th width="80%">รายการ</th>
          <th width="20%"></th>
        </tr>
        </thead>
        <tbody>
        <? foreach ($listproduct2 as $key => $value) { ?>
        <tr>
          <td width="80%"><?=$value['product_name'];?></td>
          <td width="20%">
              <button class="btn btn-sm btn-block btn-default btn-choose" data-urlCheck ="<?=site_url('package/detailpackage/checkchoose/'.$pack_id.'/'.$value['product_id']);?>" data-url="<?=site_url('package/detailpackage/choose/'.$pack_id.'/'.$value['product_id']);?>">เลือก</button>
          </td>
        </tr>
        <? } ?>
        </tbody>
      </table>

      </div><!--/ibox-content-->
      </div><!--/ibox float-e-margins-->
      </div><!--/col-sm-4-->

      <div class="col-sm-4">
        <div class="ibox float-e-margins">
        <div class="ibox-title"><b>ค่าใช้จ่าย</b></div>
        <div class="ibox-content">

        <table class="table table-striped table-hover dataTables-package" width="100%">
          <thead>
          <tr>
            <th width="80%">รายการ</th>
            <th width="20%"></th>
          </tr>
          </thead>
          <tbody>
          <? foreach ($listproduct3 as $key => $value) { ?>
          <tr>
            <td width="80%"><?=$value['product_name'];?></td>
            <td width="20%">
                <button class="btn btn-sm btn-block btn-default btn-choose" data-urlCheck ="<?=site_url('package/detailpackage/checkchoose/'.$pack_id.'/'.$value['product_id']);?>" data-url="<?=site_url('package/detailpackage/choose/'.$pack_id.'/'.$value['product_id']);?>">เลือก</button>
            </td>
          </tr>
          <? } ?>
          </tbody>
        </table>

        </div><!--/ibox-content-->
        </div><!--/ibox float-e-margins-->
        </div><!--/col-sm-4-->

</div><!--/row-->

<!----------
  model edit
----------->
<script>
$('.edit').click(function(){
// รับค่าจากปุ่ม
var pack = $(this).attr('data-pack');
var product = $(this).attr('data-product');
var pieces = $(this).attr('data-pieces');
// ส่งค่าไป model
$("#pack_id").val(pack);
$("#product_id").val(product);
$("#pieces").val(pieces);
});
</script>
<div class="modal fade bs-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">แก้ไขจำนวน</h4>
      </div>
      <form action="<?=$actionUrl?>" method="post" enctype="multipart/form-data" name="formEditpieces" id="formEditpieces" class="form-horizontal" novalidate>
      <div class="modal-body">
        <input type="hidden" name="pack_id" id="pack_id">
        <input type="hidden" name="product_id" id="product_id">
        <input type="number" class="form-control" name="pieces" id="pieces">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
        <button type="submit" class="btn btn-primary">ตกลง</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!----------
  end contents for page
----------->
</div><!-- /row -->
</div><!-- /wrapper -->
