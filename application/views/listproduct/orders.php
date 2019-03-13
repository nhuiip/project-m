<?PHP
if(isset($listorders) && count($listorders) != 0){
  foreach ($listorders as $key => $value) {
    $orders_id	    = $value['orders_id'];
    $orders_number	= $value['orders_number'];
	$student_id 	= $value['student_id'];
	$name_title 	= $value['name_title'];
	$student_fname  = $value['student_fname'];
    $student_lname 	= $value['student_lname'];
    
	$arr = array($name_title, $student_fname, $student_lname,);
	$fullname = implode(" ",$arr);
  }
}
?>
<!-- Page Title
============================================= -->
<section id="page-title">
	<div class="container clearfix">
		<ol class="breadcrumb">
			<li><a href="#">หน้าแรก</a></li>
			<li class="active">รายการสั่งซื้อ</li>
		</ol>
	</div>
</section><!-- #page-title end -->
<!-- Content
============================================= -->
<section id="content" class="bottommargin">
	<div class="head-title">
		<h2 style="color:#b33939;">รายการสั่งซื้อ</h2>
		<hr>
	</div>
	<div class="container clearfix">
<!-- ============================================= -->
<div class="col-md-12" style="padding:0px;margin-bottom: 20px;padding-top:20px;">
<h3 style="margin-bottom: 10px;">เลขที่ใบสั่งซื้อ : <?=$orders_number;?></h3>
<h4 style="margin-bottom: 10px;"><?=$fullname;?> : <?=$student_id;?></h4>
</div>
<!-- <form action="<?=site_url('reproduct/finddata');?>" method="post" enctype="multipart/form-data" name="formFideData" id="formFideData" class="form-horizontal" validate> -->
<form action="<?=site_url('reproduct/update');?>" method="post" enctype="multipart/form-data" name="formOrderData" id="formOrderData" class="form-horizontal" novalidate>
<div class="col-md-9" style="border-right: solid 1px #b33939;border-top: double 2px #b33939;padding-left: 0px;">
<table class="table table-hover" width="100%">
    <thead>
        <tr>
        <th width="40%">รายการ</th>
        <th width="20%"><center>จำนวน</center></th>
        <th width="20%">ราคา</th>
        <th width="20%"></th>
        </tr>
    </thead>
    <tbody>
    <? foreach ($listdetailorders as $key => $value){
        $orders_id      = $value['orders_id'];
        $product_id     = $value['product_id']; 
        $size_id	    = $value['size_id'];
    ?>
        <tr>
        <td width="40%">
            <?=$value['product_name'];?>
            <? if($value['type_id'] == 1){ ?>
                <input type="hidden" name="ordersid" id="ordersid" value="<?=$orders_id;?>">
                <input type="hidden" name="orders_id[]" id="orders_id" value="<?=$orders_id;?>">
                <input type="hidden" name="product_id[]" id="product_id" value="<?=$product_id;?>">
            <? } ?>
        </td>
        <td width="20%">
            <center><?=$value['pieces'];?></center>
        </td>
        <td width="20%"><?=$value['total_price'];?></td>
        <td width="20%">
        <?php
        if($value['type_id'] == 1){
        $this->db->select("*");
        $this->db->from('tb_stockproduct');	
		$this->db->join('tb_product', 'tb_product.product_id = tb_stockproduct.product_id');
		$this->db->join('tb_size', 'tb_size.size_id = tb_stockproduct.size_id');
        $this->db->where(array('tb_stockproduct.product_id' => $value['product_id']));
        $query = $this->db->get();
        $listsize = $query->result_array();
        ?>
        <select id="size_id" name="size_id[]" class="form-control input-sm" required>
            <option value=" ">แก้ไขขนาด</option>
            <?PHP if(count($listsize) != 0){?>
            <?PHP foreach ($listsize as $key => $value) {?>
            <option value="<?=$value['size_id'];?>" <?PHP if(isset($size_id) and $size_id == $value['size_id']){echo 'selected';} ?> >
                <?=$value['size_name'];?>
            </option>
            <?PHP }?>
            <?PHP }?>
        </select>
        </td>
        </tr>
        
    <? } }?>
    </tbody>
</table>
</div>
<div class="col-md-3" style="border-top: double 2px #b33939;padding-top:20px;">
    <button type="button" style="border-radius:0px;" class="btn btn-block btn-primary btn-lg">สั่งซื้อเพิ่ม</button>
    <button type="submit" style="border-radius:0px;" class="btn btn-block btn-success btn-lg">ยืนยัน</button>
    <button type="button" style="border-radius:0px;" class="btn btn-block btn-danger btn-lg">ยกเลิก</button>
</div>
</form>
<!-- ============================================= -->
</div>
</section><!-- #content end -->