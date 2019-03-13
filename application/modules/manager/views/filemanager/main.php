<!-- Breadcrumb for page -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>File manager</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>
            <li class="active">
                <strong>File manager</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<!-- End breadcrumb for page -->

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="file-manager">
                        <h5>Show:</h5>
                        <a href="javascript:void(0)" class="file-control file-type active" data-type="Ale">All</a>
                        <a href="javascript:void(0)" class="file-control file-type" data-type="Documents">Documents</a>
                        <a href="javascript:void(0)" class="file-control file-type" data-type="Audio">Audio</a>
                        <a href="javascript:void(0)" class="file-control file-type" data-type="Images">Images</a>
                        <div class="hr-line-dashed"></div>
                        <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal4">Upload Files</button>
                        <div class="hr-line-dashed"></div>
                        <h5>Folders</h5>
                        <ul class="folder-list" style="padding: 0">
                            <li><a href="javascript:void(0)" class="file-folder" data-folder="Files"><i class="fa fa-folder"></i> Files</a></li>
                            <li><a href="javascript:void(0)" class="file-folder" data-folder="Pictures"><i class="fa fa-folder"></i> Pictures</a></li>
                            <li><a href="javascript:void(0)" class="file-folder" data-folder="Web pages"><i class="fa fa-folder"></i> Web pages</a></li>
                            <li><a href="javascript:void(0)" class="file-folder" data-folder="Illustrations"><i class="fa fa-folder"></i> Illustrations</a></li>
                            <li><a href="javascript:void(0)" class="file-folder" data-folder="Films"><i class="fa fa-folder"></i> Films</a></li>
                            <li><a href="javascript:void(0)" class="file-folder" data-folder="Books"><i class="fa fa-folder"></i> Books</a></li>
                        </ul>
                        <h5 class="tag-title">Tags</h5>
                        <ul class="tag-list" style="padding: 0">
                            <li><a href="javascript:void(0)" class="file-tag" data-tag="Family">Family</a></li>
                            <li><a href="javascript:void(0)" class="file-tag" data-tag="Work">Work</a></li>
                            <li><a href="javascript:void(0)" class="file-tag" data-tag="Home">Home</a></li>
                            <li><a href="javascript:void(0)" class="file-tag" data-tag="Children">Children</a></li>
                            <li><a href="javascript:void(0)" class="file-tag" data-tag="Holidays">Holidays</a></li>
                            <li><a href="javascript:void(0)" class="file-tag" data-tag="Music">Music</a></li>
                            <li><a href="javascript:void(0)" class="file-tag" data-tag="Photography">Photography</a></li>
                            <li><a href="javascript:void(0)" class="file-tag" data-tag="Film">Film</a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 animated fadeInRight">
            <div class="row">
                <div class="col-lg-12" id="listFile" data-url="<?=site_url();?>" data-type="ale" data-folder="" data-tags="">

                </div>
            </div>
            </div>
        </div>
        </div>

        <div class="modal inmodal" id="myModal4" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content animated fadeIn">
              <form action="<?=site_url('manager/filemanager/create');?>" method="post" enctype="multipart/form-data" name="formFileManager" id="formFileManager" class="form-horizontal" novalidate>
              <div class="modal-header">
                <h4 class="modal-title">Upload File</h4>
              </div>
              <div class="modal-body">
                  <p>
                    <input type="hidden" name="crffilemanager" id="crffilemanager" value="<?=$crffilemanager;?>">
                    <div class="form-group"><label class="col-sm-2 control-label">Folder</label>
                        <div class="col-sm-10">
                          <select class="form-control" name="Text_Folder" id="Text_Folder">
                              <option value="Files">Files</option>
                              <option value="Pictures">Pictures</option>
                              <option value="Web pages">Web pages</option>
                              <option value="Illustrations">Illustrations</option>
                              <option value="Films">Films</option>
                              <option value="Books">Books</option>
                          </select>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label">Image</label>
                        <div class="col-sm-10"><input type="file" name="File_images" id="File_images" class="form-control"></div>
                    </div>
                  </p>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
              </form>
            </div>
          </div>
        </div>
