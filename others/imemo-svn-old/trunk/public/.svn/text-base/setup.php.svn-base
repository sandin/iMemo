<!--
NetBeansProjects

@encoding   UTF-8
@author     lds <lds2012@gmail.com>
@copyright  Copyright (c) 2010 , lds
@license    default

-->

<?php
if ( isset($_SESSION['setUp']) && $_SESSION['setUp'] === FALSE ):
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="css/setup.css" media="all" />
        <title></title>
    </head>
    <body>
	    <h1>SetUp</h1>
	    <hr />
        <?php

	switch ($_GET['case']) {
		case 'databaseNotExist':
			?>
			<h2>数据库尚不存在</h2>
			<p>您提供的数据库不存在,请检查application/configs中配置文件中dbname设置，此文件为安全起见，只允许手工修改。</p>

			<?php
			break;
		case 'userPassWrong':
			?>
			<h2>用户名和密码错误</h2>
			<p>您提供的数据用户名和密码错误,请检查application/configs中配置文件，此文件为安全起见，只允许手工修改。</p>
			<?php
			break;
		default :
		 	
			break;
	}

	?>
	<p>若尚有疑问，可联系网站管理员</p>
	<?php
        // put your code here
	$SetUp = new Lds_Models_SetUp( $application);

        ?>
    </body>
</html>

<?php
else :
	echo 'Sorry,You can not setup the application.';
endif;
?>
