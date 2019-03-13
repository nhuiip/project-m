<!---------- 
  request data db
----------->
<?PHP
if(isset($listsize) && count($listsize) != 0){
  foreach ($listsize as $key => $value) {
    $Id             = $value['size_id'];
    $size_name      = $value['size_name'];
    $size_status    = $value['size_status']; 
}
    $TitlePage  = "แก้ไขข้อมูลขนาดเครื่องแบบ";
    $actionUrl  = site_url('product/size/update');
    $IdFrom     = "Update";
}else{
    $size_status    = $sizestatus;
    $TitlePage  = "เพิ่มข้อมูลขนาดเครื่องแบบ";
    $actionUrl  = site_url('product/size/create');
    $IdFrom     = "Create";
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
      <li><a href="<?=site_url('product/size/index');?>">ข้อมูลขนาดเครื่องแบบ</a></li>
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
    <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="false">ข้อมูลขนาดเครื่องแบบ</a></li>
    <div class="mail-tools tooltip-demo">
      <div class="btn-group pull-right">
        <button class="btn btn-white btn-sm btn-reload"  data-toggle="tooltip" data-placement="left" title="" data-original-title="Refresh page">
          <i class="fa fa-refresh"></i> Refresh
        </button>
        <?PHP if(!empty($Id)){ ?>
          <button class="btn btn-white btn-sm btn-checkdelete" data-urlCheck="<?=site_url('product/size/checkdelete/'.$Id);?>" data-url="<?=site_url('product/size/delete/'.$Id);?>">
            <i class="fa fa-trash-o"></i>
          </button>
        <?PHP }?>
      </div>
    </div>
  </ul><!-- end tabs -->
  
  <div class="tab-content">

    <div id="tab-1" class="tab-pane active">
    <div class="panel-body">
      <form action="<?=$actionUrl?>" method="post" enctype="multipart/form-data" name="formSize_<?=$IdFrom;?>" id="formSize_<?=$IdFrom;?>" class="form-horizontal" novalidate>
        <input type="hidden" name="crfsize" id="crfsize" value="<?=$crfsize;?>"/>
        <input type="hidden" name="Id" id="Id" value="<?PHP if(isset($Id)){echo $Id;}?>"/>
        <input type="hidden" name="size_status" id="size_status" value="<?=$size_status;?>"/>
        <div class="form-group">
          <label class="col-sm-2 control-label">รายการ<span class="text-muted"><font color="#FF0000">*</font></span></label>
          <div class="col-sm-9">
            <input type="text" name="size_name" id="size_name" class="form-control" value="<?PHP if(isset($size_name)){echo $size_name;}?>"/>
          </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
          <div class="col-sm-6 col-sm-offset-4">
            <a href="<?=site_url('product/size/index');?>"><button class="btn btn-w-m btn-danger" type="button">ยกเลิก</button></a>
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
