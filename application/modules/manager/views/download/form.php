<?PHP
if(isset($listdata) && count($listdata) != 0){
  foreach ($listdata as $key => $value) {
    $Id = $value['download_id'];
    $Text_type = $value['download_type'];
    $Text_title = $value['download_title'];
    $Text_urlvideo = $value['download_urlvideo'];
    $File_download = $value['download_file'];
    $File_images = $value['download_image'];
    $Text_detail = $value['download_description'];
    $Text_sort = $value['download_sort'];
    $Text_eye = $value['download_show'];
    $Text_check = $value['download_status'];
  }
  $TitlePage = "Update";
  $actionUrl = site_url('manager/download/update/');
}else{
  $TitlePage = "Create";
  $actionUrl = site_url('manager/download/create/');
  $Text_eye = 1;
  $Text_check = 1;
}
?>

<!-- Breadcrumb for page -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?=$TitlePage;?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>
            <li>
                <a href="<?=site_url('manager/download/index/');?>">Download</a>
            </li>
            <li class="active">
                <strong><?=$TitlePage;?></strong>
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
              <!-- Contents for page -->
              <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-2" aria-expanded="false">Download</a></li>
                  <div class="mail-tools tooltip-demo">
                        <div class="btn-group pull-right">
                          <button class="btn btn-white btn-sm btn-reload" data-toggle="tooltip" data-placement="left" title="" data-original-title="Refresh page"><i class="fa fa-refresh"></i> Refresh</button>
                          <button class="btn btn-white btn-sm btn-eye" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mark as show">
                            <?PHP if($Text_eye == 1){?>
                              <i class="fa fa-eye"></i>
                            <?PHP }else{ ?>
                              <i class="fa fa-eye-slash"></i>
                            <?PHP }?>
                          </button>
                          <button class="btn btn-white btn-sm btn-check" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mark as important">
                            <?PHP if($Text_check == 1){?>
                              <i class="fa fa-check-square-o"></i>
                            <?PHP }else if($Text_check == 2){ ?>
                              <i class="fa fa-check-square"></i>
                            <?PHP }?>
                          </button>
                          <?PHP if(!empty($Id)){ ?>
                          <button class="btn btn-white btn-sm Btn-delete" data-url="<?=site_url('manager/download/delete/'.$Id);?>"><i class="fa fa-trash-o"></i> </button>
                          <?PHP }?>
                          <?PHP if(!empty($Id)){ ?>
                          <button class="btn btn-warning btn-sm btn-url" data-url="<?=site_url("uploads/download/file/".$File_download);?>" data-toggle="tooltip" data-placement="left" title="" data-original-title="Preview this pages"><i class="fa fa-search"></i> Preview</button>
                          <?PHP }?>
                        </div>
                    </div>
                        </ul>

                        <div class="tab-content">
                            <div id="tab-2" class="tab-pane active">
                                <div class="panel-body">
                                  <form action="<?=$actionUrl;?>" method="post" enctype="multipart/form-data" name="formDownload_<?=$TitlePage?>" id="formDownload_<?=$TitlePage?>" class="form-horizontal" novalidate>
                                    <input type="hidden" name="crfdownload" id="crfdownload" value="<?=$crfdownload;?>">
                                    <input type="hidden" name="Id" id="Id" value="<?PHP if(isset($Id)){echo $Id;}?>">
                                    <input type="hidden" name="Text_eye" id="Text_eye" class="Text_eye" value="<?PHP if(isset($Text_eye)){echo $Text_eye;}?>">
                                    <input type="hidden" name="Text_check" id="Text_check" class="Text_check" value="<?PHP if(isset($Text_check)){echo $Text_check;}?>">
                                    <div class="form-group"><label class="col-sm-2 control-label">Title<span class="text-muted">*</span></label>
                                        <div class="col-sm-10"><input type="text" name="Text_title" id="Text_title" class="form-control" value="<?PHP if(isset($Text_title)){echo $Text_title;}?>"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Type<span class="text-muted">*</span></label>
                                        <div class="col-sm-10">
                                          <select name="Text_type" id="Text_type" tabindex="9" class="form-control">
                                              <option value="1">Brochure</option>
                                              <option value="2">Other</option>
                                          </select>
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">File<span class="text-muted">*</span></label>
                                        <div class="col-sm-10">
                                          <input type="file" name="File_download" id="File_download" class="form-control">
                                          <input type="hidden" name="File_download_old" id="File_download_old" value="<?PHP if(isset($File_download)){echo $File_download;}?>">
                                        </div>
                                    </div>
                                      <div class="form-group"><label class="col-sm-2 control-label">Image</label>
                                          <div class="col-sm-10">
                                            <input type="file" name="File_images" id="File_images" accept="image/*" class="form-control">
                                            <input type="hidden" name="File_images_old" id="File_images_old" value="<?PHP if(isset($File_images)){echo $File_images;}?>">
                                          </div>
                                      </div>
                                      <div class="form-group"><label class="col-sm-2 control-label">Url Video</label>
                                          <div class="col-sm-4">
                                            <input type="text" name="Text_urlvideo" id="Text_urlvideo" class="form-control" value="<?PHP if(isset($Text_urlvideo)){echo $Text_urlvideo;}?>">
                                          </div>
                                          <label class="col-sm-2 control-label">Sort</label>
                                          <div class="col-sm-4">
                                          <input type="text" name="Text_sort" id="Text_sort" class="form-control" value="<?PHP if(isset($Text_sort)){echo $Text_sort;}?>">
                                          </div>
                                      </div>
                                    <div class="hr-line-dashed" style="clear: both;"></div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                          <textarea rows="25" cols="150" class="summernote" id="Text_detail" name="Text_detail"><?PHP if(isset($Text_detail)){echo $Text_detail;}?></textarea>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                      <div class="col-sm-6 col-sm-offset-4">
                                          <a href="<?=site_url('manager/download/index/');?>">
                                          <button class="btn btn-w-m btn-danger" type="button">Cancel</button>
                                          </a>
                                          <button class="btn btn-w-m btn-primary" type="submit">Save changes</button>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                            </div>

                        </div>


                    </div>
              <!-- End contents for page -->
    </div>
</div>
</div>
