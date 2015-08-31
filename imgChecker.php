<?php 
//$i = 0;
//function callInstagram($url){
//    $ch = curl_init();
//    curl_setopt_array($ch, array(
//    CURLOPT_URL => $url,
//    CURLOPT_RETURNTRANSFER => true,
//    CURLOPT_SSL_VERIFYPEER => false,
//    CURLOPT_SSL_VERIFYHOST => 2
//    ));
//
//    $result = curl_exec($ch);
//    curl_close($ch);
//    return $result;
//}
//
//    $tag = "nackaforummatochvin";
//    $client_id = "714957dd4a4e4a94af32175858c041d3";
//    $Next_URL = $_GET["nexturl"];
//    if($Next_URL == ""){
//    $url = 'https://api.instagram.com/v1/tags/'.$tag.'/media/recent?client_id='.$client_id . "&count=9";
//    } else {
//    $url =  $Next_URL;
//    }
//    $inst_stream = callInstagram($url);
//    $results = json_decode($inst_stream, true);
//    $maxid = $results['pagination']['next_max_id'];
//    $nexturl = $results['pagination']['next_url'];
//    var_dump($nexturl);
//    //Now parse through the $results array to display your results... 
//    foreach($results['data'] as $item){
//        $image_link = $item['images']['thumbnail']['url'];
//        $Profile_name = $item['user']['username'];
//        $i++;
//        echo '<div style="display:block;float:left;"><img src="'.$image_link.'" /></div>';
//    }
//    $nextUrlEncode = urlencode($nexturl);
//    echo "<div style='display:block;width:100%;clear:both;'>NextURL: <a href='?nexturl=$nextUrlEncode'>Next images</a></div>";

$everything = array();
$client_id = '714957dd4a4e4a94af32175858c041d3';
$tag = 'nackaforummatochvin';

$json = file_get_contents('https://api.instagram.com/v1/tags/'.$tag.'/media/recent?client_id='.$client_id . '&count=9');
$result = json_decode($json, true);

$everything[] = $result['data'];


//get all pages
while(isset( $result['pagination']['next_url'])){
    $json = file_get_contents($result['pagination']['next_url']);
    $result = json_decode($json, true);
    $everything = $result['data'];
}

//build an array of image src, permalink, and date

$images = array();

foreach ($everything as $page) {
    foreach ($page as $image) {
        if($image['type'] !== 'image'){
            continue;
        }
        $images[] = array(
            'date' => $image['created_time'],
            'link' => $image['link'],
            'src' => $image['images']['standard_resolution']

        );
    }
}
// save all those files locally
$count = 0;
$total = count($images);

foreach ($images as $image) {
    $count++;

    //pause every once in a while to not get blocked
    if($count % 10 === 0){
        $current = $total - $count;
        echo '<p>Sleeping 10 seconds,'. $current . 'images left</p>';
        sleep(10);
    }

    $current_images = scandir('.');

    $filename = basename($image);

    if(! in_array( $filename, $current_images)){
        $data = file_get_contents($images);
        if(file_put_contents($filename, $data)){
            echo '<p>'. $filename .'added</p>';
        }
    }
}
 ?>