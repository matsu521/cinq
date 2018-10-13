<?php
	
/**
* 入力値が空かどうか判定
*/
function is_require($value) {
	if(isset($value) && $value != '') {
		return true;
	}
	return false;
}
/**
* 入力値の文字数判定をする 
*/
function isMaxStr($value, $limit) {
	if(strlen($value) > $limit) {
		return false;
	}
	return true;	
}

/**
* 入力値の文字数判定をする 
*/
function isNumber($value) {
	if(!is_int($value)) {
		return false;
	}
	return true;	
}

/**
*	入力チェックを行う
**/
function getErrorMessage($param, $rules) {
	
	if (isset($rules) && is_array($rules)) {
		foreach ($rules as $key => $value) {
			if ($key == 'require') {
				if (!is_require($param)) {
					return '必須です';
				}
			}
			if ($key == 'max') {
				if (!isMaxStr($param, $value)) {
					return $value. '文字以内です';
				}
			}
		}
	}		
	return '';
}



?>