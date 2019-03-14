
<div class="container">
<br>
<h4 class="headtext">ระบบสั่งซื้ออุปกรณ์สำหรับนักศึกษาใหม่</h4>
<hr>
	<form action="<?=site_url('main/finddata');?>" method="post" enctype="multipart/form-data" name="formFideData" id="formFideData" class="form-horizontal" novalidate>
		<div class="col-md-10" style="padding:0px;margin-bottom: 10px;">
        	<input style="margin:0px; border-radius:0px;" type="text" name="student_id" id="student_id" class="form-control input-lg" placeholder="กรุณากรอกรหัสนักศึกษา" value="<?PHP if(isset($student_id)){echo $student_id;}?>">
        </div>
        <div class="col-md-2" style="padding:0px">
            <button id="btn-example-sh" style="border-radius:0px;margin:0px 0px;" type="submit" class="btn btn-lg btn-block btn-default">ตกลง</button>
			<br><br>
		</div>
	</form>
	<?php if(isset($typeorder) && $typeorder == 0){ ?>
	<div class="col-md-8" style="padding-left:0px;">
	<div class="alert alert-danger" role="alert">
		<h3 style="margin: 0 0 10px;color:#FF0000;">คุณมีรายการสั่งซื้อเครื่องแบบนักศึกษาใหม่อยุ่แล้ว</h3>
		<h3 style="margin: 0 0 10px;color:#FF0000;">หากต้องการสั่งซื้อเพิ่มเติมกรุณาไปที่เมนูรายการเครื่องแบบ</h3>
	</div>
	</div>
	<?php } elseif(isset($typeorder) && count($typeorder) == 1){ ?>
	<div class="col-md-8" style="padding-left:0px;">
	<div class="alert alert-danger" role="alert">
		<h3 style="margin: 0 0 10px;color:#FF0000;">ไม่พบข้อมูล!!</h3>
		<h3 style="margin: 0 0 10px;color:#FF0000;">ไม่พบชุดเครื่องแบบที่คุณค้นหา กรุณาติดต่อเจ้าหน้าที่</h3>
	</div>
	</div>
	<?php } elseif(isset($liststudent) && count($liststudent) != 0){ ?>
		<form action="<?=site_url('main/addorder');?>" method="post" enctype="multipart/form-data" name="formAddorder" id="formAddorder" class="form-horizontal" novalidate>
		<!-- list product -->
		<div class="col-md-8" style="padding-left:0px;">
		<div class="table-responsive bottommargin">
			<? if(isset($listdetailpack) && count($listdetailpack) != 0){ ?>
			<table class="table cart">
				<thead>
					<tr>
						<th width="15%">#</th>
						<th class="cart-product-name" width="40%">รายการ</th>
						<th class="cart-product-price" width="15%">ราคา/หน่วย</th>
						<th class="cart-product-quantity" width="15%">จำนวน</th>
						<th class="cart-product-price" width="15%">ขนาด</th>
					</tr>
				</thead>
				<tbody>
					<? 
					$numrow = 1;
					foreach ($listdetailpack as $key => $value) { 
					?>
					<tr class="cart_item">
						<td class="cart-product-name" width="15%"><?=$numrow;?></td>
						<td class="cart-product-name" width="40%">
							<?=$value['product_name'];?>
							<input type="hidden" name="product_id[]" value="<?=$value['product_id'];?>">
						</td>
						<td class="cart-product-price" width="15%"><span class="amount">
						<?=$value['product_price']*$value['pieces'];?>
						<input type="hidden" name="price[]" value="<?=$value['product_price']*$value['pieces'];?>">
						</span></td>
						<td class="cart-product-quantity" width="15%">
							<div class="quantity clearfix">
								<input type="text" name="pieces[]" value="<?=$value['pieces'];?>" class="qty" readonly/>
							</div>
						</td>
						<td class="cart-product-price" width="15%">
						<?	
						if($value['type_id'] == 1){
							$this->db->select("*");
							$this->db->from('tb_stockproduct');	
							$this->db->join('tb_product', 'tb_product.product_id = tb_stockproduct.product_id');
							$this->db->join('tb_size', 'tb_size.size_id = tb_stockproduct.size_id');
							$this->db->where(array('tb_stockproduct.product_id' => $value['product_id'], 'tb_stockproduct.delete_status' => 1));
							$query = $this->db->get();
							$listsize = $query->result_array();
						?>
						<select class="form-control" name="size_id[]" id="size_id">
							<option value="">size</option>
							<? if(count($listsize) != 0){?>
								<? foreach($listsize as $key=>$value){?>	
									<option value="<?=$value['size_id']?>"><?=$value['size_name']?></option>
								<? } ?>
							<? } ?>
						</select>
						<? } else { ?>
							<input type="hidden" name="size_id[]" value="1">
						<? } ?>
						</td>
					</tr>
					<? $numrow++; } ?>
				</tbody>
			</table>
			</div>					
		</div>
		<input type="hidden" name="crforders" id="crforders" value="<?=$crforders;?>">
		<input type="hidden" value="<?=$student_id;?>" name="student_id">
		<input type="hidden" value="<?=$orders_total;?>" name="orders_total">
		<div class="col-md-4 clearfix" style="padding-right: 0px;">
			<h4 style="text-align: letf;margin: 0 0 10px;">รายละเอียด</h4>
			<hr style="margin: 5px 0px;">
			<h5 style="margin: 0 0 5px;">รหัสนักศึกษา : <?=$student_id;?></h5>
			<h5 style="margin: 0 0 5px;"><?=$fullname;?></h5>
			<h5 style="margin: 0 0 5px;">สาขาวิชา : <?=$dept_name;?></h5>
			<h5 style="margin: 0 0 5px;">หลักสูตร : <?=$course_status;?></h5>
			<h5 style="margin: 0 0 5px;">เพศ : <?=$sex_name;?></h5>
			<hr style="margin: 10px 0px;">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-sm-6" style="font-size:20px;font-weight:bold">Total</div>
					<div class="col-sm-6" style="color:#b33939;font-size:24px;font-weight:bold;text-align: right"><?=number_format($orders_total);?></div>
				</div>
			</div>
			<div class="row clearfix">
				<center>
				<label><input type="checkbox" id="check">&nbsp;&nbsp;&nbsp;กรุณาตรวจสอบข้อมูลส่วนตัวก่อนทำการสั่งซื้อ</label>
				<div class="col-md-12 col-xs-12 nopadding">
				<button id="btn-example-sh" style="border-radius:0px;margin:0px 0px;" type="submit" class="btn btn-lg btn-success">ยืนยันการสั่งซื้อ</button>
				</div>
				<center>
			</div>
		</div>
		</form>
		<? } else { ?>
			<div class="alert alert-danger" role="alert">
				<h3 style="margin: 0 0 10px;color:#FF0000;">ไม่พบข้อมูล!!</h3>
				<h3 style="margin: 0 0 10px;color:#FF0000;">ไม่พบรายการเครื่องแบบ กรุณาติดต่อเจ้าหน้าที่</h3>
			</div>
		<? } ?>
	<? } else { ?>
<hr>
<?PHP foreach ($listdata as $key => $value) { ?>
<div class="col-sm-12">
	<?=$value['con_detail_th'];?>
</div>
<?PHP } ?>
<?PHP } ?>
<br>
</div>