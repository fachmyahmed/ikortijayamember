<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('print_mz')){	
	function print_mz($data)
	{
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		die();
	}
}

if (!function_exists('lastq')){	
	function lastq()
	{
		$CI =& get_instance();
		die($CI->db->last_query());
	}
}

if (!function_exists('GetIdLang')){	
	function GetIdLang()
	{
		$CI =& get_instance();
		return $CI->session->userdata("id_lang");
	}
}

if (!function_exists('GetUserID')){	
	function GetUserID()
	{
		$CI =& get_instance();
		return $CI->session->userdata("MzID");
	}
}

if (!function_exists('GetDataMember')){	
	function GetDataMember()
	{
		$q = GetAll("member",array("id"=> "where/".GetUserID()));
		$r = $q->result_array();
		return $r[0];
	}
}

if (!function_exists('permission')){	
	function permission($page_back="")
	{
		$CI =& get_instance();
		if(!$CI->session->userdata("bahasa")) $CI->session->set_userdata("bahasa", "custom");
		
		if($CI->session->userdata("bahasa") == "custom_ind") $CI->session->set_userdata("id_lang", 2);
		else $CI->session->set_userdata("id_lang", 1);
		$CI->lang->load($CI->session->userdata("bahasa"), '');
		
		if(!$CI->session->userdata("MzID")){
			if($page_back) redirect("login/page/".$page_back);
			else redirect("login");
		}
	}
}

if (!function_exists('GetHeaderFooter')){	
	function GetHeaderFooter()
	{
		$CI =& get_instance();
		
		$data['header'] 	= 'header';
		$data['menu'] 		= 'menu';
		$data['footer'] 	= 'footer';
		$data['sidebar'] 	= 'sidebar';
		// $data['rFooter']	= get_data('tbl_contact',array('where_array'=>array('id'=>1)))->row();
		
		return $data;
	}
}

if (!function_exists('GetHeaderFooterProfile')){	
	function GetHeaderFooterProfile()
	{
		$CI =& get_instance();
		
		$data['header'] 	= 'headerprofile';
		$data['menu'] 		= 'menu';
		$data['footer'] 	= 'footerprofile';
		$data['sidebar'] 	= 'sidebar';
		// $data['rFooter']	= get_data('tbl_contact',array('where_array'=>array('id'=>1)))->row();
		
		return $data;
	}
}

if (!function_exists('GetValue')){
	function GetValue($field,$table,$filter=array(),$filter_where_in=array())
	{
		$CI =& get_instance();
		$CI->db->select($field);
		foreach($filter as $key=> $value)
		{
			$exp = explode("/",$value);
			if(isset($exp[1]))
			{
				if($exp[0] == "where") $CI->db->where($key, $exp[1]);
				else if($exp[0] == "like") $CI->db->like($key, $exp[1]);
				else if($exp[0] == "like_after") $CI->db->like($key, $exp[1], 'after');
				else if($exp[0] == "like_before") $CI->db->like($key, $exp[1], 'before');
				else if($exp[0] == "not_like") $CI->db->not_like($key, $exp[1]);
				else if($exp[0] == "not_like_after") $CI->db->not_like($key, $exp[1], 'after');
				else if($exp[0] == "not_like_before") $CI->db->not_like($key, $exp[1], 'before');
				else if($exp[0] == "wherebetween"){
					$xx=explode(',',$exp[1]);
				 $CI->db->where($key.' >=',$xx[0]);
				 $CI->db->where($key.' <=',$xx[1]);
				}
				else if($exp[0] == "order")
				{
					$key = str_replace("=","",$key);
					$CI->db->order_by($key, $exp[1]);
				}
				else if($key == "limit") $CI->db->limit($exp[1], $exp[0]);
			}
			
			if($exp[0] == "group") $CI->db->group_by($key);
		}
		
		foreach($filter_where_in as $key=> $value)
		{
			if(preg_match("/!=/", $key)) $CI->db->where_not_in(str_replace("!=","",$key), $value);
			else $CI->db->where_in($key, $value);
		}
		
		$q = $CI->db->get($table);
		foreach($q->result_array() as $r)
		{
			return $r[$field];
		}
		return 0;
	}
}

if (!function_exists('GetAll')){
	function GetAll($tbl,$filter=array(),$filter_where_in=array())
	{
		$CI =& get_instance();
		foreach($filter as $key=> $value)
		{
			// Multiple Like
			if(is_array($value))
			{
				$key = str_replace(" =","",$key);
				$like="";
				$v=0;
				foreach($value as $r=> $s)
				{
					$v++;
					$exp = explode("/",$s);
					if(isset($exp[1]))
					{
						if($exp[0] == "like")
						{
							if($key == "tanggal" || $key == "tahun")
							{
								$key = "tanggal";
								if(strlen($exp[1]) == 4)
								{
									if($v == 1) $like .= $key." LIKE '%".$exp[1]."-%' ";
									else $like .= " OR ".$key." LIKE '%".$exp[1]."-%' ";
								}
								else 
								{
									if($v == 1) $like .= $key." LIKE '%-".$exp[1]."-%' ";
									else $like .= " OR ".$key." LIKE '%-".$exp[1]."-%' ";
								}
							}
							else
							{
								if($v == 1) $like .= $key." LIKE '%".$exp[1]."%' ";
								else $like .= " OR ".$key." LIKE '%".$exp[1]."%' ";
							}
						}
					}
				}
				if($like) $CI->db->where("id > 0 AND ($like)");
				$exp[0]=$exp[1]="";
			}
			else $exp = explode("/",$value);
			
			if(isset($exp[1]))
			{
				if($exp[0] == "where") $CI->db->where($key, $exp[1]);
				else if($exp[0] == "like") $CI->db->like($key, $exp[1]);
				else if($exp[0] == "or_like") $CI->db->or_like($key, $exp[1]);
				else if($exp[0] == "like_after") $CI->db->like($key, $exp[1], 'after');
				else if($exp[0] == "like_before") $CI->db->like($key, $exp[1], 'before');
				else if($exp[0] == "not_like") $CI->db->not_like($key, $exp[1]);
				else if($exp[0] == "not_like_after") $CI->db->not_like($key, $exp[1], 'after');
				else if($exp[0] == "not_like_before") $CI->db->not_like($key, $exp[1], 'before');
				else if($exp[0] == "wherebetween"){
					$xx=explode(',',$exp[1]);
				 $CI->db->where($key.' >=',$xx[0]);
				 $CI->db->where($key.' <=',$xx[1]);
				}
				else if($exp[0] == "order")
				{
					$key = str_replace("=","",$key);
					$CI->db->order_by($key, $exp[1]);
				}
				else if($key == "limit") $CI->db->limit($exp[1], $exp[0]);
			}
			else if($exp[0] == "where") $CI->db->where($key);
			
			if($exp[0] == "group") $CI->db->group_by($key);
		}
		
		foreach($filter_where_in as $key=> $value)
		{
			if(preg_match("/!=/", $key)) $CI->db->where_not_in(str_replace("!=","",$key), $value);
			else $CI->db->where_in($key, $value);
		}
		
		$q = $CI->db->get($tbl);
		//die($CI->db->last_query());
		
		return $q;
	}
}

if (!function_exists('GetAllSelect')){
	function GetAllSelect($tbl,$select,$filter=array(),$filter_where_in=array())
	{
		$CI =& get_instance();
		$CI->db->select($select);
		foreach($filter as $key=> $value)
		{
			// Multiple Like
			if(is_array($value))
			{
				$key = str_replace(" =","",$key);
				$like="";
				$v=0;
				foreach($value as $r=> $s)
				{
					$v++;
					$exp = explode("/",$s);
					if(isset($exp[1]))
					{
						if($exp[0] == "like")
						{
							if($key == "tanggal" || $key == "tahun")
							{
								$key = "tanggal";
								if(strlen($exp[1]) == 4)
								{
									if($v == 1) $like .= $key." LIKE '%".$exp[1]."-%' ";
									else $like .= " OR ".$key." LIKE '%".$exp[1]."-%' ";
								}
								else 
								{
									if($v == 1) $like .= $key." LIKE '%-".$exp[1]."-%' ";
									else $like .= " OR ".$key." LIKE '%-".$exp[1]."-%' ";
								}
							}
							else
							{
								if($v == 1) $like .= $key." LIKE '%".$exp[1]."%' ";
								else $like .= " OR ".$key." LIKE '%".$exp[1]."%' ";
							}
						}
					}
				}
				if($like) $CI->db->where("id > 0 AND ($like)");
				$exp[0]=$exp[1]="";
			}
			else $exp = explode("/",$value);
			
			if(isset($exp[1]))
			{
				if($exp[0] == "where") $CI->db->where($key, $exp[1]);
				else if($exp[0] == "like") $CI->db->like($key, $exp[1]);
				else if($exp[0] == "like_after") $CI->db->like($key, $exp[1], 'after');
				else if($exp[0] == "like_before") $CI->db->like($key, $exp[1], 'before');
				else if($exp[0] == "not_like") $CI->db->not_like($key, $exp[1]);
				else if($exp[0] == "not_like_after") $CI->db->not_like($key, $exp[1], 'after');
				else if($exp[0] == "not_like_before") $CI->db->not_like($key, $exp[1], 'before');
				else if($exp[0] == "order")
				{
					$key = str_replace("=","",$key);
					$CI->db->order_by($key, $exp[1]);
				}
				else if($key == "limit") $CI->db->limit($exp[1], $exp[0]);
			}
			else if($exp[0] == "where") $CI->db->where($key);
			
			if($exp[0] == "group") $CI->db->group_by($key);
		}
		
		foreach($filter_where_in as $key=> $value)
		{
			$CI->db->where_in($key, $value);
		}
		
		$q = $CI->db->get($tbl);
		//die($CI->db->last_query());
		
		return $q;
	}
}



if (!function_exists('GetJoin')){
	function GetJoin($tbl,$tbl_join,$condition,$type,$select,$filter=array(),$filter_where_in=array())
	{
		$CI =& get_instance();
		$CI->db->select($select);
		foreach($filter as $key=> $value)
		{
			// Multiple Like
			if(is_array($value))
			{
				if($key == "group") $CI->db->group_by($value);
				$exp[0]=$exp[1]="";
			}
			else $exp = explode("/",$value);
			if(isset($exp[1]))
			{
				if($exp[0] == "where") $CI->db->where($key, $exp[1]);
				else if($exp[0] == "like") $CI->db->like($key, $exp[1]);
				else if($exp[0] == "or_like") $CI->db->or_like($key, $exp[1]);
				else if($exp[0] == "order") $CI->db->order_by($key, $exp[1]);
				else if($key == "limit") $CI->db->limit($exp[1], $exp[0]);
			}
			
			if($exp[0] == "group") $CI->db->group_by($key);
		}
		
		foreach($filter_where_in as $key=> $value)
		{
			if(preg_match("/!=/", $key)) $CI->db->where_not_in(str_replace("!=","",$key), $value);
			else $CI->db->where_in($key, $value);
		}
		
		$CI->db->join($tbl_join, $condition, $type);
		$q = $CI->db->get($tbl);
		//die($CI->db->last_query());
		
		return $q;
	}
}

if (!function_exists('GetSum')){
	function GetSum($table,$field,$filter=array(),$get="")
	{
		$CI =& get_instance();
		$CI->db->select("SUM($field) as total");
		foreach($filter as $key=> $value)
		{
			$exp = explode("/",$value);
			if(isset($exp[1]))
			{
				if($exp[0] == "where") $CI->db->where($key, $exp[1]);
				else if($exp[0] == "like") $CI->db->like($key, $exp[1]);
				else if($exp[0] == "order") $CI->db->order_by($key, $exp[1]);
				else if($key == "limit") $CI->db->limit($exp[1], $exp[0]);
			}
			
			if($exp[0] == "group") $CI->db->group_by($key);
		}
		
		$q = $CI->db->get($table);
		
		if($get == "value")
		{
			$val = 0;
			//die($CI->db->last_query());
			foreach($q->result_array() as $r) $val=$r['total'];
			return $val;
		}
		else return $q;
	}
}

if (!function_exists('GetUrlDate')){	
	function GetUrlDate($date)
	{
		$exp1 = explode(" ", $date);
		$exp = explode("-",$exp1[0]);
		return $exp[2]."/".$exp[1]."/".$exp[0];
	}
}

if (!function_exists('ExplodeNameFile')){
	function ExplodeNameFile($source)
	{
		$ext = strrchr($source, '.');
		$name = ($ext === FALSE) ? $source : substr($source, 0, -strlen($ext));

		return array('ext' => $ext, 'name' => $name);
	}
}

if (!function_exists('GetThumb')){	
	function GetThumb($image, $path="_thumb")
	{
		$exp = ExplodeNameFile($image);
		return $exp['name'].$path.$exp['ext'];
	}
}

if (!function_exists('ResizeImage')){	
	function ResizeImage($up_file,$w,$h)
	{
		//Resize
		$CI =& get_instance();
		$config['image_library'] = 'gd2';
		$config['source_image'] = $up_file;
		$config['dest_image'] = "./".$CI->config->item('path_upload')."/";
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = FALSE; //Width=Height
		$config['height'] = $h;
		$config['width'] = $w;
		
		$CI->load->library('image_lib', $config);
		if($CI->image_lib->resize()) return 1;
		else return 0; 
	}
}

if (!function_exists('InputFile')){
	function InputFile($filez,$filesize=500)
	{
		$CI =& get_instance();
		$file_up = $_FILES[$filez]['name'];
		$file_up = date("YmdHis").".".str_replace("-","_",url_title($file_up));
		$myfile_up	= $_FILES[$filez]['tmp_name'];
		$ukuranfile_up = $_FILES[$filez]['size'];
		if($filez == "photo")
		$up_file = "./".$CI->config->item('path_upload')."/foto/".$file_up;
		else
		$up_file = "./".$CI->config->item('path_upload')."/".$file_up;
		
		$ext_file = strrchr($file_up, '.');
		if($ukuranfile_up < ($filesize * 1024))
		{
			if(strtolower($ext_file) == ".jpg" || strtolower($ext_file) == ".JPG" ||strtolower($ext_file) == ".jpeg" || strtolower($ext_file) == ".png")
			{
				if(copy($myfile_up, $up_file))
				{
					ResizeImage($up_file, 250, 250);
					return $file_up;
				}
			}
			//else if(strtolower($ext_file) == ".doc" || strtolower($ext_file) == ".docx" || strtolower($ext_file) == ".pdf")
			else
			{
				if(copy($myfile_up, $up_file))
				{
					return $file_up;
				}
				else return 3;
			}
		}
		else return 2;
	}
}

if (!function_exists('GetImageSiz')){
	function GetImageSiz($file, $size_w, $size_h)
	{
		/*list($w, $h) = getimagesize($file);
		if($w < $h) 
		{
			$w = $size_w / $size_h * $h;
			$style="style='width:".$w."px'";
		}
		else
		{
			$h = $size_w / $w * $size_h;
			$style="style='height:".$h."px'";
		}*/
		$style="style='height:".$size_h."px'";
		return $style;
	}
}


if (!function_exists('Page')){
	function Page($jum_record,$lmt,$pg,$path,$uri_segment)
	{
		$link = "";
		$config['base_url'] = $path;
		$config['total_rows'] = $jum_record;
		$config['per_page'] = $lmt;
		$config['num_links'] = 3;
		$config['cur_tag_open'] = '<li><strong>';
		$config['cur_tag_close'] = '</strong></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['uri_segment'] = $uri_segment;
		
		$CI =& get_instance();
		$CI->pagination->initialize($config);
		$link = $CI->pagination->create_links();
		return $link;
	}
}

if (!function_exists('PageFront')){
	function PageFront($jum_record,$lmt,$pg,$path,$uri_segment)
	{
		$link = "";
		$config['base_url'] = $path;
		$config['total_rows'] = $jum_record;
		$config['per_page'] = $lmt;
		$config['num_links'] = 2;
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li class="page_link next-pages">';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="page_link prev-pages">';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['uri_segment'] = $uri_segment;
		$config['last_link'] = '&raquo;';
		$config['first_link'] = '&laquo;';
		$config['display_pages'] = TRUE; 
		
		$CI =& get_instance();
		$CI->pagination->initialize($config);
		$link = $CI->pagination->create_links();
		return $link;
	}
}

if (!function_exists('createPassword')){	
	function createPassword()
	{
		$pass = "";
		$jum = rand(1,7);
		
		//Huruf
		$huruf = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		for($i=1;$i<=$jum;$i++)
		{
			$pass .= substr($huruf,rand(0,51),1);
		}
		
		//Angka
		$angka = "0123456789";
		for($i=1;$i<=8-$jum;$i++)
		{
			$pass .= substr($angka,rand(0,9),1);
		}
		
		return $pass;
	}
}

if (!function_exists('GetOptAll')){	
	function GetOptAll($tabel, $judul=NULL)
	{
		if($tabel == 'workshop')
		{
			$CI =& get_instance();
			$sql = "select id_workshop,count(*) as jum from kg_workshop_view where ((member_payment='Online Payment' and reg_no != 'NULL') OR member_payment !='Online Payment') AND (work_payment!='Online Payment' OR (work_payment='Online Payment' and status_invoice_e='Paid')) group by id_workshop order by id";
			$q = $CI->db->query($sql);
			$not_in="";
			foreach($q->result_array() as $r)
			{
				if($r['jum'] >= 50) $not_in .= "'".$r['id_workshop']."',";
			}
			$not_in = substr($not_in,0,-1);
			
			$sql = "select * from kg_".$tabel." where id not in (".$not_in.")";
			$q = $CI->db->query($sql);
		}
		else 
		{
			$q = GetAll($tabel);
		}
		if($judul) $opt[''] = $judul;
		foreach($q->result_array() as $r)
		{
			$opt[$r['id']] = $r['title'];
		}
		
		return $opt;
	}
}

if (!function_exists('CaptchaSecurityImages')){	
	function CaptchaSecurityImages($width='120',$height='40',$characters='6') 
	{
		$CI =& get_instance();
		$font = './assets/font/monofont.ttf';
		$code = generateCode($characters);
		/* font size will be 75% of the image height */
		$font_size = $height * 0.75;
		$image = @imagecreate($width, $height) or die('Cannot initialize new GD image stream');
		/* set the colours */
		$background_color = imagecolorallocate($image, 255, 255, 255);
		$text_color = imagecolorallocate($image, 20, 40, 100);
		$noise_color = imagecolorallocate($image, 100, 120, 180);
		/* generate random dots in background */
		for( $i=0; $i<($width*$height)/3; $i++ ) {
			imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noise_color);
		}
		/* generate random lines in background */
		for( $i=0; $i<($width*$height)/150; $i++ ) {
			imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noise_color);
		}
		/* create textbox and add text */
		$textbox = imagettfbbox($font_size, 0, $font, $code) or die('Error in imagettfbbox function');
		$x = ($width - $textbox[4])/2;
		$y = ($height - $textbox[5])/2;
		imagettftext($image, $font_size, 0, $x, $y, $text_color, $font , $code) or die('Error in imagettftext function');
		
		
		/* output captcha image to browser */
		header('Content-Type: image/jpeg');
		imagejpeg($image);
		imagedestroy($image);
		$CI->session->set_userdata("security_code", $code);
	}
}

if (!function_exists('GetMonthIndo')){	
	function GetMonthIndo($val)
	{
		$bln = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		
		return $bln[intval($val)];
	}
}

if (!function_exists('GetMonth')){	
	function GetMonth($id)
	{
		$bln = array("","Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nop","Des");
		//$bln = array("","Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Dec");
		return $bln[intval($id)];
	}
}

if (!function_exists('GetMonthFull')){	
	function GetMonthFull($id)
	{
		$id=intval($id);
		//$bln = array("","January","February","March","April","May","June","July","August","September","October","November","December");
		$bln = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		return $bln[intval($id)];
	}
}

if (!function_exists('to_excel')){
	function to_excel($content, $filename='xlsoutput')
	{
		$headers = '';
	  header("Content-type: application/x-msdownload");
	  header("Content-Disposition: attachment; filename=$filename.xls");
	  echo "$headers\n$content";
	}
}

if (!function_exists('to_doc'))
{
	function to_doc($query, $filename='docoutput')
	{
		header("Content-type: application/msword");
	  header("Content-Disposition: attachment; filename=$filename.doc");
	  echo "$query";
	}
}


if (!function_exists('FormatTanggalIndo')){
	function FormatTanggalIndo($tgl)
	{
		$exp = explode("-", substr($tgl, 0,10));
		$tgl = $exp[2]."-".$exp[1]."-".$exp[0];
		return $tgl;
	}
}

if (!function_exists('FormatTanggalIndoFull')){
	function FormatTanggalIndoFull($tgl)
	{
		$exp = explode("-", substr($tgl, 0,10));
		$tgl = $exp[2]."-".GetMonthIndo($exp[1])."-".$exp[0];
		return $tgl;
	}
}

if (!function_exists('FormatTanggalTimeIndo')){
	function FormatTanggalTimeIndo($tgl)
	{
		$exp2 = explode(" ",$tgl);
		$exp = explode("-", $exp2[0]);
		$tgl = $exp[2]."-".$exp[1]."-".$exp[0]." ".$exp2[1];
		return $tgl;
	}
}

if(!function_exists('UpdateHits')){	
	function UpdateHits($table, $id)
	{
		$CI =& get_instance();
		$last_hits = GetValue("hits", $table, array("id"=> "where/".$id));
		$last_hits++;
		$data = array("hits"=> $last_hits);
		$CI->db->where("id", $id);
		$CI->db->update($table, $data);
	}
}

if (!function_exists('Number')){
	function Number($rp)
	{
		if($rp) return number_format($rp,0);
		else return 0;
	}
}

if (!function_exists('CekExtFile')){
	function CekExtFile($file)
	{
		$ext = strrchr($file, '.');
		if($ext == ".pdf") $cls = "zpdf";
    else if($ext == ".doc" || $ext == ".docx") $cls = "zdoc";
    else if($ext == ".xls" || $ext == ".xlsx") $cls = "zxls";
    else if($ext == ".ppt" || $ext == ".pptx") $cls = "zppt";
    else $cls="";
    
    return $cls;
	}
}

if (!function_exists('CekIconFile')){
	function CekIconFile($file)
	{
		$ext = strrchr($file, '.');
		if($ext == ".pdf") $icon = "icon_pdf.png";
    else if($ext == ".doc" || $ext == ".docx") $icon = "icon_docx.png";
    else if($ext == ".xls" || $ext == ".xlsx") $icon = "icon_xlsx.png";
    else if($ext == ".ppt" || $ext == ".pptx") $icon = "icon_pptx.png";
    else $icon="";
    
    return $icon;
	}
}

if (!function_exists('GetFileSize')){
	function GetFileSize($file)
	{
		$size = ceil(filesize("./uploads/".$file) / 1024);
		return $size." Kb";
	}
}

if (!function_exists('Rupiah')){
	function Rupiah($rp)
	{
		if($rp && $rp!="-") return "Rp ".number_format($rp,0,",",".").",-";
		else return 0;
	}
}

//-------------------------------------------------- Ibef ---------------------------------------------------//
function input(){
	$value  = post();
	$data = array();
	foreach($value as $key => $val){
			if( $key != 'id' && $key != 'icon' && $key != 'old_icon' && $key != 'file' && $key != 'old_file' && !is_array($val)){
					if($key == "password"){
							if($val) {
									$data[$key] = password_hash(md5($val),PASSWORD_DEFAULT,array('cost'=>COST));
							}
					}else
							$data[$key] = $val;
			}
	}
	return $data;
}

function post($post = ""){
	$CI = get_instance();
	if($post) return xss_clean($CI->input->post($post));
	else return xss_clean($CI->input->post());
}

function get($get = ""){
	$CI = get_instance();
	if($get) return $CI->input->get($get);
	else return $CI->input->get();
}

function uri_segment($segment=0) {
	$CI = get_instance();
	return $CI->uri->segment($segment);
}

function langDate($date="",$full_date=true) {
	if(!$date)  $date = date('Y-m-d H:i:s');
	$arrayBulan = array(lang('lbl_january'), lang('lbl_february'), lang('lbl_march'), lang('lbl_april'), lang('lbl_may'), lang('lbl_june'), lang('lbl_july'), lang('lbl_august'), lang('lbl_september'), lang('lbl_october'), lang('lbl_november'), lang('lbl_december'));
	$tahun      = date('Y',strtotime($date));
	$bulan      = date('m',strtotime($date));
	$tgl        = date('d',strtotime($date));
	$result     = $tgl . " " . $arrayBulan[(int)$bulan-1] . " ". $tahun;
	if($date == date('Y-m-d H:i:s',strtotime($date)) && $full_date){
			$result .= ' '.date('H:i',strtotime($date));
	}
	return($result);
}

function langIndo($date="",$full_date=true) {
	if(!$date)  $date = date('Y-m-d H:i:s');
	$arrayBulan = array('Januari','Pebruari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
	$tahun      = date('Y',strtotime($date));
	$bulan      = date('m',strtotime($date));
	$tgl        = date('d',strtotime($date));
	$result     = $tgl . " " . $arrayBulan[(int)$bulan-1] . " ". $tahun;
	if($date == date('Y-m-d H:i:s',strtotime($date)) && $full_date){
			$result .= ' '.date('H:i',strtotime($date));
	}
	return($result);
}

function view($list_view="",$data=array(),$access=TRUE){
	$CI = get_instance();
	$explode = explode(':',$list_view);
	if(count($explode) == 2) {
			if(!$access){
					$data['menu_active']    = 'active-white';
					$page                   = 'errors/403.php';
					$i = 0;
					if(is_array($page)){
							foreach($page as $p){
									if($i == 0)
											$CI->load->view($p,$data);
									else 
											$CI->load->view($p);
											$i++;
							}
					} else {
							$CI->load->view('template/header',$data);
							$CI->load->view('template/menu');
							$CI->load->view($page);
							$CI->load->view('template/footer');
					}
			} else {
					if(isset($data['lock']) && $data['lock']){
							$CI->load->view('errors/lock',$data);
					} else {
							$CI->load->view('template/header',$data);
							$CI->load->view('template/menu');
							$explode2   = explode('|',$explode[1]);
							foreach ($explode2 as $e){
									if($e)
											$CI->load->view($e);
											$CI->load->view('template/footer');
							}
					}
			}
	} else {
			$i = 0;
			if (is_array($list_view)) {
					foreach($list_view as $l){
							if($i == 0)
									$CI->load->view($l,$data);
							else
									$CI->load->view($l);
									$i++;
					}
			} else 
					$CI->load->view($list_view,$data);
	}
}

function debug($array = array()){
	echo '<pre>';
	print_r($array);
	echo '<pre>';
}

/*----- Query -----*/
function db_query($query=""){
	$CI         = get_instance();
	$db_active  = $CI->session->userdata('db_active');
	$db_active  = $db_active ? $db_active : 'default';
	$db_group   = $CI->load->database($db_active,TRUE);
	return $db_group->query($query);
}

function get_data($table="",$attr=array()){
	$CI         = get_instance();
	$db_active  = $CI->session->userdata('db_active');
	$db_group   = $db_active ? $CI->load->database($db_active,TRUE) : $CI->db;
	if(isset($attr['select']))
			$db_group->select($attr['select'],false);
			if(isset($attr['select_max']))
					$db_group->select_max($attr['select_max']);
					if(isset($attr['select_min']))
							$db_group->select_min($attr['select_min']);
							if(isset($attr['select_sum']))
									$db_group->select_sum($attr['select_sum']);
									if(isset($attr['array_in']) && count($attr['array_in'])!=0 && isset($attr['field_in']))
											$db_group->where_in($attr['field_in'],$attr['array_in']);
											if(isset($attr['where_in']) && is_array($attr['where_in'])) {
													foreach($attr['where_in'] as $field => $arr) {
															$db_group->where_in($field,$arr);
													}
											}
											if(isset($attr['array_not_in']) && count($attr['array_not_in'])!=0 && isset($attr['field_not_in']))
													$db_group->where_not_in($attr['field_not_in'],$attr['array_not_in']);
													if(isset($attr['where_not_in']) && is_array($attr['where_not_in'])) {
															foreach($attr['where_not_in'] as $field => $arr) {
																	$db_group->where_not_in($field,$arr);
															}
													}
													if(isset($attr['sort']))
															$sort = $attr['sort'];
															else
																	$sort = 'ASC';
																	if(isset($attr['sort_by']))
																			$db_group->order_by($attr['sort_by'],$sort);
																			if(isset($attr['sort_array']) && count($attr['sort_array']) > 0){
																					foreach($attr['sort_array'] as $k_sa => $sa){
																							$db_group->order_by($k_sa,$sa);
																					}
																			}
																			if(isset($attr['where_field'])){
																					if(is_array($attr['where_field'])){
																							foreach($attr['where_field'] as $wf){
																									$db_group->where($wf);
																							}
																					}else{
																							if(isset($attr['where']))
																									$db_group->where($attr['where_field'],$attr['where']);
																									else
																											$db_group->where($attr['where_field']);
																					}
																			}
																			if(isset($attr['where_or_field'])){
																					if(isset($attr['where_or']))
																							$db_group->or_where($attr['where_or_field'],$attr['where_or']);
																							else
																									$db_group->or_where($attr['where_or_field']);
																			}
																			if(isset($attr['group_by'])){
																					if(is_array($attr['group_by'])){
																							foreach($attr['group_by'] as $g){
																									$db_group->group_by($g);
																							}
																					}else
																							$db_group->group_by($attr['group_by']);
																			}
																			if(isset($attr['limit']) && $attr['limit'] > 0){
																					if(isset($attr['offset']))
																							$db_group->limit($attr['limit'],$attr['offset']);
																							else
																									$db_group->limit($attr['limit']);
																			}
																			if(isset($attr['join']) && isset($attr['join_on'])){
																					if(isset($attr['join_type']))
																							$db_group->join($attr['join'],$attr['join_on'],$attr['join_type']);
																							else
																									$db_group->join($attr['join'],$attr['join_on']);
																			}
																			if(isset($attr['multi_join'])){
																					foreach($attr['multi_join'] as $mj){
																							if(isset($mj['type']))
																									$db_group->join($mj['join'],$mj['on'],$mj['type']);
																									else
																											$db_group->join($mj['join'],$mj['join_on']);
																					}
																			}
																			if(isset($attr['like']) && is_array($attr['like'])) {
																					foreach($attr['like'] as $k_lk => $v_lk) {
																							if(is_array($v_lk)) {
																									foreach($v_lk as $k => $vlk) {
																											$db_group->like($k_lk,$vlk);
																									}
																							} else {
																									$db_group->like($k_lk,$v_lk);
																							}
																					}
																			}
																			if(isset($attr['field_like']) && isset($attr['like']))
																					$db_group->like($attr['field_like'],$attr['like']);
																					if(isset($attr['field_or_like']) && isset($attr['or_like']))
																							$db_group->or_like($attr['field_or_like'],$attr['or_like']);
																							if(isset($attr['or_like']) && is_array($attr['or_like'])) {
																									foreach($attr['or_like'] as $k_lk => $v_lk) {
																											if(is_array($v_lk)) {
																													foreach($v_lk as $k => $vlk) {
																															if($k == 0) {
																																	$db_group->like($k_lk,$vlk);
																															} else {
																																	$db_group->or_like($k_lk,$vlk);
																															}
																													}
																											} else {
																													$db_group->or_like($k_lk,$v_lk);
																											}
																									}
																							}
																							if(isset($attr['not_like']) && is_array($attr['not_like'])) {
																									foreach($attr['not_like'] as $k_lk => $v_lk) {
																											if(is_array($v_lk)) {
																													foreach($v_lk as $k => $vlk) {
																															$db_group->not_like($k_lk,$vlk);
																													}
																											} else {
																													$db_group->not_like($k_lk,$v_lk);
																											}
																									}
																							}
																							if(isset($attr['or_not_like']) && is_array($attr['or_not_like'])) {
																									foreach($attr['or_not_like'] as $k_lk => $v_lk) {
																											if(is_array($v_lk)) {
																													foreach($v_lk as $k => $vlk) {
																															if($k == 0) {
																																	$db_group->not_like($k_lk,$vlk);
																															} else {
																																	$db_group->or_not_like($k_lk,$vlk);
																															}
																													}
																											} else {
																													$db_group->or_not_like($k_lk,$v_lk);
																											}
																									}
																							}
																							if(isset($attr['where_array']) && count($attr['where_array'])>0)
																									return $db_group->get_where($table,$attr['where_array']);
																									else
																											return $db_group->get($table);
}

function insert_data($table="",$data=array()){
	$CI         = get_instance();
	$db_active  = $CI->session->userdata('db_active');
	$db_group   = $db_active ? $CI->load->database($db_active,TRUE) : $CI->db;
	$db_group->insert($table,$data);
	$id = $db_group->insert_id();
	if($id)
			return $id;
			else
					return true;
}

function update_data($table="",$data=array(),$column="",$where=""){
	$CI         = get_instance();
	$db_active  = $CI->session->userdata('db_active');
	$db_group   = $db_active ? $CI->load->database($db_active,TRUE) : $CI->db;
	if(is_array($column) && count($column) > 0){
			foreach($column as $c => $w){
					$db_group->where($c,$w);
			}
	}elseif($column){
			if(is_array($where))
					$db_group->where_in($column,$where);
					else
							$db_group->where($column,$where);
	}
	return $db_group->update($table,$data);
}

function delete_data($table="",$column="",$where=""){
	$CI         = get_instance();
	$db_active  = $CI->session->userdata('db_active');
	$db_group   = $db_active ? $CI->load->database($db_active,TRUE) : $CI->db;
	$tipe       = is_array($column) || (!is_array($column) && $column) ? 'delete' : 'truncate';
	if($tipe == 'delete') {
			if(is_array($column)){
					foreach($column as $col => $val){
							$db_group->where($col,$val);
					}
			}else{
					if(is_array($where))
							$db_group->where_in($column,$where);
							else
									$db_group->where($column,$where);
			}
			return $db_group->delete($table);
	} else
			return $db_group->query('TRUNCATE `'.$table.'`');
}

//-------------------------------------------------------- Ibef -------------------------------------------------------------//

?>