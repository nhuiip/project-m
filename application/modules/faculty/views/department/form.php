<!----------
  request data db
----------->
<?PHP
if(isset($listdept) && count($listdept) != 0){
  foreach ($listdept as $key => $value) {
    $Id         = $value['dept_id'];
    $dept_name  = $value['dept_name'];
    $fac_id     = $value['fac_id'];
}
    $fac_name   = $facname;
    $TitlePage = "แก้ไขข้อมูลสาขา";
    $actionUrl = site_url('faculty/department/update');
    $IdFrom = "Update";
}else{
    $fac_id     = $facid;
    $fac_name   = $facname;
    $TitlePage  = "เพิ่มข้อมูลสาขา";
    $actionUrl  = site_url('faculty/department/create');
    $IdFrom     = "Create";
}
?>
<!----------
  breadcrumb for page
----------->
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2><?=$fac_name;?></h2>
    <ol class="breadcrumb">
      <li><a href="#">หน้าแรก</a></li>
      <li><a href="<?=site_url('faculty/faculty/index');?>">ข้อมูลคณะ</a></li>
      <li><a href="<?=site_url('faculty/faculty/form/'.$fac_id);?>">แก้ไขข้อมูลคณะ</a></li>
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
    <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="false">ข้อมูลสาขา</a></li>
    <div class="mail-tools tooltip-demo">
      <div class="btn-group pull-right">
        <button class="btn btn-white btn-sm btn-reload"  data-toggle="tooltip" data-placement="left" title="" data-original-title="Refresh page">
          <i class="fa fa-refresh"></i> Refresh
        </button>
        <?PHP if(!empty($Id)){ ?>
          <button class="btn btn-white btn-sm btn-checkdelete" data-urlCheck="<?=site_url('faculty/faculty/checkdelete/'.$Id);?>" data-url="<?=site_url('faculty/faculty/delete/'.$Id);?>">
            <i class="fa fa-trash-o"></i>
          </button>
        <?PHP }?>
      </div>
    </div>
  </ul><!-- end tabs -->

  <div class="tab-content">

    <div id="tab-1" class="tab-pane active">
    <div class="panel-body">
      <form action="<?=$actionUrl?>" method="post" enctype="multipart/form-data" name="formDepartment_<?=$IdFrom;?>" id="formDepartment_<?=$IdFrom;?>" class="form-horizontal" novalidate>
        <input type="hidden" name="crfdept" id="crfdept" value="<?=$crfdept;?>"/>
        <input type="hidden" name="Id" id="Id" value="<?PHP if(isset($Id)){echo $Id;}?>"/>
        <input type="hidden" name="fac_id" id="fac_id" value="<?=$fac_id;?>"/>
        <div class="form-group">
          <label class="col-sm-2 control-label">ชื่อสาขา<span class="text-muted"><font color="#FF0000">*</font></span></label>
          <div class="col-sm-9">
            <input type="text" name="dept_name" id="dept_name" class="form-control" value="<?PHP if(isset($dept_name)){echo $dept_name;}?>"/>
          </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
          <div class="col-sm-6 col-sm-offset-4">
            <a href="<?=site_url('faculty/faculty/form/'.$fac_id);?>"><button class="btn btn-w-m btn-danger" type="button">ยกเลิก</button></a>
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
