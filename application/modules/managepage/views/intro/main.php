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
<div style="text-align:right">
<a href="<?=site_url('managepage/intro/hidedata');?>">
<? if($intro_show == 1){ ?>
    <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-eye-slash"></i>&nbsp;&nbsp;&nbsp;ปิดการแสดงผล</button>
<? } elseif ($intro_show == 0) { ?>
    <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-eye"></i>&nbsp;&nbsp;&nbsp;เปิดการแสดงผล</button>
<? } ?>
</a>
<a href="<?=site_url('managepage/intro/form');?>">
    <button class="btn btn-default btn-sm" type="submit"><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;แก้ไข้ข้อมูล</button>
</a>
</div>
<hr>
<?=$intro_content;?>
<!-- end content -->
</div><!--/ibox-content-->
</div><!-- /col12 -->
</div><!-- /row -->
</div><!-- /wrapper -->
<div style="margin:10px 0px;"><br></div>
