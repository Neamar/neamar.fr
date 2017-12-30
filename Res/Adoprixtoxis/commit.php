<?php
$user='webmaster@neamar.fr';
$pass='sagas_neamar_rtYu7';

// Construct an HTTP POST request
$clientlogin_url = "https://www.google.com/accounts/ClientLogin";
$clientlogin_post = array(
    "accountType" => "HOSTED_OR_GOOGLE",
    "Email" => $user,
    "Passwd" => $pass,
    "service" => "writely",
    "source" => "Adop"
);
 
// Initialize the curl object
$curl = curl_init($clientlogin_url);
 
// Set some options (some for SHTTP)
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $clientlogin_post);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
 
// Execute
$response = curl_exec($curl);
 
// Get the Auth string and save it
preg_match("/Auth=([a-z0-9_\-]+)/i", $response, $matches);
$auth = $matches[1];
 

// Include the Auth string in the headers
// Together with the API version being used
$headers = array(
    "Authorization: GoogleLogin auth=" . $auth,
    "GData-Version: 3.0",
);
 
// Make the request
curl_setopt($curl, CURLOPT_URL, "http://docs.google.com/feeds/download/documents/Export?docID=0AZZXXCCC0GsvZGQ4ejg5N3FfMjdnajl6NXBmNQ=&exportFormat=txt");
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_POST, false);

$response = curl_exec($curl);
curl_close($curl);

echo "\n" . $response;

exit();


function download($client, $doc, $format=null) {
  $sessionToken = $client->getHttpClient()->getAuthSubToken();
  $opts = array(
    'http' => array(
      'method' => 'GET',
      'header' => "GData-Version: 3.0\r\n".
                  "Authorization: AuthSub token=\"$sessionToken\"\r\n"
    )
  );
  if ($doc != null) {
    $url =  'http://docs.google.com/feeds/download/documents/Export?docID=' . $doc . "&exportFormat=$format";
  }
  return file_get_contents($url, false, stream_context_create($opts));
}

// TODO 2: fetch a $feed or $entry
$fileContents = download($client, '0AZZXXCCC0GsvZGQ4ejg5N3FfMjdnajl6NXBmNQ=', 'txt');
echo "<pre>$fileContents</pre>";

exit();

//on est connecté, récupérer les documents
$Episodes=array
(
	'Adoprixtoxis-2'=>'0AZZXXCCC0GsvZGQ4ejg5N3FfMjdnajl6NXBmNQ='
);

function download2($docID)
{
	$URL='http://docs.google.com/feeds/download/documents/Export?docID=' . $docID . '&exportFormat=txt';

	echo $URL;
	exit();

	$DL = curl_init();
	curl_setopt($DL, CURLOPT_URL,$URL);
	curl_setopt($DL, CURLOPT_RETURNTRANSFER, 1);
	$HTML = curl_exec($DL);
	curl_close($DL);
	unset($DL);
	return $HTML;
}
foreach($Episodes as $Episode=>$docID)
{
	echo download($docID);
}
?>