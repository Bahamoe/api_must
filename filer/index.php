<!DOCTYPE html>
<html>
<head>
	<title>Start</title>
</head>
<body>
	<?php
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);
session_start();
require_once( '../Facebook/HttpClients/FacebookHttpable.php' );
require_once( '../Facebook/HttpClients/FacebookCurl.php' );
require_once( '../Facebook/HttpClients/FacebookCurlHttpClient.php' );

require_once( '../Facebook/Entities/AccessToken.php' );
require_once( '../Facebook/Entities/SignedRequest.php' );

require_once( '../Facebook/FacebookSession.php' );
require_once( '../Facebook/FacebookRedirectLoginHelper.php' );
require_once( '../Facebook/FacebookSignedRequestFromInputHelper.php' ); 
require_once( '../Facebook/FacebookRequest.php' );
require_once( '../Facebook/FacebookResponse.php' );
require_once( '../Facebook/FacebookSDKException.php' );
require_once( '../Facebook/FacebookRequestException.php' );
require_once( '../Facebook/FacebookOtherException.php' );
require_once( '../Facebook/FacebookAuthorizationException.php' );

// canvas och tab apps
require_once( '../Facebook/FacebookCanvasLoginHelper.php' );
require_once( '../Facebook/FacebookPageTabHelper.php' );

require_once( '../Facebook/GraphObject.php' );
require_once( '../Facebook/GraphSessionInfo.php' );

use Facebook\HttpClients\FacebookHttpable;
use Facebook\HttpClients\FacebookCurl;
use Facebook\HttpClients\FacebookCurlHttpClient;

use Facebook\Entities\AccessToken;
use Facebook\Entities\SignedRequest;

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookSignedRequestFromInputHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookOtherException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphSessionInfo;


//canvas och tab apps
use Facebook\FacebookCanvasLoginHelper;
use Facebook\FacebookPageTabHelper;

FacebookSession::setDefaultApplication(
'742534125853136',
'06cf24bccc2d372eea391a47e699ee9c');
$pageHelper = new FacebookRedirectLoginHelper(
'http://localhost/api_must/filer/index.php');
$session = $pageHelper->getSessionFromRedirect();

if(isset($session)) {
	$request = new FacebookRequest($session, 'GET', '/me');
	$response = $request->execute();

	$graphObject = $response->getGraphObject()->asArray();

	$_SESSION['user_id'] = $graphObject['id'];

	header('Location: http://localhost/api_must/filer/tavla.php');

} else {
	$helper = new FacebookRedirectLoginHelper('http://localhost/api_must/filer/index.php');

	$login_link_url = $helper->getLoginUrl(array('email', 'user_friends'));
}
?>

<a href="<?php echo $login_link_url ?>"><img src="../images/LaggTill.jpg"></a>


</body>
</html>