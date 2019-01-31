<?php 
$img=$_POST['data'];

$data = $img;
$pos  = strpos($data, ',');
$variable = substr($data, 0, $pos+1);
$new = str_replace($variable,"",$data);	
//echo $new;exit;
//$type = explode(':', substr($data, 0, $pos))[1];
//$type = explode('/', $type)[1];
//echo $type;
//$data = str_replace('data:image/'.$type.';base64,', '', $data);


//$data = str_replace(' ', '+', $data);

$new = base64_decode($new);

$file = 'output/'.rand() . '.jpeg';

$success = file_put_contents($file, $new);

if($success){
echo $success;
echo 'file upload success';
}

?>
