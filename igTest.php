<?php

//$tag = 'nackaforummatochvin';
//$client_id = '714957dd4a4e4a94af32175858c041d3';
//
//$url = 'https://api.instagram.com/v1/tags/'.$tag.'/media/recent?client_id='.$client_id;
//
//$photos = json_decode(file_get_contents($url));
//
//foreach($photos->data as $photo){
//
//	echo "<a href'". $photo->link ."' target='_blank'><img src='". $photo->images->low_resolution->url ."'></a><br/>";
//}

function callInstagram($url){
    $ch = curl_init();
    curl_setopt_array($ch, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => 2
    ));

    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

    $tag = "nackaforummatochvin";
    $client_id = "714957dd4a4e4a94af32175858c041d3";
    $Next_URL = $_GET["nexturl"];
    if($Next_URL == ""){
    $url = 'https://api.instagram.com/v1/tags/'.$tag.'/media/recent?client_id='.$client_id.'&count=9';
    } else {
    $url =  $Next_URL;
    }
    $inst_stream = callInstagram($url);
    $results = json_decode($inst_stream, true);
    $maxid = $results['pagination']['next_max_id'];
    $nexturl = $results['pagination']['next_url'];
    //Now parse through the $results array to display your results... 
    foreach($results['data'] as $item){
        $image_link = $item['images']['thumbnail']['url'];
        $Profile_name = $item['user']['username'];

        echo '<div style="display:block;float:left;"><img src="'.$image_link.'" /></div>';
    }
    $nextUrlEncode = urlencode($nexturl);
    echo "<div style='display:block;width:100%;clear:both;'>NextURL: <a href='?nexturl=$nextUrlEncode'>Next images</a></div>";

?>
