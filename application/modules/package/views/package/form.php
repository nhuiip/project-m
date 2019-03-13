<!---------- 
  request data db
----------->
<?PHP
if(isset($listpackage) && count($listpackage) != 0){
  foreach ($listpackage as $key => $value) {
    $Id = $value['pack_id'];
    $dept_id = $value['dept_id'];
    $sex_id = $value['sex_id'];
    $course_status = $value['course_status'];
    
}
    $TitlePage = "แก้ไขเซตเครื่องแบบ";
    $actionUrl = site_url('package/package/update');
    $IdFrom = "Update";
    $dept_name = $deptname;
}else{
    $TitlePage = "เพิ่มเซตเครื่องแบบ";
    $actionUrl = site_url('package/package/create');
    $IdFrom = "Create";
    $dept_id = $deptid;
    $dept_name = $deptname;
}
?>
<!---------- 
  breadcrumb for page 
----------->
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2><?=$TitlePage?>: <?=$dept_name;?></h2>
    <ol class="breadcrumb">
      <li><a href="#">หน้าแรก</a></li>
      <li><a href="<?=site_url('package/package/index/'.$dept_id);?>">เซตเครื่องแบบ</a></li>
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
    <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="false">เซตเครื่องแบบ</a></li>
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
      <form action="<?=$actionUrl?>" method="post" enctype="multipart/form-data" name="formPackage_<?=$IdFrom;?>" id="formPackage_<?=$IdFrom;?>" class="form-horizontal" novalidate>
        <input type="hidden" name="crfpackage" id="crfpackage" value="<?=$crfpackage;?>"/>
        <input type="hidden" name="Id" id="Id" value="<?PHP if(isset($Id)){echo $Id;}?>"/>
        <input type="hidden" name="dept_id" id="dept_id" value="<?PHP if(isset($dept_id)){echo $dept_id;}?>"/>
        <div class="form-group">
          <label class="col-sm-2 control-label">สาขา<span class="text-muted"><font color="#FF0000">*</font></span></label>
          <div class="col-sm-9">
            <input type="text" name="dept_name" id="dept_name" class="form-control" value="<?PHP if(isset($dept_name)){echo $dept_name;}?>" readonly/>
          </div>
        </div><!-- /form-group -->
        <div class="hr-line-dashed"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">หลักสูตร<span class="text-muted"><font color="#FF0000">*</font></span></label>
          <div class="col-sm-4">
            <select class="form-control" name="course_status" id="course_status">
              <option value="">เลือก</option>
              <option value="1" <?PHP if(isset($course_status) and $course_status == 1){echo 'selected';} ?> >4 ปีปกติ</option>
              <option value="2" <?PHP if(isset($course_status) and $course_status == 2){echo 'selected';} ?> >4 ปีเทียบโอน</option>
            </select>
          </div>
          <label class="col-sm-1 control-label">เพศ<span class="text-muted"><font color="#FF0000">*</font></span></label>
          <div class="col-sm-4">
          <select class="form-control" name="sex_id" id="sex_id">
            <option value="">เลือก</option>
            <?PHP foreach ($listsex as $key => $value) {?>
            <option value="<?=$value['sex_id'];?>" <?PHP if(isset($sex_id) and $sex_id == $value['sex_id']){echo 'selected';} ?> ><?=$value['sex_name'];?></option>
            <?PHP }?>
          </select>
          </div>
        </div><!-- /form-group -->
        <div class="hr-line-dashed"></div>
        <div class="form-group">
          <div class="col-sm-6 col-sm-offset-4">
            <a href="<?=site_url('faculty/faculty/index');?>"><button class="btn btn-w-m btn-danger" type="button">ยกเลิก</button></a>
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
