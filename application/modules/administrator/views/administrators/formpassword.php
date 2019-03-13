<!-- Breadcrumb for page -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Change password</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>
            <li>
                <a href="<?=site_url('administrator/main');?>">Administrators</a>
            </li>
            <li class="active">
                <strong>Change password</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<!-- End breadcrumb for page -->

<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
          <div class="ibox-content">
              <!-- Contents for page -->
              <form action="<?=site_url('administrator/changepassword');?>" method="post" enctype="multipart/form-data" name="formAdministrators" id="formAdministrators" class="form-horizontal" novalidate>
                <input type="hidden" name="formcrf" id="formcrf" value="<?=$formcrf;?>">
                <input type="hidden" name="Id" id="Id" value="<?=$Id?>">
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label class="col-sm-2 control-label">Password<span class="text-muted">*</span></label>
                    <div class="col-sm-10"><input type="password" name="Text_passWord" id="Text_passWord" class="form-control"></div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label class="col-sm-2 control-label">Confirm Password<span class="text-muted">*</span></label>
                    <div class="col-sm-10"><input type="password" name="Text_confirmPassword" id="Text_confirmPassword" class="form-control"></div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                  <div class="col-sm-6 col-sm-offset-4">
                      <a href="<?=site_url('administrator/main');?>">
                      <button class="btn btn-w-m btn-danger" type="button">Cancel</button>
                      </a>
                      <button class="btn btn-w-m btn-primary" type="submit">Save changes</button>
                  </div>
                </div>
              </form>
              <!-- End contents for page -->
          </div>
      </div>
    </div>
</div>
</div>
