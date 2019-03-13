<!----------
  request data db
----------->
<?PHP
if(isset($listproduct) && count($listproduct) != 0){
  foreach ($listproduct as $key => $value) {
    $Id             = $value['product_id'];
    $product_name   = $value['product_name'];
    $product_price	= $value['product_price'];
    $type_id        = $value['type_id'];
}
    if($type_id == 1){
      $pageback = 'ข้อมูลเครื่องแบบ';
      $TitlePage = 'แก้ไขข้อมูลเครื่องแบบ';
    } elseif ($type_id == 2) {
      $pageback = 'ข้อมูลเครื่องหมายและอุปกรณ์';
      $TitlePage = 'แก้ไขข้อมูลเครื่องหมายและอุปกรณ์';
    } elseif ($type_id == 3) {
      $pageback = 'ข้อมูลค่าใช้จ่าย';
      $TitlePage = 'แก้ไขข้อมูลค่าใช้จ่าย';
    }
    $actionUrl  = site_url('product/product/update');
    $IdFrom     = "Update";
} else {
    $type_id    = $typeid;
    $actionUrl  = site_url('product/product/create');
    $IdFrom     = "Create";
    if($type_id == 1){
      $pageback = 'ข้อมูลเครื่องแบบ';
      $TitlePage = 'เพิ่มข้อมูลเครื่องแบบ';
    } elseif ($type_id == 2) {
      $pageback = 'ข้อมูลเครื่องหมายและอุปกรณ์';
      $TitlePage = 'เพิ่มข้อมูลเครื่องหมายและอุปกรณ์';
    } elseif ($type_id == 3) {
      $pageback = 'ข้อมูลค่าใช้จ่าย';
      $TitlePage = 'เพิ่มข้อมูลค่าใช้จ่าย';
    }


}
?>
<!----------
  breadcrumb for page
----------->
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2><?=$TitlePage;?></h2>
    <ol class="breadcrumb">
      <li><a href="#">หน้าแรก</a></li>
      <li><a href="<?=site_url('product/product/index/'.$type_id);?>"><?=$pageback;?></a></li>
      <li class="active">
        <strong><?=$TitlePage?></strong>
      </li>
    </ol>
  </div>
</div>
<!----------
  end breadcrumb for page
----------->
<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
<div class="col12" id="boxs-consfix">
<!----------
  Contents for page
----------->
<div class="tabs-container">
  <ul class="nav nav-tabs"><!-- tabs -->
    <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="false"><?=$TitlePage?></a></li>
    <div class="mail-tools tooltip-demo">
      <div class="btn-group pull-right">
        <button class="btn btn-white btn-sm btn-reload"  data-toggle="tooltip" data-placement="left" title="" data-original-title="Refresh page">
          <i class="fa fa-refresh"></i> Refresh
        </button>
        <?PHP if(!empty($Id)){ ?>
          <button class="btn btn-white btn-sm btn-checkdelete" data-urlCheck="<?=site_url('product/product/checkdelete/'.$Id);?>" data-url="<?=site_url('product/product/delete/'.$Id.'/'.$type_id);?>">
            <i class="fa fa-trash-o"></i>
          </button>
        <?PHP }?>
      </div>
    </div>
  </ul><!-- end tabs -->

  <div class="tab-content">

    <div id="tab-1" class="tab-pane active">
    <div class="panel-body">
      <form action="<?=$actionUrl?>" method="post" enctype="multipart/form-data" name="formProduct_<?=$IdFrom;?>" id="formProduct_<?=$IdFrom;?>" class="form-horizontal" novalidate>
        <input type="hidden" name="crfproduct" id="crfproduct" value="<?=$crfproduct;?>"/>
        <input type="hidden" name="Id" id="Id" value="<?PHP if(isset($Id)){echo $Id;}?>"/>
        <input type="hidden" name="type_id" id="type_id" value="<?=$type_id;?>"/>
        <div class="form-group">
          <label class="col-sm-2 control-label">รายการ<span class="text-muted"><font color="#FF0000">*</font></span></label>
          <div class="col-sm-9">
            <input type="text" name="product_name" id="product_name" class="form-control" value="<?PHP if(isset($product_name)){echo $product_name;}?>"/>
          </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">ราคา<span class="text-muted"><font color="#FF0000">*</font></span></label>
          <div class="col-sm-4">
            <input type="number" name="product_price" id="product_price" class="form-control" value="<?PHP if(isset($product_price)){echo $product_price;}?>"/>
          </div>
          <? if($type_id == 2){ ?>
            <label class="col-sm-1 control-label">จำนวน<span class="text-muted"><font color="#FF0000">*</font></span></label>
            <div class="col-sm-4">
            <input type="hidden" name="size_id" id="size_id" value="1"/>
            <input type="number" name="amount" id="amount" value="<?PHP if(isset($amount)){echo $amount;}?>" class="form-control"/>
          </div>
          <? } ?>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
          <div class="col-sm-6 col-sm-offset-4">
            <a href="<?=site_url('product/product/index');?>"><button class="btn btn-w-m btn-danger" type="button">ยกเลิก</button></a>
            <button class="btn btn-w-m btn-primary" type="submit">บันทึก</button>
          </div>
        </div>
      </form>
    </div><!-- end panel-body -->
    </div><!-- end tab-1 -->

  </div><!-- end tab-content -->
</div><!-- end tabs-container -->
<!----------
  end contents for page
----------->
</div><!-- /col12 -->
</div><!-- /row -->
</div><!-- /wrapper -->
