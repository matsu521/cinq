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
* 入力値が数値であるか判定をする 
*/
function isNum($value) {
	if (preg_match('/^[0-9]+$/', $value)) {
		return true;
	}
	return false;	
}

/**
* 入力値が指定値に一致しているか判定をする 
*/
function isExist($value, $list = array()) {
	if (in_array($value, $list)) {
		return true;
	}
	return false;	
}

/**
* 入力値が指定値の範囲内か判定をする 
*/
function isBetween($value, $between = array()) {
	if ($value >= $between[0] && $value <= $between[1]) {
		return true;
	}
	return false;	
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
			if ($key == 'num') {
				if (!isNum($param)) {
					return '数値ではありません';
				}
			}
			if ($key == 'exist') {
				if (!isExist($param, $value)) {
					return '不正な値です';
				}
			}
			if ($key == 'between') {
				if (!isBetween($param, $value)) {
					return '不正な値です';
				}
			}
		}
	}		
	return '';
}



?>