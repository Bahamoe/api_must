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
require 'connect.php';
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
//Hämtar bilderlänkarna från databasen och skapar en array med dem i.
$sql = "SELECT * FROM images";
$query = mysqli_query($conn, $sql);
$imagesDB = array();
//Bygger en array av bildernalänkarna från databasen.
while($row = mysqli_fetch_assoc($query)){
    $imagesDB[$row['img_link']] = $row['img_id'];
}


    //Hämtar bildlänkarna från imstagram 
    $tag = "nackaforummatochvin";
    $client_id = "714957dd4a4e4a94af32175858c041d3";
    $url = 'https://api.instagram.com/v1/tags/'.$tag.'/media/recent?client_id='.$client_id;
    $imagesIG = array();

    //Hämtar bilder så länge $url inte är tom.
    while($url != ""){
        $inst_stream = callInstagram($url);
        $results = json_decode($inst_stream, true);
        if(isset($results['pagination']['next_url'])){
            $url = $results['pagination']['next_url'];
        }else{
            $url = "";
        }
        
        //Bygger en array av bildlänkarna som jag fått från instagram.
        foreach($results['data'] as $item){

            $image_link = $item['images']['thumbnail']['url'];
            $Profile_name = $item['user']['username'];
            $imagesIG[$image_link] =(isset($imagesDB[$image_link]) ? false : true);
        }
    }

    //Lägger till nya bilderlänkar till databasen som inte redan fanns.
    foreach ($imagesIG as $url => $new) {
        if($new){
            $sql = "INSERT INTO images (img_link) VALUES ('". $url ."')";
            mysqli_query($conn, $sql) ;
            echo "Added: ".$url."<br>";
        }
    }
    //Tar bort döda länkar.
    foreach ($imagesDB as $url => $id) {
        if(!isset($imagesIG[$url])){
            $sql = "DELETE FROM images WHERE img_id = ". $id ."";
            mysqli_query($conn, $sql);
            echo "Removed: ".$url."<br>";
        }
    }

?>