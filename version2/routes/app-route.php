<?php

function discord_token()
{
    include_once ROOTPATH.'/protected/config.php';

    return DISCORD_TOKEN;     
}

function app_db ()
{
    include_once ROOTPATH.'/protected/config.php';

    $db_conn = array(
        'host' => DB_HOST, 
        'user' => DB_USER,
        'pass' => DB_PASSWORD,
        'database' => DB_NAME, 
    );
    $db = new SimpleDBClass($db_conn);

    return $db;     
}

// Dashboard

$router->map( 'GET', '/', function() 
{ 
	$ajax_url = AJAX_URL;

	include  ROOTPATH.'/dashboard/dashboard.php';

});

// Login

$router->map( 'GET', '/login', function() 
{ 
	$ajax_url = AJAX_URL;

	include  ROOTPATH.'/dashboard/login.php';

});

$router->map( 'POST', '/api/login', function() 
{ 
	$ajax_url = AJAX_URL;

	include  ROOTPATH.'/includes/php/dep/login.php';

});

// Memberlist

$router->map( 'GET', '/member/list', function() 
{ 
	$ajax_url = AJAX_URL;

	include  ROOTPATH.'/dashboard/memberlist.php';

});

// Logout

$router->map( 'GET', '/logout', function() 
{ 
	$ajax_url = AJAX_URL;

	include  ROOTPATH.'/dashboard/logout.php';

});

// Groups

$router->map( 'POST', '/api/groups', function() 
{ 
	$ajax_url = AJAX_URL;

	include  ROOTPATH.'/includes/php/dep/groups.php';

});

// Memberlist

$router->map( 'POST', '/api/memberlist/edit', function() 
{ 
	$ajax_url = AJAX_URL;

	include  ROOTPATH.'/includes/php/dep/memberlist/edit.php';

});

$router->map( 'POST', '/api/memberlist/add', function() 
{ 
	$ajax_url = AJAX_URL;

	include  ROOTPATH.'/includes/php/dep/memberlist/add.php';

});

$router->map( 'GET', '/api/email', function() 
{
	$db = app_db(); 

	$email =  $db->CleanDBData($_GET['email']);

	$q0 = $db->select("select * from  t1 where email='$email' ");

	if($q0 > 0)
	{
		echo json_encode(array
		(
			'status'=>'succes',			
			'msg' => 'found records',
			'emails'=> $q0,
		));
	}
	else
	{
		echo json_encode(array
		(
			'status'=>'error',
			'msg' => 'no records found',
			'emails'=> $q0,
		));

	}
});


$router->map( 'GET', '/v1/api/[*:action]/t1', function($id) 
{
	$db = app_db(); 	

	$email =  $db->CleanDBData($id);

	$q0 = $db->select("select * from  t1 where email='$email' ");

	if($q0 > 0)
	{
		echo json_encode(array
		(
			'status'=>'succes',			
			'msg' => 'found records',
			'emails'=> $q0,
		));
	}
	else
	{
		echo json_encode(array
		(
			'status'=>'error',
			'msg' => 'no records found',
			'emails'=> $q0,
		));

	}
});



?>