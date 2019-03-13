<!----------
  request data db
----------->
<?PHP
if(isset($listfac) && count($listfac) != 0){
  foreach ($listfac as $key => $value) {
    $Id = $value['fac_id'];
    $fac_name = $value['fac_name'];
}
    $TitlePage = "แก้ไขข้อมูลคณะ";
    $actionUrl = site_url('faculty/faculty/update');
    $IdFrom = "Update";
}else{
    $TitlePage = "เพิ่มข้อมูลคณะ";
    $actionUrl = site_url('faculty/faculty/create');
    $IdFrom = "Create";
}
?>
<!----------
  breadcrumb for page
----------->
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2><?=$TitlePage?></h2>
    <ol class="breadcrumb">
      <li><a href="#">หน้าแรก</a></li>
      <li><a href="<?=site_url('faculty/faculty/index');?>">ข้อมูลคณะ</a></li>
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
    <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="false">ข้อมูลคณะ</a></li>
    <?PHP if(!empty($Id)){ ?>
    <li class><a data-toggle="tab" href="#tab-2" aria-expanded="false">ข้อมูลสาขา</a></li>
    <?PHP }?>
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
      <form action="<?=$actionUrl?>" method="post" enctype="multipart/form-data" name="formFaculty_<?=$IdFrom;?>" id="formFaculty_<?=$IdFrom;?>" class="form-horizontal" novalidate>
        <input type="hidden" name="crffaculty" id="crffaculty" value="<?=$crffaculty;?>"/>
        <input type="hidden" name="Id" id="Id" value="<?PHP if(isset($Id)){echo $Id;}?>"/>
        <div class="form-group">
          <label class="col-sm-2 control-label">ชื่อคณะ<span class="text-muted"><font color="#FF0000">*</font></span></label>
          <div class="col-sm-9">
            <input type="text" name="fac_name" id="fac_name" class="form-control" value="<?PHP if(isset($fac_name)){echo $fac_name;}?>"/>
          </div>
        </div>
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

    <?PHP if(!empty($Id)){ ?>
    <div id="tab-2" class="tab-pane">
    <div class="panel-body">
      <div class="row"><!-- add & search -->
      <div class="col-sm-6"></div>
      <div class="col-sm-6">
        <a href="<?=site_url('faculty/department/form/'.$Id);?>"><!-- btn insert -->
          <button class="btn btn-w-m btn-default btn-sm pull-right">
            <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
            &nbsp;&nbsp;เพิ่มสาขา
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

      <?PHP if(count($listdept) != 0){ ?>
      <table class="table table-striped table-hover dataTables-example" width="100%">
        <thead>
          <tr>
            <th width="5%">#</th>
            <th width="10%">รหัสสาขา</th>
            <th width="60%">ชื่อสาขา</th>
            <th width="10%">จัดการ</th>
            <th width="15%">แก้ไขล่าสุด</th>
          </tr>
        </thead>
        <tbody>
        <?PHP
          $numrow = 1;
          foreach ($listdept as $key => $value) {
        ?>
          <tr class="gradeX">
            <td width="5%"><strong><?=$numrow;?></strong></td>
            <td width="10%"><strong><?="DEPT".str_pad($value['dept_id'],3,"0",STR_PAD_LEFT);?></strong></td>
            <td width="60%" class="project-title"><?=$value['dept_name'];?></td>
            <td width="10%"><!--- Action --->
              <div class="btn-group" style="width:100%">
                <button class="btn btn-sm btn-default " type="button" style="width:70%">Action</button>
                <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:30%;">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" style="width:30%">
                    <li><a href="<?=site_url('faculty/department/form/'.$value['fac_id'].'/'.$value['dept_id']);?>"><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;แก้ไขข้อมูล</a></li>
                    <li><a href="#" class="btn-checkdelete" data-url="<?=site_url('faculty/department/delete/'.$value['dept_id'].'/'.$value['fac_id']);?>" data-urlCheck="<?=site_url('faculty/department/checkdelete/'.$value['dept_id'].'/'.$Id);?>"><i class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;ลบข้อมูล</a></li>
                </ul>
              </div>
            </td><!--- end Action --->
            <td width="15%"><!--- lastedit --->
              <?=$value['dept_lastedit_name'];?><br />
              <small class="text-muted">
                <i class="fa fa-clock-o"></i>
                <?=date('d/m/Y h:i A', strtotime($value['dept_lastedit_date']));?>
              </small>
            </td><!--- end lastedit --->
          </tr>
        <?PHP $numrow++ ; } ?>
        </tbody>
      </table>
      <?php }else{ ?>
        <hr>
        <center><p style="color:#95a5a6;">"No results found in this list."</p><center>
      <?php } ?>
    </div><!-- end panel-body -->
    </div><!-- end tab-2 -->
    <?PHP }?>

  </div><!-- end tab-content -->
</div><!-- end tabs-container -->
<!----------
  end contents for page
----------->
</div><!-- /col12 -->
</div><!-- /row -->
</div><!-- /wrapper -->
