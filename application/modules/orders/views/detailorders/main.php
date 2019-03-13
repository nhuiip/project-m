<!----------
  breadcrumb for page
----------->
<div class="row wrapper border-bottom white-bg page-heading" >
  <div class="col-lg-10">
    <h2>รายละเอียดใบสั่งซื้อ</h2>
    <ol class="breadcrumb">
      <li><a href="#">หน้าแรก</a></li>
      <li><a href="<?=site_url('orders/orders/index/'.$type);?>">ข้อมูลใบสั่งซื้อ</a></li>
      <li class="active"><strong>รายละเอียดใบสั่งซื้อ</strong></li>
    </ol>
  </div>
</div>
<!----------
  end breadcrumb for page
----------->
<div class="wrapper wrapper-content animated fadeInRight" style="padding: 20px 0px;">
<div class="row">
<div class="col12" id="boxs-consfix">
<!----------
  Contents for box
----------->
<div class="col-lg-12">
    <div class="ibox-title">
    <div class="col-md-2 col-md-offset-10">
        <!-- <button onclick="printdiv('thisprint');">Try it</button> -->
        <button class="btn btn-default btn-block" id="btn-print">
            <i class="fa fa-print"></i>&nbsp;&nbsp;Print
        </button>
    </div>
    <br><br><hr>
    </div>
    <div class="ibox float-e-margins">
        <div class="ibox-content" style="border-color: transparent;" id="thisprint">
<!----------
  Contents for page
----------->
<table width="100%">
    <thead>
        <tr>
        <th width="50%">
            <h5> Order no: <?=$orders_number;?></h5>
            <h5>Date:<?=$orders_date;?></h5>
        </th>
        <th width="50%">
            <img src="<?=base_url('assets/inspinia/images/logo/logo-login.png');?>" width="100%"/>
        </th>
        </tr>
    </thead>
</table>
<hr />
<table width="100%">
    <thead>
        <tr>
        <th width="100%">
            <h5>รหัสนักศึกษา: <?=$student_id;?></h5>
            <h5>ชื่อ-นามสกุล: <?=$fullname;?></h5>
            <h5>สาขาวิชา: <?=$fac_name.', '.$dept_name;?></h5>
            <h5><?=$sex_name.', '.$course_status;?></h5>
        </th>
        </tr>
    </thead>
</table>
<br>
<table width="100%" rules="all" frame="box">
    <thead>
        <tr>
            <th width="10%"><center>#</center></th>
            <th width="50%" style="padding:5px 10px;">รายการ</th>
            <th width="10%"><center>จำนวน</center></th>
            <th width="15%"><center>ขนาด</center></th>
            <th width="15%"><center>ราคา</center></th>
        </tr>
    </thead>
    <tbody>
    <? $numrow = 1;
    foreach ($listdatail as $key => $value) { ?>
        <tr>
            <td width="10%"><center><?=$numrow;?></center></td>
            <td width="50%" style="padding:5px 10px;"><?=$value['product_name'];?></td>
            <td width="10%"><center><?=$value['pieces'];?></center></td>
            <td width="15%">
                <center>
                <? if($value['size_id'] == 1){
                    echo '-';
                } else {
                    echo $value['size_name'];
                } ?>
                </center>
            </td>
            <td width="15%"><center><?=number_format($value['price']);?></center></td>
        </tr>
    <? $numrow++ ; } ?>
        <tr>
            <td width="10%"></td>
            <td width="50%"></td>
            <td width="10%"><br><br></td>
            <td width="15%">
                <center>total</center>
            </td>
            <td width="15%">
                <center>
                    <font color="#FF0000"><?=number_format($orders_total);?></font>
                </center>
            </td>
            </tr>
        </tbody>        
    </table>
<br>
<br>
<br>
<table width="100%">
<thead>
    <tr>
    <th width="60%">
        <h5>มหาวิทยาลัยเทคโนโลยีราชมงคลรัตนโกสินทร์ วิทยาเขตวังไกลกังวล</h5>
        <h5>Rajamangala University Of Technology Rattanakosin</h5>
        <h5>ถนนเพชรเกษม (ก.ม. 242) ตำบล หนองแก</h5>
        <h5>อำเภอ หัวหิน จังหวัด ประจวบคีรีขันธ์ 77110</h5>
    </th>
    <th width="40%" style="text-align: right;">
        <br /><br />
        <h5>tel: 032-618500</h5>
        <h5>fax: 032-618-570</h5>
    </th>
    </tr>
</thead>
</table>
<!----------
  end Contents for page
----------->
        </div>
    </div>
</div>
<!----------
  end contents for box
----------->
</div><!-- /col12 -->
</div><!-- /row -->
</div><!-- /wrapper -->
<div style="margin:10px 0px;">.</div>
