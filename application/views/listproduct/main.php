<div class="container">
<!-- content -->
<div class="col-sm-6">
	<br>
	<h4 class="headtext">รายการเครื่องแบบ</h4>
	<hr>
	<div class="table-responsive bottommargin">
		<table class="table cart">
			<thead>
				<tr>
					<th width="10%">#</th>
					<th class="cart-product-name" width="25%">รายการ</th>
					<th class="cart-product-price" width="40%">ราคา/หน่วย</th>
					<th class="cart-product-price" width="25%"></th>
				</tr>
			</thead>
			<tbody>
				<? 
				$numrow = 1;
				foreach ($listproduct as $key => $value) { 
				?>
				<tr class="cart_item">
					<td class="cart-product-name" width="10%"><?=$numrow;?></td>
					<td class="cart-product-name" width="25%">
						<?=$value['product_name'];?>
					</td>
					<td class="cart-product-price" width="40%"><span class="amount">
					<?=$value['product_price'];?>
					</span></td>
					<td class="cart-product-price" width="25%">
						<a href="<?=site_url('listproduct/cartdata/'.$value['product_id']);?>">
							<button type="button" class="btn btn-default btn-block" style="border-radius:0px;margin:0px 0px;">
								<i class="icon-shopping-cart" aria-hidden="true"></i> ใส่ตะกร้า
							</button>
						</a>
					</td>
				</tr>
				<? $numrow++; } ?>
			</tbody>
		</table>
	</div>		
</div><!-- end col-sm-6 -->	

<div class="col-sm-6">
	<?php if(isset($CartData) && count($CartData) != 0){ ?>
	<br>
	<h4 class="headtext">ตะกร้าสินค้า</h4>
	<hr>
	<div class="panel panel-default">
	<div class="panel-body">

	<div class="table-responsive">
	<form action="<?=site_url('listproduct/addorder');?>" method="post" enctype="multipart/form-data" name="formAddorder" id="formAddorder" class="form-horizontal" novalidate>
	<input type="hidden" name="crforders" id="crforders" value="<?=$crforders;?>">
		<table class="table cart">
			<thead>
				<tr>
					<th class="cart-product-name" width="30%">รายการ</th>
					<th class="cart-product-price" width="25%">ราคา/หน่วย</th>
					<th class="cart-product-quantity" width="10%">จำนวน</th>
					<th class="cart-product-price" width="25%">ขนาด</th>
					<th class="cart-product-price" width="10%"></th>
				</tr>
			</thead>
			<tbody>
				<? 
				$num = 0;
				foreach ($CartData as $key => $value) { 
				?>
				<tr class="cart_item">
					<td class="cart-product-name" width="30%">
					<?
					$this->db->select("*");
					$this->db->where(array('product_id' => $value['product_id']));
					$query = $this->db->get('tb_product');
					$listproduct = $query->result_array();

					echo $listproduct[0]['product_name'];
					?>
					<input type="hidden" name="product_id[]" value="<?=$value['product_id'];?>">
					</td>
					<td class="cart-product-price" width="25%"><span class="amount">
						<?=$listproduct[0]['product_price'];?>
					<input type="hidden" name="price[]" value="<?=$listproduct[0]['product_price'];?>">
					</span></td>
					<td class="cart-product-quantity" width="10%">
						<div class="quantity clearfix">
							<input type="text" name="pieces[]" id="pieces" value="1" class="qty"/>
						</div>
					</td>
					<td class="cart-product-price" width="25%">
						<?	
						if($listproduct[0]['type_id'] == 1){
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
					<td class="cart-product-price" width="10%">
						<a href="<?=site_url('/listproduct/delete/'.$num);?>">
							<button type="button" class="btn btn-danger" aria-label="ลบ" style="border-radius:0px;margin:0px 0px;">
							<i class="icon-trash"></i> <?//=$num?>
							</button>
						</a>
					</td>
				</tr>
				<? $num++; } ?>
			</tbody>
		</table>
		<hr>
		<div class="col-sm-8">
		<input type="text" class="form-control" value="" name="student_id" id="student_id" placeholder="รหัสนักศึกษา">
		</div>
		<div class="col-sm-4">
		<button type="submit" class="btn btn-success btn-block" style="border-radius:0px;margin:0px 0px;">ยืนยันการสั่งซื้อ</button>
		</div>
	</form>
	</div>

	</div>
	</div>
	<? } ?>
</div><!-- end col-sm-6 -->	
<!-- end container -->
</div>