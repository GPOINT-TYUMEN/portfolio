<?php
session_start();
require_once("twitteroauth-master/twitteroauth/twitteroauth.php"); //Path to twitteroauth library
 
$wp_load_include = "../wp-load.php";
$i = 0;
while (!file_exists($wp_load_include) && $i++ < 9) {
	$wp_load_include = "../$wp_load_include";
}
//required to include wordpress file
require($wp_load_include);
global $wlm_shortname;
$twitteruser = get_option($wlm_shortname."_twitter_username");
$tweetscount = get_option($wlm_shortname."_twitter_count");
$consumerkey = get_option($wlm_shortname."_twitter_consumerkey");
$consumersecret = get_option($wlm_shortname."_twitter_consumersecret");
$accesstoken = get_option($wlm_shortname."_twitter_accesstoken");
$accesstokensecret = get_option($wlm_shortname."_twitter_accesstoken_secret");
 
function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
  return $connection;
}
  
$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
 
$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$tweetscount);
 
echo json_encode($tweets);
?>