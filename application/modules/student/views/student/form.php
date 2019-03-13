<!---------- 
  request data db
----------->
<?PHP
if(isset($liststudent) && count($liststudent) != 0){
  foreach ($liststudent as $key => $value) {
    $student_id     = $value['student_id'];
    $name_title	    = $value['name_title'];
    $student_fname	= $value['student_fname'];
    $student_lname	= $value['student_lname'];
    $dept_id        = $value['dept_id'];
    $sex_id         = $value['sex_id'];
    $course_status  = $value['course_status'];
    if($course_status == 1){$course = '4ปีปกติ';}
    elseif($course_status == 2){$course = '4ปีเทียบโอน';}
    
  }
    $TitlePage      = "แก้ไขข้อมูลนักศึกษา";
    $actionUrl      = site_url('student/student/update');
    $IdFrom         = "Update";
    $dept_name      = $deptname;
}else{
    $TitlePage      = "เพิ่มข้อมูลนักศึกษา";
    $actionUrl      = site_url('student/student/create');
    $IdFrom         = "Create";
    $dept_id        = $deptid;
    $dept_name      = $deptname;
    $course_status  = $coursestatus;
    if($course_status == 1){$course = '4ปีปกติ';}
    elseif($course_status == 2){$course = '4ปีเทียบโอน';}
}
?>
<!---------- 
  breadcrumb for page 
----------->
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2><?=$TitlePage?>: <?=$dept_name;?>: <?=$course;?></h2>
    <ol class="breadcrumb">
      <li><a href="#">หน้าแรก</a></li>
      <li><a href="<?=site_url('student/student/index/'.$dept_id.'/'.$course_status);?>">ข้อมูลนักศึกษา</a></li>
      <li class="active">
        <strong><?=$TitlePage?></strong>
      </li>
    </ol>
  </div>
</div>
<!----------
  end breadcrumb for page 
----------->
<div class="wrapper wrapper-content animated fadeInRight" style="padding: 30px 0px;">
<div class="row">
<div class="col12" id="boxs-consfix">
<!----------
  Contents for page 
----------->
<div class="mail-tools tooltip-demo"><!-- option btn -->
  <div class="btn-group pull-right">
    <button class="btn btn-white btn-sm btn-reload" data-toggle="tooltip" data-placement="left" title="" data-original-title="Refresh page"><i class="fa fa-refresh"></i> Refresh</button>
    <?PHP if(!empty($student_id)){ ?>
    <button class="btn btn-white btn-sm btn-delete" data-url="<?=site_url('news/news/delete/'.$student_id);?>"><i class="fa fa-trash-o"></i> </button>
    <?PHP }?>
  </div>
</div><!-- end option btn -->
<div class="ibox-content">
<form action="<?=$actionUrl?>" method="post" enctype="multipart/form-data" name="formStudent_<?=$IdFrom;?>" id="formStudent_<?=$IdFrom;?>" class="form-horizontal" novalidate>
  <input type="hidden" name="crfstudent" id="crfstudent" value="<?=$crfstudent;?>"/>
  <input type="hidden" name="dept_id" id="dept_id" value="<?PHP if(isset($dept_id)){echo $dept_id;}?>"/>
  <input type="hidden" name="course_status" id="course_status" value="<?PHP if(isset($course_status)){echo $course_status;}?>"/>
  <div class="form-group">
    <label class="col-sm-2 control-label">รหัสนักศึกษา<span class="text-muted"><font color="#FF0000">*</font></span></label>
    <div class="col-sm-4">
    <input type="text" class="form-control" name="student_id" id="student_id" value="<?PHP if(isset($student_id)){echo $student_id;}?>"/>
    </div>
  </div><!-- /form-group -->
  <div class="hr-line-dashed"></div>
  <div class="form-group">
    <label class="col-sm-2 control-label">ชื่อ-นามสกุล<span class="text-muted"><font color="#FF0000">*</font></span></label>
    <div class="col-sm-2">
    <select class="form-control" name="name_title" id="name_title">
    <option value="">เลือก</option>
        <option value="นาย" <?PHP if(isset($name_title) and $name_title == 'นาย'){echo 'selected';} ?> >นาย</option>
        <option value="นาง" <?PHP if(isset($name_title) and $name_title == 'นาง'){echo 'selected';} ?> >นาง</option>
        <option value="นางสาว" <?PHP if(isset($name_title) and $name_title == 'นางสาว'){echo 'selected';} ?> >นางสาว</option>
    </select>
    </div>
    <div class="col-sm-3">
      <input type="text" placeholder="ชื่อ" class="form-control" name="student_fname" id="student_fname" value="<?PHP if(isset($student_fname)){echo $student_fname;}?>"/>
    </div>
    <div class="col-sm-4">
      <input type="text" placeholder="นามสกุล" class="form-control" name="student_lname" id="student_lname" value="<?PHP if(isset($student_lname)){echo $student_lname;}?>"/>
    </div>
  </div><!-- /form-group -->
  <div class="hr-line-dashed"></div>
  <div class="form-group">
    <label class="col-sm-2 control-label">เพศ<span class="text-muted"><font color="#FF0000">*</font></span></label>
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
      <a href="<?=site_url('student/student/index/'.$dept_id.'/'.$course_status);?>"><button class="btn btn-w-m btn-danger" type="button">ยกเลิก</button></a>
      <button class="btn btn-w-m btn-primary" type="submit">บันทึก</button>
    </div>
  </div>
</form>
</div>
<!---------- 
  end contents for page 
----------->
</div><!-- /col12 -->
</div><!-- /row -->
</div><!-- /wrapper -->
