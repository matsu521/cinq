<?php
	include('validation.php');

	$params = array(
		'name'=> array(
			'require'=> '',
			'max'    => 10
		),
		'gender'=> array(
			'require'=> '',
			'num'    => '',
			'exist'  => array(1, 2)
		),
		'age'=> array(
			'require'=> '',
			'num'    => '',
			'between' => array(1, 100)
		),
		'img'=> array(
			'upload'	 => '',
			'upload_size'=> '1000000',
			'upload_mime_type' => array(
		            'gif' => 'image/gif',
		            'jpg' => 'image/jpeg',
		            'png' => 'image/png',
        		),
		),
		'pr'=> array(
			'require'=> '',
			'max'    => 12
		),
	);

	$genders = array(1=> '男性', 2=> '女性');			
	$errors  = array();

	foreach ($params as $key => $rules) {
		${$key} = ''; // 初期化
		
		// 送信ボタン押下
		if (isset($_POST['btn'])) {
			// 入力値取得
			$value = ($key == 'img') ? $_FILES[$key] : $_POST[$key];
			
			// 入力チェック
			$errors[$key] = getErrorMessage($value, $rules);
		
			// 値セット
			${$key} = $_POST[$key];
			var_dump($errors);
			// 入力エラーなし

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
		<dd><input type="text" name="name" size="35" maxlength="255" value="<?php echo $name;?>" /></dd>
		<?php echo (isset($errors['name'])) ? $errors['name'] : ''; ?>

		<dt>性別</dt>
		<dd>
			<?php foreach($genders as $key => $value) { ?>
				<input type="radio" name="gender" id="myMale" value=<?php echo $key;?> 
					<?php
						if ($key == $gender) {
							echo "checked";
						}
					?>
				/><label for="myMale"><?php echo $value;?></label>
			<?php } ?>		
		</dd>
		<?php echo (isset($errors['gender'])) ? $errors['gender'] : ''; ?>

		<dt>年齢</dt>
		<dd>
			<select name="age">
				<option value=""></option>
				<?php
					for ($i = 1; $i <= 100; $i++) {
						echo '<option value="'. $i. '" ';
						if ($i == $age) {
							echo "selected";
						}
						echo '>';
						echo $i;
						echo '歳</option>';
					}
				?>
			</select>
		</dd>
		<?php echo (isset($errors['age'])) ? $errors['age'] : ''; ?>
			
		<dt>画像</dt>
		<dd><input type="file" name="img"></dd>
		<?php echo (isset($errors['img'])) ? $errors['img'] : ''; ?>

		<dt>PR欄</dt>
		<dd><textarea name="pr" rows="5" cols="40"><?php echo $pr;?></textarea></dd>
		<?php echo (isset($errors['pr'])) ? $errors['pr'] : ''; ?>
	</dl>
	
	<p><input type="submit" value="送信" name="btn" /></p>
	<p><input type="reset" value="リセット" /></p>

</form>
</body>
</html>