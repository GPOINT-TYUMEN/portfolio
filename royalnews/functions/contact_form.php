<?php
	header('Content-Type: text/html; charset=utf-8');
	
	$wp_load_include = "../wp-load.php";
	$i = 0;
	while (!file_exists($wp_load_include) && $i++ < 9) {
		$wp_load_include = "../$wp_load_include";
	}
	//required to include wordpress file
	require($wp_load_include);
	
	global $wlm_shortname;
	$emailTo = get_option($wlm_shortname.'_contact_form_email');	
	
	$emailTo = "email@sitename.com"; // Enter your email for feedbacks here
	
	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=utf-8\r\n";
	$headers .= "From: ".$_POST['Email']."\r\n";
	
	if (!isset($_POST['Subject'])) {
		$subject = "Contact form message"; // Enter your subject here
	} else {
		$subject = $_POST['Subject'];
	}
	$body = "";

	reset($_POST);
	while (list($key, $val) = each($_POST)) {
		$title = ucwords(strtolower($key));
		$body .= "<b>$title:</b> ";
		$body .= $val;
	  	$body .= "<br>";
	}
	  
	$result = mail($emailTo, $subject, $body, $headers);
?>