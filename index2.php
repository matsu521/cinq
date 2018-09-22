<?php
//初期化
if(isset($_POST['name'])) {
	$name = $_POST['name'];
	if(strlen($name) > 10) {
		$error['name'] = 'length';
	}
} else {
	$name = NULL;
	$error['name'] = 'blank';
}	
if(isset($_POST['gender'])) {
	$gender = $_POST['gender'];
} else {
	$gender = NULL;
	$error['gender'] = 'blank';
}
if(isset($_POST['age'])) {
	$age = $_POST['age'];
} else {
	$age = NULL;
	$error['age'] = 'blank';
}
if(isset($_POST['img'])) {
	$img = $_POST['img'];
} else {
	$img = NULL;
	$error['img'] = 'blank';
}
if(isset($_POST['pr'])) {
	$pr = $_POST['pr'];
	if(strlen($pr) > 250) {
		$error['pr'] = 'length';
	}
} else {
	$pr = NULL;
	$error['pr'] = 'blank';
}


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
	<dd><input type="text" name="name" size="35" maxlength="255" value="<?php echo htmlspecialchars($_POST['name'],ENT_QUOTES,'UTF-8'); ?>" /></dd>
<?php if($error['name'] == 'blank'): ?>
	<p>必須です</p>
<?php endif; ?>

<?php if($error['name'] == 'length') : ?>
	<p>10文字以内です</p>
<?php endif; ?>		

		<dt>性別</dt>
		<dd><input type="radio" name="gender" id="myMale" value="male" /><label for="myMale">男性</label></dd>
		<dd><input type="radio" name="gender" id="myFemale" value="female" /><label for="myFemale">女性</label></dd>
<?php if($error['gender'] == 'blank'): ?>
	<p>必須です</p>
<?php endif; ?>

		<dt>年齢</dt>
<dd><select name="age">
<?php
	for($i=1; $i<=100; $i++) {
	echo '<option value="' .$i. '">' .$i. '歳</option>';
}
	?>
	</select></dd>
<?php if($error['age'] == 'blank'): ?>
	<p>必須です</p>
<?php endif; ?>	

		<dt>画像</dt>
		<dd><input type="file" name="img"></dd>
<?php if($error['img'] == 'blank'): ?>
	<p>必須です</p>
<?php endif; ?>	

		<dt>PR欄</dt>
		<dd><textarea name="pr" rows="5" cols="40"></textarea></dd>
	</dl>
<?php if($error['pr'] == 'blank'): ?>
	<p>必須です</p>
<?php endif; ?>
<?php if($error['pr']): ?>
	<p>250文字以内です</p>
<?php endif; ?>		
	
	<p><input type="submit" value="送信" /></p>
	<p><input type="reset" value="リセット" /></p>

</form>
</body>
</html>