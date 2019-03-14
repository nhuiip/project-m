<?
	$this->db->select("*");
	$this->db->where(array('fac_delete_status' => 1));
	$query = $this->db->get('tb_faculty');
	$listfac = $query->result_array();

	$this->db->select("*");
	$this->db->from('tb_stockproduct');	
	$this->db->join('tb_product', 'tb_product.product_id = tb_stockproduct.product_id');
	$this->db->join('tb_size', 'tb_size.size_id = tb_stockproduct.size_id');
	$this->db->where(array('tb_stockproduct.amount <=' => 50, 'tb_stockproduct.delete_status' => 1));
	$query = $this->db->get();
	$liststock = $query->result_array();

?>
<!DOCTYPE html>
<html>
	<head>
		<!-- <meta charset="utf-8"> -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Administrator</title>

		<link rel="icon" href="<?=base_url('assets/inspinia/images/logo/icon.png'); ?>" type="image/x-icon">
		<link rel="shortcut icon" href="<?=base_url('assets/inspinia/images/logo/icon.png'); ?>" type="image/x-icon">

		<link href="<?=base_url('assets/inspinia/css/bootstrap.min.css');?>" rel="stylesheet">
		<link href="<?=base_url('assets/inspinia/font-awesome/css/font-awesome.css');?>" rel="stylesheet">

		<!-- Toastr style -->
		<link href="<?=base_url('assets/inspinia/css/plugins/toastr/toastr.min.css');?>" rel="stylesheet">

		<!-- dataTables style -->
		<link href="<?=base_url('assets/inspinia/css/plugins/dataTables/datatables.min.css');?>" rel="stylesheet">


		<!-- Sweet Alert -->
		<link href="<?=base_url('assets/inspinia/css/plugins/sweetalert/sweetalert.css');?>" rel="stylesheet">

		<!-- footable -->
		<link href="<?=base_url('assets/inspinia/css/animate.css');?>" rel="stylesheet">
		<?PHP if(!empty($css)){echo $css;}?>
		<link href="<?=base_url('assets/inspinia/css/style.min.css');?>" rel="stylesheet">
		<script src="<?=base_url('assets/inspinia/js/lib/jquery-2.1.1.js');?>"></script>
		<script src="<?=base_url('assets/inspinia/js/lib/plugins/dataTables/datatables.min.js');?>"></script>
		<script data-main="<?=base_url('assets/inspinia/js/app.js');?>" src="<?=base_url('assets/inspinia/js/require.js');?>"></script>
	</head>

	<body class="pace-done">

		<div id="wrapper">

			<nav class="navbar-default navbar-static-side" role="navigation">
				<div class="sidebar-collapse">
					<ul class="nav metismenu" id="side-menu">
						<li class="nav-header">
						<div class="dropdown profile-element">
    					<center><img src="<?=base_url('assets/inspinia/images/logo/logo-login.png'); ?>" width="75%"></center>
						</div>
							<div class="logo-element">
								<img src="<?=base_url('assets/inspinia/images/logo/logo-login.png');?>" width="75%">
							</div>
						</li>
						<li>
							<a href="<?=site_url('managepage/pagecontents/index');?>">
								<i class="fa fa-list-alt"></i> <span class="nav-label">จัดการหน้าเพจ</span>
							</a>
						</li>
						<li>
							<a href="<?=site_url('managepage/intro/index');?>">
								<i class="fa fa-list-alt"></i> <span class="nav-label">จัดการ Intro</span>
							</a>
						</li>
						<li>
							<a href="<?=site_url('student/student/indexfac');?>"><i class="fa fa-user"></i> <span class="nav-label">จัดการข้อมูลนักศึกษา</span></a>
						</li>
						<li>
							<a href="<?=site_url('faculty/faculty/index');?>"><i class="fa fa-bank"></i> <span class="nav-label">จัดการข้อมูลคณะ</span></a>
						</li>
						<li>
							<a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">จัดการข้อมูลสินค้า</span><span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li><a href="<?=site_url('product/product/index/1');?>">ข้อมูลเครื่องแบบ</a></li>
								<li><a href="<?=site_url('product/product/index/2');?>">ข้อมูลเครื่องหมายและอุปกรณ์</a></li>
								<li><a href="<?=site_url('product/product/index/3');?>">ข้อมูลค่าใช้จ่าย</a></li>
								<li><a href="<?=site_url('product/size/index');?>">ข้อมูลขนาดเครื่องแบบ</a></li>
							</ul>
						</li>
						<li>
							<a href="<?=site_url('package/package/indexfac');?>"><i class="fa fa-exchange"></i> <span class="nav-label">จัดเซตเครื่องแบบ</span></a>
						</li>
						<li>
							<a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">ข้อมูลใบสั่งซื้อ</span><span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li><a href="<?=site_url('orders/orders/index/1');?>">รายการบังคับซื้อ</a></li>
								<li><a href="<?=site_url('orders/orders/index/2');?>">รายการสั่งซื้อเพิ่มเติม</a></li>
							</ul>
						</li>
						<li>
							<a href="<?=site_url('administrator/main');?>"><i class="fa fa-group"></i> <span class="nav-label">ผู้ดูแลระบบ</span></a>
						</li>
						<li>
						<li>
						<a href="<?=site_url('administrator/logout');?>"><i class="fa fa-sign-out"></i> <span class="nav-label">ออกจากระบบ</span></a>
						</li>
					</ul>
				</div>
			</nav>

			<div id="page-wrapper" class="gray-bg">
				<div class="row border-bottom">
					<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
						<div class="navbar-header">
							<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
						</div>
						<ul class="nav navbar-top-links navbar-right">
							<li>
								<span class="m-r-sm text-muted welcome-message">
									<?=$this->encryption->decrypt($this->input->cookie('sysn'));?>
								</span>
							</li>
							<li class="dropdown">
								<a class="dropdown-toggle count-info" data-toggle="dropdown" href="#" aria-expanded="true">
									<i class="fa fa-bell"></i>  <span class="label label-danger"><?=count($liststock);?></span>
								</a>
								<? if(count($liststock) != 0){ ?>
								<ul class="dropdown-menu dropdown-alerts">
									<? foreach ($liststock as $key => $value) {  ?>
									<li>
										<a href="<?=site_url('product/stock/index/'.$value['type_id'].'/'.$value['product_id']);?>">
											<div>
											<i class="fa fa-bell"></i>&nbsp;&nbsp;&nbsp; <?=$value['product_name'];?> stock is low
											</div>
										</a>
									</li>
									<? } ?>
								</ul>
								<? } ?>
							</li>

							<li>
								<a href="<?=site_url('administrator/logout');?>">
									<i class="fa fa-sign-out"></i> Logout
								</a>
							</li>
						</ul>

					</nav>
				</div>
				<?= $contents ?>
				<div class="footer">
					<div>
						<strong>Copyright</strong> Preedarat &copy; 2018
					</div>
				</div>

			</div>
		</div>
		<!-- <script>
			$('#collapse-link').metisMenu();
		</script> -->
		<?PHP if(!empty($js)){echo $js;}?>

	</body>

</html>
