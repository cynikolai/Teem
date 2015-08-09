<?php
include 'vendor/autoload.php';

use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseACL;
use Parse\ParsePush;
use Parse\ParseUser;
use Parse\ParseInstallation;
use Parse\ParseException;
use Parse\ParseAnalytics;
use Parse\ParseFile;
use Parse\ParseCloud;
use Parse\ParseClient;

ParseClient::initialize("ZnhCsGSUhnteG2rwpNijgcEmr5PruwPMW6tIH4yB", "d6D3EzI9qwXsUfrQ1Vo82YHVDs89WrHDaGtWRomA", "CApaQ8a6hIvw3PRMoBrcjvK22jVxuyxvB7UaPkZN");


function sign_up($username,$password,$school_id,$email)
{
	$user = new ParseUser();
	$user->set("username", $username);
	$user->set("password", $password);
	$user->set("email", $email);
	$user->set("school_id", $zipcode);
	try {
	 $user->signUp();
	  // Hooray! Let them use the app now.
	} catch (ParseException $ex) {
	}
	sign_in($username,$password);
	return $user;
}

function sign_in($username,$password)
{
	try {
  	$user = ParseUser::logIn($username, $password);
  	// Do stuff after successful login.
	} catch (ParseException $error) {
  // The login failed. Check error to see why.
	}
	return $user;
}

function get_district_id($school_id)
{
	$query = new ParseQuery("sc13prelim");
	$query->equalTo("school_id",$school_id);
	$object = $query->first();
	return $object->get("district_id");
}

function get_school_users($currentUser)
{
	if($currentUser != NULL)
	{
		$school_id = $currentUser->get("school_id");		
	}	
	$query = ParseUser::query();
	$query->equalTo("school_id", $school_id); 
	$results = $query->find();
	return results;
}

function get_district_users($currentUser)
{
	if($currentUser != NULL)
	{
		$school_id = $currentUser->get("school_id");
	}	
	$district_id = get_district_id($school_id);
	$query = ParseUser::query();
	$query->equalTo("district_id", $district_id); 
	$results = $query->find();
	return results;
	*/
}

if(isset($_GET["input-name"]))
{
	$user = sign_up($_GET["input-name"],$_GET["input-password"],$_GET["input-zip"],$_GET["input-email"]);
}
else
{
	$user = sign_in($_GET["username"],$_GET["password"]);
}
$school_users = get_school_users($user);
$district_users = get_district_users($user);

echo('<div id="page">
		<div class="header Fixed">
			<a href="#menu"></a>
			<span>Teem Main Page</span>
			<span class="stick-right">Welcome ');
	if($user != NULL)
	{
	echo($user->get("username") . "!");}

echo('</span>
		</div>
		<div class="content" id="content">
			<div id="intro">
				<p><h1><strong>Welcome to Teem</strong></h1><br />
					Topics are spaces where you will converse and share files with your fellow teachers. </p>
					
					<p>Your school has created a number of Topics based on the results of your PD survey results. All teachers are here in the School Commons topic.</p>

					<p>Click on the menu icon in the top navigation bar to jump to another Topic, or use the field below to post an update!.</p>

				</div>
				<div id="first">
					');
echo('
					<p><strong>This is the first section.</strong><br />
						Notice how the fixed header and footer slide out along with the page.</p>

						<p><a href="#menu">Open the menu.</a></p>
					</div>
					<div id="second">
');

echo('
						<p><strong>This is the second section.</strong><br />
							You can also drag the page to the right to open the menu.</p>
							<p><a href="#menu">Open the menu.</a></p>
						</div>
						<div id="third">
');

echo('
							<p><strong>This is the third section.</strong><br />
								<a href="#menu">Open the menu.</a></p>
							</div>
						</div>
						<div class="footer Fixed">
							Ignite your professional community
						</div>
						<nav id="menu">
							<ul>
								<li><a href="#content">Intro</a></li>
								<li><a href="#second">School Commons</a></li>
								<li><a href="#third">District Commons</a></li>
							</ul>
						</nav>
					</div>');
?>