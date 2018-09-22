<?php
session_start();
if(!empty($_POST)){
  //エラー項目の確認
  //ニックネームが空の場合
  if($_POST['name'] == '') {
    $error['name'] = 'blank';
  } 

  if(strlen($_POST['name']) > 10) {
  	$error['name'] = 'length';
  }
 
  if($_POST['gender'] =='') {
 	$error['gender'] = 'blank';
  }

  if($_POST['age'] == '') {
 	$error['age'] = 'blank';
  }

  if($_POST['img'] == '') {
 	$error['img'] = 'blank';
  }

 if($_POST['pr'] == '') {
	$error['pr'] = 'blank';
 }
 
  //パスワードが6文字以下の場合
  if(strlen($_POST['pr']) > 250) {
    $error['pr'] = 'length';
  }
 
  //エラーがない場合は確認ページへページ遷移
  if(empty($error)){
    $_SESSION['join'] = $_POST;
    header('Location: check.php');
  }
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

</form>
</body>
</html>