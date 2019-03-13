<!---------- 
  request data db
----------->
<?PHP
if(isset($liststock) && count($liststock) != 0){
  foreach ($liststock as $key => $value) {
    $product_id     = $value['product_id'];
    $product_name   = $value['product_name'];
    $size_id	      = $value['size_id'];
    $size_name	    = $value['size_name'];
    $amount	        = $value['amount'];
  }
    $type = $typeproduct; 
    $TitlePage      = "แก้ไขรายการคลัง";
    $actionUrl      = site_url('product/stock/update');
    $IdFrom         = "Update";
}else {
    $type               = $typeproduct; 
    $product_id         = $productid;
    $product_name       = $productname;
    $TitlePage          = "เพิ่มรายการคลัง";
    $actionUrl          = site_url('product/stock/create');
    $IdFrom             = "Create"; 
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
      <li><a href="<?=site_url('product/stock/index/'.$type.'/'.$product_id);?>"><?=$product_name;?></a></li>
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
        <?PHP if(!empty($product_id)){ ?>
          <button class="btn btn-white btn-sm btn-delete" data-url="<?=site_url('product/stock/delete/'.$type.'/'.$product_id.'/'.$size_id);?>">
            <i class="fa fa-trash-o"></i>
          </button>
        <?PHP }?>
      </div>
    </div>
  </ul><!-- end tabs -->
  
  <div class="tab-content">

    <div id="tab-1" class="tab-pane active">
    <div class="panel-body">
      <form action="<?=$actionUrl?>" method="post" enctype="multipart/form-data" name="formStock_<?=$IdFrom;?>" id="formStock_<?=$IdFrom;?>" class="form-horizontal" novalidate>
        <input type="hidden" name="crfstock" id="crfstock" value="<?=$crfstock;?>"/>
        <input type="hidden" name="type" id="type" value="<?=$type;?>"/>
        <input type="hidden" name="product_id" id="product_id" value="<?=$product_id;?>"/>
        <? if($type == 1){ ?>
        <div class="form-group">
          <label class="col-sm-2 control-label">รายการ<span class="text-muted"><font color="#FF0000">*</font></span></label>
          <div class="col-sm-8">
            <input type="text" name="product_name" id="product_name" class="form-control" value="<?PHP if(isset($product_name)){echo $product_name;}?>" readonly/>
          </div>
        </div><!-- /form-group -->
        <? if(!empty($size_id)){ ?> 
        <div class="hr-line-dashed"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">ขนาด<span class="text-muted"><font color="#FF0000">*</font></span></label>
          <div class="col-sm-4">
          <select class="form-control" name="size_id" id="size_id" readonly>
              <option value="<?=$size_id;?>"><?=$size_name;?></option>
          </select>
          </div>
          <label class="col-sm-1 control-label">จำนวน<span class="text-muted"><font color="#FF0000">*</font></span></label>
          <div class="col-sm-3">
            <input type="number" name="amount" id="amount" value="<?PHP if(isset($amount)){echo $amount;}?>" class="form-control"/>
          </div>
        </div><!-- /form-group -->
        <div class="hr-line-dashed"></div>
        <? } else { ?>
          <div class="hr-line-dashed"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">ตัวเลือก<span class="text-muted"><font color="#FF0000">*</font></span></label>
          <div class="col-sm-10">
            <label class="radio-inline">
              <input type="radio" name="status" id="status" class="status1" value="1"> เสื้อ
            </label>
            <label class="radio-inline">
              <input type="radio" name="status" id="status" class="status2" value="2"> กางเกง/กระโปรง
            </label>
          </div>
        </div><!-- /form-group -->
        <div class="hr-line-dashed"></div>
        <div class="form-group select1">
          <label class="col-sm-2 control-label">ขนาด<span class="text-muted"><font color="#FF0000">*</font></span></label>
          <div class="col-sm-4">
            <select class="form-control" name="size_id1" id="size_id1"> 
              <option value="">เลือก</option>
              <?PHP foreach ($listsize1 as $key => $value) { ?>
              <option value="<?=$value['size_id'];?>"><?=$value['size_name'];?></option>
              <? } ?>
            </select>
          </div>
          <label class="col-sm-1 control-label">จำนวน<span class="text-muted"><font color="#FF0000">*</font></span></label>
          <div class="col-sm-3">
            <input type="number" name="amount1" id="amount1" class="form-control"/>
          </div>
        </div><!-- /form-group -->
        <div class="form-group select2">
          <label class="col-sm-2 control-label">ขนาด<span class="text-muted"><font color="#FF0000">*</font></span></label>
          <div class="col-sm-4">
          <select class="form-control dis1" name="size_id2" id="size_id2">
              <option value="">เลือก</option>
              <?PHP foreach ($listsize2 as $key => $value) { ?>
              <option value="<?=$value['size_id'];?>"><?=$value['size_name'];?></option>
              <? } ?>
            </select>
          </div>
          <label class="col-sm-1 control-label">จำนวน<span class="text-muted"><font color="#FF0000">*</font></span></label>
          <div class="col-sm-3">
            <input type="number" name="amount2" id="amount2" class="form-control"/>
          </div>
        </div><!-- /form-group -->
        <? } ?>
        <div class="hr-line-dashed hideline"></div>
        <? } elseif($type == 2){ ?>
          <input type="hidden" name="type" id="type" value="<?=$type;?>"/>
          <input type="hidden" name="size_id" id="size_id" value="1"/>
          <div class="form-group">
            <label class="col-sm-2 control-label">รายการ<span class="text-muted"><font color="#FF0000">*</font></span></label>
            <div class="col-sm-8">
              <input type="text" name="product_name" id="product_name" class="form-control" value="<?PHP if(isset($product_name)){echo $product_name;}?>" readonly/>
            </div>
          </div><!-- /form-group -->
          <div class="hr-line-dashed"></div>
          <div class="form-group">
            <label class="col-sm-2 control-label">จำนวน<span class="text-muted"><font color="#FF0000">*</font></span></label>
            <div class="col-sm-4">
            <input type="number" name="amount" id="amount" value="<?PHP if(isset($amount)){echo $amount;}?>" class="form-control"/>
            </div>
          </div><!-- /form-group -->
          <div class="hr-line-dashed"></div>
        <? } ?> 
        <div class="form-group">
          <div class="col-sm-6 col-sm-offset-4">
            <a href="<?=site_url('product/stock/index/'.$type.'/'.$product_id);?>"><button class="btn btn-w-m btn-danger" type="button">ยกเลิก</button></a>
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
