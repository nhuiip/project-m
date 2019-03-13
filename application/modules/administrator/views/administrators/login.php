<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator RMUTR</title>
    <!-- 
    [include css file] ------------------------------------------------------>
    <link rel="icon" href="<?=base_url('assets/inspinia/images/logo/icon.png'); ?>" type="image/x-icon">
		<link rel="shortcut icon" href="<?=base_url('assets/inspinia/images/logo/icon.png'); ?>" type="image/x-icon">
    <!-- <link rel="icon" href="<?=base_url('assets/inspinia/images/logo/icon.png'); ?>" type="image/x-icon">  -->
    <link rel="shortcut icon" href="<?=base_url('assets/inspinia/images/logo/icon.png'); ?>" type="image/x-icon">
    <link href="<?=base_url('assets/inspinia/css/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?=base_url('assets/inspinia/font-awesome/css/font-awesome.css');?>" rel="stylesheet">
    <link href="<?=base_url('assets/inspinia/css/animate.css');?>" rel="stylesheet">
    <link href="<?=base_url('assets/inspinia/css/style.min.css');?>" rel="stylesheet">
    <!-- 
    [end include css file] ------------------------------------------------------>
</head>
<style>
.colorgraph {
  height: 5px;
  border-top: 0;
  background: #86af48;
  border-radius: 5px;
  background-image: -webkit-linear-gradient(left, #86af48, #86af48 12.5%, #43883d 12.5%, #43883d 25%, #1f4377 25%, #1f4377 37.5%, #0062a3 37.5%, #0062a3 50%, #00939a 50%, #00939a 62.5%, #59cad6 62.5%, #59cad6 75%, #607378 75%, #607378 87.5%, #8a9a9a 87.5%, #8a9a9a);
  background-image: -moz-linear-gradient(left, #86af48, #86af48 12.5%, #43883d 12.5%, #43883d 25%, #1f4377 25%, #1f4377 37.5%, #0062a3 37.5%, #0062a3 50%, #00939a 50%, #00939a 62.5%, #59cad6 62.5%, #59cad6 75%, #607378 75%, #607378 87.5%, #8a9a9a 87.5%, #8a9a9a);
  background-image: -o-linear-gradient(left, #86af48, #86af48 12.5%, #43883d 12.5%, #43883d 25%, #1f4377 25%, #1f4377 37.5%, #0062a3 37.5%, #0062a3 50%, #00939a 50%, #00939a 62.5%, #59cad6 62.5%, #59cad6 75%, #607378 75%, #607378 87.5%, #8a9a9a 87.5%, #8a9a9a);
  background-image: linear-gradient(to right, #86af48, #86af48 12.5%, #43883d 12.5%, #43883d 25%, #1f4377 25%, #1f4377 37.5%, #0062a3 37.5%, #0062a3 50%, #00939a 50%, #00939a 62.5%, #59cad6 62.5%, #59cad6 75%, #607378 75%, #607378 87.5%, #8a9a9a 87.5%, #8a9a9a);
}

}
</style>
<body 
style="margin:0px;background: url('<?=base_url('assets/inspinia/images/img/bg-login.jpg'); ?>') center no-repeat;height: 100%;background-size:cover;">
<div class="col-md-4 col-md-offset-8" style="background-color: rgba(255, 255, 255, 0.8);height: 100%;vertical-align: middle;padding:180px 50px;">
    <center><img src="<?=base_url('assets/inspinia/images/logo/logo-login.png'); ?>" width="75%"></center>
    <hr class="colorgraph">
    <form class="m-t" role="form" method="post" action="<?=site_url('administrator/authen');?>">
        <input type="hidden" name="formcrf" id="formcrf" value="<?=$formcrf;?>">
        <div class="form-group">
            <div class="cols-sm-10">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                    <!-- <input type="email" class="form-control" name="username" id="username"  placeholder="Enter your Email"/> -->
                    <input type="text" class="form-control" name="username" placeholder="Username" required="" placeholder="Enter your Password">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="cols-sm-10">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock fa" aria-hidden="true"></i></span>
                    <!-- <input type="password" class="form-control" name="password" id="password"  placeholder="Enter your Password"/> -->
                    <input type="password" class="form-control" name="password" placeholder="Password" required="" placeholder="Enter your Password">                    
                </div>
            </div>
        </div>
        <p style="color:#333"><u>ลืมรหัสผ่าน?</u></p>
        <hr class="colorgraph">
        <?=$msg;?>
        <button type="submit" class="btn btn-block" style="border:0px;background-color:#6ab04c;border-radius: 0px;color:#FFFFFF;font-weight:600">Login</button>
        <button type="button" class="btn btn-block" style="border:0px;background-color:#535c68;border-radius: 0px;color:#FFFFFF;font-weight:600">Cancel</button>
    </form>
</div>    
</body>
</html>
