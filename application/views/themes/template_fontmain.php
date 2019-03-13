<?PHP
	// Settings page
	$this->db->select("*");
	$this->db->where(array('set_id' => 1));
	$query = $this->db->get('tb_settings');
	$listsetting = $query->result_array();
	if(count($listsetting) != 0){
		foreach ($listsetting as $key => $value) {
			$set_linkfacebook 	= $value['set_linkfacebook'];
			$set_telcontact 		= $value['set_telcontact'];
			$set_faxcontact 		= $value['set_faxcontact'];
		}
	}

?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">

	<head>

		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<!-- <meta name="author" content="siam2web" /> -->

		<!-- Stylesheets
	============================================= -->
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="<?=base_url('assets/canvas/css/bootstrap.css');?>" type="text/css" />
		<link rel="stylesheet" href="<?=base_url('assets/canvas/style.min.css');?>" type="text/css" />
		<link rel="stylesheet" href="<?=base_url('assets/canvas/css/swiper.css');?>" type="text/css" />
		<link rel="stylesheet" href="<?=base_url('assets/canvas/css/dark.css');?>" type="text/css" />
		<link rel="stylesheet" href="<?=base_url('assets/canvas/css/font-icons.css');?>" type="text/css" />
		<link rel="stylesheet" href="<?=base_url('assets/canvas/css/animate.css');?>" type="text/css" />
		<link rel="stylesheet" href="<?=base_url('assets/canvas/css/magnific-popup.css');?>" type="text/css" />
		<link rel="stylesheet" href="<?=base_url('assets/canvas/css/responsive.css');?>" type="text/css" />
		<?PHP if(!empty($css)){echo $css;}?>
		<link rel="stylesheet" href="<?=base_url('assets/canvas/css/custom.css');?>" type="text/css" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<link rel="stylesheet" href="<?=base_url('assets/canvas/css/datepicker3.css');?>" type="text/css" />

		<!-- Document Title
	============================================= -->
		<title>RMUTR</title>
		<link rel="icon" href="<?=base_url('assets/inspinia/images/logo/icon.png'); ?>" type="image/x-icon">

	</head>

	<body class="stretched">

	<nav class="navbar navbar-default">
		<div class="container">
		  <!-- Brand and toggle get grouped for better mobile display -->
		  <div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			  <span class="sr-only">Toggle navigation</span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?=site_url('main');?>"><img src="<?=base_url('assets/inspinia/images/logo/logo-login.png');?>" width="45%"></a>
			<a class="navbar-brand" href="#">.</a>
		  </div>
	  
		  <!-- Collect the nav links, forms, and other content for toggling -->
		  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
			  <li ><a href="<?=site_url('main');?>"><strong>หน้าแรก</strong></a></li>
			  <li ><a href="<?=site_url('listproduct/index');?>"><strong>รายการเครื่องแบบ</strong></a></li>
			  <li ><a href="<?=site_url('cart/index');?>"><strong>ตะกร้าสินค้า</strong></a></li>
			</ul>
		  </div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	  </nav>
		<div style="width:100%;margin:0px;height: 400px;background: url('<?=base_url('assets/inspinia/images/img/bg-login.jpg'); ?>') center no-repeat;background-size:cover;">
		</div>
		<?=$contents ?>
		<!-- <button id="btncart" title="Cart">Cart</button> -->
		<div id="gotoTop" class="icon-angle-up"></div>

	<!-- Go To Top
	============================================= -->

		<!-- External JavaScripts
	============================================= -->
		<script type="text/javascript" src="<?=base_url('assets/canvas/js/lib/jquery.js')?>"></script>
		<script type="text/javascript" src="<?=base_url('assets/canvas/js/lib/plugins.js')?>"></script>

		<?PHP if(!empty($js)){echo $js;}?>

		<!-- Footer Scripts
		============================================= -->
		<?PHP if(!empty($js)){echo $js;}?>
	</body>

</html>