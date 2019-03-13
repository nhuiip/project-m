<?php

public function findlistregis(){

$shtext		= $this->input->post('shtext');
$shtype 	= $this->input->post('shtype');
echo $shtext;
die
$condition = array();
$condition['fide'] = "*";
$condition['where'] = array('odregis_number' => $odregis_number);
$test = $this->evenstour->listConfirm($condition);

if(isset($test) && count($test) != 0){
	foreach ($test as $key => $value) {
		$Id = $value['odregis_id'];
		$tour_id = $value['tour_id'];
	}
}

if(!empty($Id)){
	$result = array(
		'error' => false,
		'title' => "Completed!!",
		'msg' => "",
		'url' => site_url('evenstour/listcheckpay/'.$tour_id.'/'.$Id)
	);
		echo json_encode($result);

	} else {
	$result = array(
		'error' => true,
		'title' => "ผิดพลาด",
		'msg' => "ไม่พบเลขที่ใบสมัครที่คุณค้นหา!!."
	);
		echo json_encode($result);
	}
}