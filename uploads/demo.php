<?php
if(isset($listshowData) && count($listshowData) != 0){
  foreach ($listshowData as $key => $value) {
    $Id = $value['psn_id'];
    $psn_img = $value['psn_img'];
    $textpsn_fname = $value['psn_fname'];
    $textpsn_lname = $value['psn_lname'];
    $textrole_name = $value['role_name'];
    $textrank_name = $value['rank_name'];
    $textbel_name = $value['bel_name'];
    $texttypes_name = $value['types_name'];
    $textregis_year = $value['regis_year'];
    $textlastedit_name = $value['lastedit_name'];
    $textlastedit_date = $value['lastedit_date'];
  }
}
?>
<!-- Breadcrumb for page -->
<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
    <h2><?=$textpsn_fname?> <?=$textpsn_lname?></h2>
    <ol class="breadcrumb">
      <li><a href="#">หน้าแรก</a></li>
      <li><a href="<?=site_url('personnel/personnel/index');?>"><strong>บุคลากร</strong></a></li>
      <li class="active"><strong><?=$textpsn_fname?> <?=$textpsn_lname?></strong></li>
    </ol>
</div><!-- */col-lg-10 -->
    <div class="col-lg-2"></div>
</div>

<!-- data -->
<div class="wrapper wrapper-content animated fadeInRight"><!-- f-1 -->
    <div class="row"><!-- f-2 -->
        <div class="col-lg-12"><!-- f-3 -->
<!--------------------------------------------------------------------->
<div class="ibox float-e-margins"><!-- 1 -->
    <div class="ibox-content"><!-- 2 -->
<!--------------------------------------------------------------------->
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-3">
                <img alt="image" class="img-responsive" src="<?=base_url('uploads/personnel/'.$psn_img);?>">                        
            </div>
            <div class="col-sm-7">
                <div class="row">
                    <div class="col-sm-2"><b>ชื่อ-นามสกุล :</b></div><div class="col-sm-4"><p><?=$textpsn_fname?> <?=$textpsn_lname?></p></div>
                    <div class="col-sm-2"><b>สังกัด :</b></div><div class="col-sm-4"><p><?=$textbel_name?></p></div>
                    <div class="col-sm-2"><b>ตำแหน่ง :</b></div><div class="col-sm-4"><p><?=$textrole_name?></p></div>
                    <div class="col-sm-2"><b>ระดับ :</b></div><div class="col-sm-4"><p><?=$textrank_name?></p></div>
                    <div class="col-sm-2"><b>ปีขึ้นทะเบียน :</b></div><div class="col-sm-4"><p><?=$textregis_year?></p></div>
                    <div class="col-sm-2"><b>ประเภท :</b></div><div class="col-sm-4"><p><?=$texttypes_name?></p></div>
                </div>
                <div class="row">
                    <div class="hr-line-dashed col-sm-12"></div>
                    <div class="col-sm-2"><b>แก้ไขล่าสุด :</b></div><div class="col-sm-10"><p><?=$textlastedit_name?> ,<?=$textlastedit_date?></p></div>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div><!-- */row -->
<!--------------------------------------------------------------------->
    </div><!-- */2 -->
</div><!-- */1 -->
<!--------------------------------------------------------------------->
<div class="ibox float-e-margins"><!-- 1 -->
    <div class="ibox-content"><!-- 2 -->
<!--------------------------------------------------------------------->
    <div class="tabs-container">
        <ul class="nav nav-tabs"><!-- tabs -->        
            <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="false">การอบรม</a></li>
            <li><a data-toggle="tab" href="#tab-2" aria-expanded="false">การแข่งขัน</a></li>
        </ul><!-- */tabs -->
    </div><!-- */tabs-container -->
    <div class="tab-content">
<!--------------------------------------------------------------------->
        <div id="tab-1" class="tab-pane active"><!-- body-tab1 --> 
            <div class="panel-body">
                <div class="row"><!-- search & add -->
                    <div class="col-sm-8"></div>
                    <div class="col-sm-4">
                        <a href="<?=site_url('personnel/experience/formExptrai');?>">
                            <button class="btn btn-w-m btn-primary btn-sm pull-right">เพิ่มการอบรม</button>
                        </a>
                        <div class="input-group">
                            <input type="text" placeholder="Search" name="search-drawv2" id="search-drawv2" class="input-sm form-control">
                            <span class="input-group-btn">
                                <button type="button" id="btnsearchv2" class="btn btn-sm btn-primary"> Go!</button>
                            </span>
                        </div>
                    </div><!-- */col-sm-4 -->
                </div><!-- */search & add -->
                <div class="table-responsive">
                <?PHP if(count($listshowData) != 0){?>
                <table class="table table-striped table-hover dataTables-examplev2" >
                    <thead>
                    <tr>
                        <th style="width:10%;">#</th>
                        <th style="width:5%;">ปี</th>
                        <th style="width:45%;">ชื่อหลักสูตร</th>
                        <th style="width:10%;">ประเภท</th>
                        <th style="width:10%;">ระดับ</th>
                        <!-- <th style="width:20%;">แก้ไขล่าสุด</th> -->
                        <th style="width:10%;">จัดการ</th>
                        <th style="width:10%;"><center>แสดง/ซ่อน</center></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?PHP
                        foreach ($listExptraiData as $key => $value) {
                            $exptrai_year   = $value['exptrai_year'];
                            $exptrai_title  = $value['exptrai_title'];
                            $types_name     = $value['types_name'];
                            $rtrai_name     = $value['rtrai_name'];
                            $lastedit_name  = $value['lastedit_name'];
                            $lastedit_date  = $value['lastedit_date'];
                    ?>
                    <tr class="gradeX">
                        <td><strong><?="P".str_pad($value['exptrai_id'],5,"0",STR_PAD_LEFT);?></strong></td>
                        <td class="project-title"><a href="#" target="_blank"><?=$exptrai_year;?></a></td>
                        <td><?=$exptrai_title;?></td>
                        <td><?=$types_name;?></td>
                        <td><?=$rtrai_name;?></td>
                        <!-- <td><?=$lastedit_name;?> | <?=$lastedit_date;?></td> -->
                        <td class="center"><!-- Action -->
                            <div class="btn-group">
                                <button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle" aria-expanded="false">Action <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?=site_url('personnel/personnel/form/'.$value['exptrai_id']);?>"><i class="fa fa-pencil"></i> Edit</a></li>
                                        <li><a href="<?=site_url('personnel/experience/index/'.$value['exptrai_id']);?>"><i class="fa fa-pencil"></i> Views</a></li>
                                        <li><a href="#" class="Btn-delete" data-url="<?=site_url('personnel/personnel/delete/'.$value['exptrai_id']);?>"><i class="fa fa-trash"></i> Delete</a></li>
                                    </ul>
                            </div>
                        </td><!-- */Action -->
                        <td class="center">
                            <?PHP if($value['exptrai_show'] == 1){?>
                                <span class="glyphicon glyphicon-eye-open"></span>
                            <?PHP }else{ ?>
                                <span class="glyphicon glyphicon-eye-close"></span>
                            <?PHP }?>
                        </td>
                    </tr>
                    <?PHP }?>
                    </tbody>
                </table>
                <?PHP }?>
                </div><!-- */ table-responsive -->   
            </div><!-- */panel-body-1 -->
        </div><!-- */body-tab1 --> 
<!--------------------------------------------------------------------->
        <div id="tab-2" class="tab-pane"><!-- body-tab1 --> 
            <div class="panel-body">
                <div class="row"><!-- search & add -->
                    <div class="col-sm-8"></div>
                    <div class="col-sm-4">
                        <a href="<?=site_url('personnel/experience/formExptnm');?>">
                            <button class="btn btn-w-m btn-primary btn-sm pull-right">เพิ่มการแข่งขัน</button>
                        </a>
                        <div class="input-group">
                            <input type="text" placeholder="Search" name="search-draw" id="search-draw" class="input-sm form-control">
                            <span class="input-group-btn">
                                <button type="button" id="btnsearch" class="btn btn-sm btn-primary"> Go!</button>
                            </span>
                        </div>
                    </div><!-- */col-sm-4 -->
                </div><!-- */search & add -->
                <div class="table-responsive">
                <?PHP if(count($listshowData) != 0){?>
                <table class="table table-striped table-hover dataTables-example">
                    <thead>
                    <tr>
                        <th style="width:10%;">#</th>
                        <th style="width:20%;">รายการ</th>
                        <th style="width:10%;">วันที่</th>
                        <th style="width:10%;">หน้าที่</th>
                        <th style="width:10%;">ประเภท</th>
                        <th style="width:10%;">ระดับ</th>
                        <th style="width:10%;">สังกัด</th>
                        <th style="width:10%;">จัดการ</th>
                        <th style="width:10%;"><center>แสดง/ซ่อน</center></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?PHP
                        foreach ($listExptnmData as $key => $value) {
                            $exptnm_title   = $value['exptnm_title'];
                            $exptnm_date    = $value['exptnm_date'];
                            $role_name      = $value['role_name'];
                            $types_name     = $value['types_name'];
                            $rank_name      = $value['rank_name'];
                            $bel_name       = $value['bel_name'];
                    ?>
                    <tr class="gradeX">
                        <td><strong><?="P".str_pad($value['exptnm_id'],5,"0",STR_PAD_LEFT);?></strong></td>
                        <td class="project-title"><a href="#" target="_blank"><?=$exptrai_year;?></a></td>
                        <td><?=$exptnm_title;?></td>
                        <td><?=$exptnm_date;?></td>
                        <td><?=$role_name;?></td>
                        <td><?=$types_name;?></td>
                        <td><?=$rank_name;?></td>
                        <td><?=$bel_name;?></td>
                        <!-- <td><?=$lastedit_name;?> | <?=$lastedit_date;?></td> -->
                        <td class="center"><!-- Action -->
                            <div class="btn-group">
                                <button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle" aria-expanded="false">Action <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?=site_url('personnel/personnel/form/'.$value['exptnm_id']);?>"><i class="fa fa-pencil"></i> Edit</a></li>
                                        <li><a href="<?=site_url('personnel/experience/index/'.$value['exptnm_id']);?>"><i class="fa fa-pencil"></i> Views</a></li>
                                        <li><a href="#" class="Btn-delete" data-url="<?=site_url('personnel/personnel/delete/'.$value['exptnm_id']);?>"><i class="fa fa-trash"></i> Delete</a></li>
                                    </ul>
                            </div>
                        </td><!-- */Action -->
                        <td class="center">
                            <?PHP if($value['exptnm_show'] == 1){?>
                                <span class="glyphicon glyphicon-eye-open"></span>
                            <?PHP }else{ ?>
                                <span class="glyphicon glyphicon-eye-close"></span>
                            <?PHP }?>
                        </td>
                    </tr>
                    <?PHP }?>
                    </tbody>
                </table>
                <?PHP }?>
                </div><!-- */ table-responsive -->   
            </div><!-- */panel-body-1 -->
        </div><!-- */body-tab1 -->
<!--------------------------------------------------------------------->                   
    </div><!-- */tab-content -->
<!--------------------------------------------------------------------->
    </div><!-- */2 -->
</div><!-- */1 -->
<!--------------------------------------------------------------------->
        </div><!-- */f-3 -->
    </div><!-- */f-2 -->
</div><!-- */f-1 -->