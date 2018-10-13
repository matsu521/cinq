<?php
try {
$pdo = new PDO('mysql:host=localhost;dbname=cnq_form;charset=utf8','root','root',
array(PDO::ATTR_EMULATE_PREPARES => false));
} catch (PDOException $e) {
 exit('データベース接続失敗'.$e->getMessage());
}
//mysqli_connect('localhost', 'root', 'root') or die(mysql_error());
//mysql_select_db('cnq_form');
//mysql_query('SET NAMES UTF8');


/**
* 入力値が空かどうか判定（テキスト）
*/
function is_require($value) {
	if(isset($value) && $value == '') {
		return false;
	}
	return true;
}
/**
* 入力値の文字数判定をする（10以内）
*/
function isMaxStr($value) {
	if(strlen($value) > 10) {
		return false;
	}
	return true;	
}

/**
* 入力値の数値判定をする 
*/
function isNumber($value) {
	if(!is_int($value)) {
		return false;
	}
	return true;	
}
/**
* 入力値が空かどうか判定（ラジオボタン）
*/
function is_require2($value) {
	if(is_null($value)) {
		return false;
	}
	if(isset($value) && $value == '') {
		
		return false;
	}
	return true;
}
/**
* 配列が数値どおりか（ラジオボタン）
*/
function isExist($value, $compareList) {
	
	if (in_array($value, $compareList)) {
		return true;
	}
	return false;
}
/**
* 入力値の文字数判定をする（250以内） 
*/
function isMaxStr2($value) {
	if(strlen($value) > 250) {
		return false;
	}
	return true;	
}
/**
* テキストボックスエラーメッセージ
*/
function getErrorMssage($value) {

	$error = [];
	
	if (!is_require($value)) {
		$error[] = '必須です';
	}
	if (!isMaxStr($value)) {
		$error[] = '10文字以内です';
	}		
	return $error;
}
/**
* ラジオボタンエラーメッセージ
*/
function getErrorGenderMssage($value) {

	$error = [];
	
	if (!is_require2($value)) {
		$error[] = '必須です';
		return $error;
	}
	if (!isExist($value, [1, 2])) {
	
	}		
	return $error;
}
/**
* セレクトボックスエラーメッセージ
*/
function getErrorAgeMssage($value) {
	if (!is_require($value)) {
		$error[] = '必須です';
	}
	return $error;		
	}
/**
* テキストエリアエラーメッセージ
*/
function getErrorPrMssage($value) {
	if (!is_require($value)) {
		$error[] = '必須です';
	}
	if (!isMaxStr2($value)) {
		$error[] = '250文字以内です';
	}
	return $error;		
	}
/**
* 各項目ごとのエラーメッセージを代入
*/	
$error = [];
$error['name'] = getErrorMssage($_POST['name']);

if ($_POST['btn'] == 'submit') {
	$error['gender'] = getErrorGenderMssage($_POST['gender']);
}	
$error['age'] = getErrorAgeMssage($_POST['age']);
$error['pr'] = getErrorPrMssage($_POST['pr']);




?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-Language" content="ja" />
<meta http-equiv="content-Style-Type" content="text/css" />
<title>フォーム</title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<link href="css/import.css" rel="stylesheet" type="text/css" />
</head>

<body>	
<form action="" method="post" enctype="multipart/form-data">
	<dl>	
	<dt>名前</dt>
	<dd><input type="text" name="name" size="35" maxlength="255" value="<?php echo $_POST['name']; ?>" /></dd>
<?php
	
foreach($error['name'] as $key => $value) {
	echo $value;
}	
?>
	


		<dt>性別</dt>
		<dd><input type="radio" name="gender" id="myMale" value="1" <?php if(($_POST['gender']) == 1){ echo 'checked=\"checked\"'; } ?> /><label for="myMale">男性</label></dd>
		<dd><input type="radio" name="gender" id="myFemale" value="2" <?php if(($_POST['gender']) == 2){ echo 'checked=\"checked\"'; } ?> /><label for="myFemale">女性</label></dd>
<?php
	foreach($error['gender'] as $key => $value) {
		echo $value;
}					
?>



		<dt>年齢</dt>
<dd><select name="age">
<?php
	for($i=1; $i<=100; $i++) {
		if($i == $_POST['age']) {
			$selected = 'selected';
		} else {
			$selected = '';
		}
			echo '<option value="' .$i. '" '.$selected. '>' .$i. '歳</option>';
}
	?>
	</select></dd>
<?php
	foreach($error['age'] as $key => $value) {
		echo $value;
}					
?>

		<dt>画像</dt>
		<dd><input type="file" name="img"></dd>
<?php if($error['img'] == 'blank'): ?>
	<p>必須です</p>
<?php endif; ?>	

		<dt>PR欄</dt>
		<dd><textarea name="pr" rows="5" cols="40"><?php echo $_POST['pr']; ?></textarea></dd>
	</dl>
<?php
	foreach($error['pr'] as $key => $value) {
		echo $value;
}					
?>	
	
	<p><input type="submit" value="submit" name="btn" /></p>
	<p><input type="reset" value="リセット" /></p>

</form>
</body>
</html>