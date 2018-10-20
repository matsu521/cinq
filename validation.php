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
* アップロードファイルが正常か判定をする 
*/
function isUploadFile($value) {
    if (!isset($value['error']) || !is_int($value['error'])) {
    	return 1;
    //    throw new RuntimeException('パラメータが不正です');
    }
    switch ($value['error']) {
        case UPLOAD_ERR_OK: // OK
            return 0;
        case UPLOAD_ERR_NO_FILE:   // ファイル未選択
        	return 2;
        case UPLOAD_ERR_INI_SIZE:  // php.ini定義の最大サイズ超過
        case UPLOAD_ERR_FORM_SIZE: // フォーム定義の最大サイズ超過 (設定した場合のみ)
            return 3;
        default:
            return 4;
    }
}

/**
* アップロードファイルサイズが指定範囲内か判定をする 
*/
function isUploadFileSize($value, $limit) {
    if ($value['size'] > $limit) {
        return false;
    }
    return true;
}

/**
* アップロードファイルのMIMEタイプを判別する
*/
function isUploadFileMimeType($value, $mime_types = array()) {
	
    if (!$ext = array_search(
        mime_content_type($value['tmp_name']), $mime_types, true
    )) {
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
			if ($key == 'upload') {
				$ret = isUploadFile($param);
				if ($ret > 0) {
					if ($ret == '1') {
						return 'パラメータが不正です';
					} else if ($ret == '2') {
						return 'ファイルが選択されていません';
					} else if ($ret == '3') {
						return 'ファイルサイズが大きすぎます';
					} else if ($ret == '4') {
						return '何らかの原因でアップロードに失敗しました';
					}
				
				}
			}
			if ($key == 'upload_size') {
				if (!isUploadFileSize($param, $value)) {
					return 'ファイルは'. $value. 'KBまでアップロードできます';
				}
			}
			/*
			if ($key == 'upload_mime_type') {
				if (!isUploadFileMimeType($param, $value)) {
					return 'ファイルは指定の形式ではありませｎ';
				}
			}*/
		}
	}		
	return '';
}



?>