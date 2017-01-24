<?php
	include ('conn.php');
	// ini_set('display_errors','On');
	// error_reporting(E_ALL);
	header('Content-Type: application/json');
	if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']))
	{
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = sha1($_POST['password']);
		//check email id if is exist
		// $query = mysql_query("SELECT * FROM web_service1 WHERE email = '$email'");
		// $countRow = mysql_num_rows($query);
		if(emailAvail($email) === false)
			{
				$data['code'] = '302';
				$data['msg']  = 'Email Already Exist';
			}
			else
			{
				//Insert record into database;
				echo $run = mysql_query("INSERT INTO web_service1 (`name`,`email`,`password`) VALUES('$name', '$email', '$password')");
				$lastId = mysql_insert_id();
				$lastRow = mysql_affected_rows();
				if($lastRow == '1')
					{
					$data['code'] = '200';
					$data['msg']  = 'User Successfully Regester';
					$data['id']	  = $lastId;
					$data['name']  = $name;
					$data['email']	 = $email;
					$data['password']= $password;
					}
					else
						{
							$data['code'] = '300';
							$data['msg']  ='User Not Added';
						}
			}
			$jsondata['response'] = $data;
	}
	else
		{
			$data['code'] = '301';
			$data['msg']  = 'Wrong Url';
			$jsondata 	  = $data;
		}
echo json_encode($data);
?>
