<!-- Breadcrumb for page -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>จัดการหน้าแรก</h2>
        <ol class="breadcrumb">
            <li class="active">
                <strong>จัดการหน้าแรก</strong>
            </li>
        </ol>
    </div>
</div>
<!-- End breadcrumb for page -->
<div class="wrapper wrapper-content animated fadeInRight" style="padding: 20px 0px;">
<div class="row">
<div class="col12" id="boxs-consfix"> 
<div class="ibox-content">
<!-- content -->
      <form action="<?=site_url('managepage/pagecontents/update');?>" method="post" enctype="multipart/form-data" name="formPagedetailTH" id="formPagedetailTH" class="form-horizontal" novalidate>
      <input type="hidden" name="crfcontents" id="crfcontents" value="<?=$crfcontents;?>">
      <input type="hidden" name="con_id" id="con_id" value="<?PHP if(isset($con_id)){echo $con_id;}?>">
      <div class="form-group">
          <div class="col-sm-12">
            <textarea rows="25" cols="150" class="summernote" data-img="<?=site_url('manager/filemanager/summernote');?>" id="con_detail_th" name="con_detail_th">
              <?PHP if(isset($con_detail_th)){echo $con_detail_th;}else{echo '<div class="container clearfix"><p></div>';}?>
          </textarea>
          </div>
      </div><!--/form-group-->
      <div class="hr-line-dashed"></div>
      <div class="form-group">
          <div class="col-sm-6 col-sm-offset-4">
            <a href="<?=site_url('managePage/pagecontents/index');?>">
            <button class="btn btn-w-m btn-danger" type="button">ยกเลิก</button>
            </a>
            <button class="btn btn-w-m btn-primary" type="submit">บันทึก</button>
          </div>
      </div><!--form-group-->
      </form>
<!-- end content -->
</div><!--/ibox-content-->
</div><!-- /col12 -->
</div><!-- /row -->
</div><!-- /wrapper -->
<div style="margin:10px 0px;"><br></div>
