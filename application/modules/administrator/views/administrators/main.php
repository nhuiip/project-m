<!-- Breadcrumb for page -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Administrators</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>
            <li class="active">
                <strong>Administrators</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<!-- End breadcrumb for page -->
<div class="wrapper wrapper-content animated fadeInRight" style="padding: 20px 0px;">
<div class="row">
<div class="col12" id="boxs-consfix">
<!----------
  Contents for box
----------->
<div class="ibox float-e-margins">
  <div class="ibox-title"></div>
  <div class="ibox-content">
<!----------
  Contents for page
----------->
  <div class="row"><!-- add & search -->
    <div class="col-sm-6"></div>
    <div class="col-sm-6">
      <a href="<?=site_url('administrator/form');?>">
        <button class="btn btn-w-m btn-primary btn-sm pull-right">เพิ่มผู้ใช้</button>
      </a>
      <div class="input-group">
        <input type="text" placeholder="Search" name="search-draw" id="search-draw" class="input-sm form-control">
        <span class="input-group-btn">
          <button type="button" id="btnsearch" class="btn btn-sm btn-primary"> Go!</button>
        </span>
      </div>
    </div>
  </div><!-- end add & search -->
  <?PHP if(count($listdata) != 0){?>
  <table class="table table-striped table-hover dataTables-example" >
    <thead>
      <tr>
          <th width="10%">#</th>
          <th width="20%">ชื่อ</th>
          <th width="20%">Email</th>
          <th width="10%">เบอร์โทร</th>
          <th width="15%">แก้ไขล่าสุด</th>
          <th width="10%">จัดการ</th>
          <th width="15%">เข้าใช้ล่าสุด</th>
      </tr>
    </thead>
    <tbody>
    <?PHP foreach ($listdata as $key => $value) {?>
      <tr class="gradeX">
        <td width="10%"><strong><?="A".str_pad($value['ad_id'],5,"0",STR_PAD_LEFT);?></strong></td>
        <td width="20%" class="project-title">
          <?=$value['ad_fullname']?><br />
          <small><?=$value['position_name']?></small>
        </td>
        <td width="20%"><?=$value['ad_email']?></td>
        <td width="10%">
        <?php
          // $minus_sign = "-"; 
          // $part1 = substr( $value['ad_telnumber'] , 0 , -7 ); 
          // $part2 = substr( $value['ad_telnumber'] , 3, -4 ); 
          // $part3 = substr( $value['ad_telnumber'] , 7 ); 
          // echo $part1.$minus_sign.$part2.$minus_sign.$part3 ; 

          $minus_sign = "-"; 
          $part1 = substr( $value['ad_telnumber'] , 0 , -7 ); 
          $part2 = substr( $value['ad_telnumber'] , 3 , -4); 
          $part3 = substr( $value['ad_telnumber'] , 6 ); 
          echo $part1. $minus_sign. $part2. $minus_sign. $part3 ;
        ?>
        </td>
        <td width="15%">
          <?=$value['ad_lastedit_name'];?><br />
          <small class="text-muted">
            <i class="fa fa-clock-o"></i> <?=date('d/m/Y h:i A', strtotime($value['ad_lastedit_date']));?>
          </small>
        </td>
        <td width="10%"><!--- Action --->          
          <div class="btn-group" style="width:100%">
            <button class="btn btn-sm btn-default " type="button" style="width:70%">Action</button>
            <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:30%;">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" style="width:30%">
                <li><a href="<?=site_url('administrator/form/'.$value['ad_id']);?>"><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;แก้ไขข้อมูล</a></li>
                <li><a href="#" class="Btn-delete" data-url="<?=site_url('administrator/delete/'.$value['ad_id']);?>"><i class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;ลบข้อมูล</a></li>
                <li><a href="<?=site_url('administrator/formpassword/'.$value['ad_id']);?>"><i class="fa fa-repeat"></i>&nbsp;&nbsp;&nbsp;เปลี่ยนรหัสผ่าน</a></li>
            </ul>
          </div>
        </td><!--- end Action --->
        <td width="15%">
          <?PHP if($value['ad_lastlogin'] != "0000-00-00 00:00:00"){ ?><i class="fa fa-clock-o"></i> <?=date('d/m/Y h:i A', strtotime($value['ad_lastlogin']));?> <?PHP }else{?> - <?PHP }?>
        </td>
      </tr>
    <?PHP }?>
    </tbody>
  </table>
  <?PHP }?>
<!----------
  Contents for page
----------->
</div><!-- /ibox-content -->
</div><!-- /ibox float-e-margins -->
<!----------
  end contents for box
----------->
</div><!-- /col12 -->
</div><!-- /row -->
</div><!-- /wrapper -->
<div style="margin:10px 0px;">.</div>
