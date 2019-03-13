<!-- Breadcrumb for page -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Download</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>
            <li class="active">
                <strong>Download</strong>
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
              <div class="row">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                  <a href="<?=site_url('manager/download/form/');?>">
                  <button class="btn btn-w-m btn-primary btn-sm pull-right">Add download</button>
                  </a>
                  <div class="input-group">
                    <input type="text" placeholder="Search" name="search-draw" id="search-draw" class="input-sm form-control">
                    <span class="input-group-btn">
                      <button type="button" id="btnsearch" class="btn btn-sm btn-primary"> Go!</button>
                    </span>
                  </div>
                </div>
              </div>

              <div class="table-responsive">
                <?PHP if(count($listdata) != 0){ ?>
                <table class="table table-striped table-hover dataTables-example" >
                  <thead>
                  <tr>
                      <th style="width:10%;">#</th>
                      <th style="width:40%;">Title</th>
                      <th style="width:15%;">Type</th>
                      <th style="width:15%;">Edit By</th>
                      <th style="width:10%;">Action</th>
                      <th style="width:5%;"></th>
                      <th style="width:5%;"></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?PHP
                  foreach ($listdata as $key => $value) {
                  ?>
                  <tr class="gradeX">
                      <td><strong><?="D".str_pad($value['download_id'],5,"0",STR_PAD_LEFT);?></strong></td>
                      <td class="project-title">
                        <a href="<?=site_url("uploads/download/file/".$value['download_file']);?>" target="_blank">
                          <?=character_limiter(strip_tags($value['download_title']),30);?>
                        </a><br />
                        <small><?=character_limiter(strip_tags($value['download_description']),50);?></small>
                      </td>
                      <td>
                        <?PHP if($value['download_type'] == 1){echo 'Brochure';}else if($value['download_type'] == 2){echo 'Other';} ?>
                      </td>
                      <td>
                        <?=$value['download_editby'];?><br />
                        <small class="text-muted"><i class="fa fa-clock-o"></i> <?=date('d/m/Y h:i A', strtotime($value['download_lastedit']));?></small>
                      </td>
                      <td class="center">
                        <div class="btn-group">
                          <button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle" aria-expanded="false">Action <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                              <li><a href="<?=site_url('manager/download/form/'.$value['download_id']);?>"><i class="fa fa-pencil"></i> Edit</a></li>
                              <li><a href="#" class="Btn-delete" data-url="<?=site_url('manager/download/form/'.$value['download_id']);?>"><i class="fa fa-trash"></i> Delete</a></li>
                            </ul>
                        </div>
                      </td>
                      <td class="center">
                        <?PHP if($value['download_show'] == 1){?>
                          <span class="label label-primary">Active</span>
                        <?PHP }else{ ?>
                          <span class="label label-danger">Deactivate</span>
                        <?PHP }?>
                      </td>
                      <td class="center">
                        <?PHP if($value['download_status'] == 1){?>
                          <span class="label label-info">Normal</span>
                        <?PHP }else if($value['download_status'] == 2){ ?>
                          <span class="label label-success">Important</span>
                        <?PHP }?>
                      </td>
                  </tr>
                  <?PHP }?>

                  </tbody>
                </table>
                <?PHP }else{echo "No results found in this list.";}?>
              </div>

              <!-- End contents for page -->
          </div>
      </div>
    </div>
</div>
</div>
