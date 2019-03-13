<html>
  <head>
    <title>ใบสั่งซื้อ</title>
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Sarabun:300,400,500"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
      integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
      crossorigin="anonymous"
    />
    <style>
      body {
        font-family: "Sarabun", sans-serif;
        font-weight: 300;
        font-size: 10px;
      }
      h1 h2 h3 h4 h5 h6 {
        font-weight: 300;
        margin: 0;
      }
      hr {
        margin-top: 0;
        margin-bottom: 0;
      }
      img {
        width: 100%;
      }
      p {
        font-size: 12px;
        font-weight: 300;
      }
    </style>
  </head>
  <body style="background-color:#dfe6e9;">
    <!-- content -->
    <!-- <div class="col-md-6 col-md-offset-3" style="background-color:#ffffff;padding: 20px 20;height:100vh"> -->
    <div
      class="col-md-6 col-md-offset-3"
      style="background-color:#ffffff;padding: 30px 20;"
      id="content"
    >
      <div id="hide" class="col-sm-12">
        <div class="col-sm-6">
          <a href="<?=site_url('main');?>">
          <button
            class="btn btn-default"
            style="font-size: 12px;font-weight: 300;"
          >
            <i class="fa fa-chevron-circle-left"></i>&nbsp;&nbsp;กลับหน้าหลัก
          </button>
          </a>
          <button
            class="btn btn-default"
            style="font-size: 12px;font-weight: 300;"
            id="btnprint"
          >
            <i class="fa fa-print"></i>&nbsp;&nbsp;Print
          </button>
        </div>
        <div class="col-sm-6">
          <p style="color: #FF0000;">
            ** กรุณาเก็บหลักฐานการสั่งซื้อเครื่องแบบนักศึกษา
            เพื่อใช้ในการรับเครื่องแบบนักศึกษา และ ชำระเงินกับเจ้าหน้าที่ **
          </p>
        </div>
      </div>
      <div id="hide2" class="col-sm-12" style="padding:0">
        <br />
        <hr />
        <br />
      </div>
      <table width="100%">
        <thead>
          <tr>
            <th width="50%">
              <h5>
                Order no:
                <?=$orders_number;?>
              </h5>
              <h5>
                Date:
                <?=$orders_date;?>
              </h5>
            </th>
            <th width="50%">
              <img
                src="<?=base_url('assets/inspinia/images/logo/logo-login.png');?>"
              />
            </th>
          </tr>
        </thead>
      </table>

      <br />
      <hr />

      <table width="100%">
        <thead>
          <tr>
            <th width="100%">
              <h6>
                รหัสนักศึกษา:
                <?=$student_id;?>
              </h6>
              <h6>
                ชื่อ-นามสกุล:
                <?=$fullname;?>
              </h6>
              <h6>
                สาขาวิชา:
                <?=$fac_name.', '.$dept_name;?>
              </h6>
              <h6><?=$sex_name.', '.$course_status;?></h6>
            </th>
          </tr>
        </thead>
      </table>
      <br />

      <table width="100%" rules="all" frame="box">
        <thead>
          <tr>
            <th width="10%">
              <center><h6>#</h6></center>
            </th>
            <th width="50%" style="padding:5px 10px;"><h6>รายการ</h6></th>
            <th width="10%">
              <center><h6>จำนวน</h6></center>
            </th>
            <th width="15%">
              <center><h6>ขนาด</h6></center>
            </th>
            <th width="15%">
              <center><h6>ราคา</h6></center>
            </th>
          </tr>
        </thead>

        <tbody>
          <? 
      $numrow = 1;
      foreach ($listdatail as $key =>
          $value) { ?>
          <tr>
            <td width="10%">
              <center>
                <p><?=$numrow;?></p>
              </center>
            </td>
            <td width="50%" style="padding:5px 10px;">
              <p><?=$value['product_name'];?></p>
            </td>
            <td width="10%">
              <center>
                <p><?=$value['pieces'];?></p>
              </center>
            </td>
            <td width="15%">
              <center>
                <p>
                  <? if($value['size_id'] == 1){
          echo '-';
        } else {
          echo $value['size_name'];
        }
        ?>
                </p>
              </center>
            </td>
            <td width="15%">
              <center>
                <h6><?=number_format($value['price']);?></h6>
              </center>
            </td>
          </tr>
          <? $numrow++ ; } ?>
          <tr>
            <td width="10%"></td>
            <td width="50%"></td>
            <td width="10%"></td>
            <td width="15%">
              <center><h5>total</h5></center>
            </td>
            <td width="15%">
              <center>
                <h5>
                  <font color="#FF0000"
                    ><?=number_format($orders_total);?></font
                  >
                </h5>
              </center>
            </td>
          </tr>
        </tbody>
      </table>
      <br />
      <!-- <h5>มหาวิทยาลัยเทคโนโลยีราชมงคลรัตนโกสินทร์ วิทยาเขตวังไกลกังวล</h5>
  <h6>Rajamangala University Of Technology Rattanakosin </h6> -->
      <br />
      <table width="100%">
        <thead>
          <tr>
            <th width="60%">
              <h5>
                มหาวิทยาลัยเทคโนโลยีราชมงคลรัตนโกสินทร์ วิทยาเขตวังไกลกังวล
              </h5>
              <h6>Rajamangala University Of Technology Rattanakosin</h6>
              <h6>ถนนเพชรเกษม (ก.ม. 242) ตำบล หนองแก</h6>
              <h6>อำเภอ หัวหิน จังหวัด ประจวบคีรีขันธ์ 77110</h6>
            </th>
            <th width="40%" style="text-align: right;">
              <br /><br />
              <h6>tel: 032-618500</h6>
              <h6>fax: 032-618-570</h6>
            </th>
          </tr>
        </thead>
      </table>
    </div>
    <!-- end content -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script>
      $("#btnprint").click(function() {
        $("#hide").hide();
        $("#hide2").hide();
        window.print();
        $("#hide").show();
        $("#hide2").show();
      });
    </script>
  </body>
</html>
