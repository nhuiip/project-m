<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once( BASEPATH .'database/DB'. EXT );
$db =& DB();
$query = $db->select('con_id, con_page_th');
$query = $db->get('tb_contents');
$result = $query->result();
foreach( $result as $row ){
  $route[str_replace("&","",str_replace(" ","",strtolower($row->con_page_th)))] = "main/pageDetail/".$row->con_id;
  // if(!empty($row->con_page_th)){
  //   $route[str_replace("&","",str_replace(" ","",strtolower($row->con_page_th)))] = "main/pageDetail/".$row->con_id;
  // }else if(!empty($row->con_page_en)){
  //   $route[str_replace("&","",str_replace(" ","",strtolower($row->con_page_en)))] = "main/pageDetail/".$row->con_id;
  // }
}
$route['default_controller'] = 'main/index';

// $query = $db->select('consub_id, consub_page_th, consub_page_en');
// $query = $db->get('tb_subcontents');
// $result = $query->result();
// foreach( $result as $row ){
//   $route[str_replace(" ","",strtolower($row->consub_page_th))] = "main/pagesubDetail/".$row->consub_id;
//   if(!empty($row->consub_page_th)){
//     $route[str_replace(" ","",strtolower($row->consub_page_th))] = "main/pagesubDetail/".$row->consub_id;
//   }else if(!empty($row->consub_page_en)){
//     $route[str_replace(" ","",strtolower($row->consub_page_en))] = "main/pagesubDetail/".$row->consub_id;
//   }
// }

$query = $db->select('*');
$db->where(array('intro_show' => 1));
$query = $db->get('tb_intro');
$listIntor = $query->result();
if(count($listIntor) != 0){
	$route['default_controller'] = 'main/pageintor';
}else{
	$route['default_controller'] = 'main/index';
}

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
