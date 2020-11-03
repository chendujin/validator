<?php

/**
 * 全局数据验证类。
 * @author fingerQin
 */

namespace DataTrans;

class Validator {

    /**
     * 判断是否为合法的用户名。
     * @param string $username
     * @param int $min_len 最小长度。包含。
     * @param int $max_len 最大长度。包含。
     * @param string $mode 用户名模式：digit、alpha、digit_alpha、chinese、digit_alpha_chinese、mix
     *            digit：数字
     *            aplha：字母
     *            digit_alpha：数字和字母
     *            chinese：中文
     *            digit_alpha_chinese：数字字母中文
     *            mix：混合型：数字字母中文下划线破折号
     * @return bool
     */
    public static function is_username($username, $min_len, $max_len, $mode = 'mix') {
        switch ($mode) {
            case 'digit':
                return preg_match("/^\d{{$min_len},{$max_len}}$/", $username) ? true : false;
                break;

            case 'alpha':
                return preg_match("/^([a-zA-Z]){{$min_len},{$max_len}}$/", $username) ? true : false;
                break;

            case 'digit_alpha':
                return preg_match("/^([a-z0-9_-]){{$min_len},{$max_len}}$/", $username) ? true : false;
                break;

            case 'chinese':
                return (preg_match("/^[\x7f-\xff]{{$min_len},{$max_len}}$/", $username)) ? true : false;
                break;

            case 'digit_alpha_chinese':
                return (preg_match("/^[\x7f-\xff|0-9a-zA-Z]{{$min_len},{$max_len}}$/", $username)) ? true : false;
                break;

            case 'mix':
            default:
                return (preg_match("/^[\x7f-\xff|0-9a-zA-Z-_]{{$min_len},{$max_len}}$/", $username)) ? true : false;
                break;
        }
    }

    /**
     * 判断是否为合法的密码。
     * @param string $password
     * @param int $min_len 最小长度。包含。
     * @param int $max_len 最大长度。包含。
     * @param string $mode 用户名模式：digit_alpha、mix
     *            digit_alpha：数字和字母
     *            mix：混合型：数字字母下划线破折号
     * @return bool
     */
    public static function is_password($password, $min_len, $max_len, $mode = 'mix') {
        switch ($mode) {
            case 'digit_alpha':
                return preg_match("/^([a-z0-9]){{$min_len},{$max_len}}$/", $password) ? true : false;
                break;

            case 'mix':
            default:
                return (preg_match("/^[0-9a-zA-Z-_]{{$min_len},{$max_len}}$/", $password)) ? true : false;
                break;
        }
    }

    /**
     * 判断是否为QQ号码。
     * @param string $qq
     * @return boolean
     */
    public static function is_qq($qq) {
        return preg_match('/^[1-9]\d{4,12}$/', $qq) ? true : false;
    }

    /**
     * 判断是否为手机号码。
     * @param string $mobilephone
     * @return boolean
     */
    public static function is_mobilephone($mobilephone) {
        return preg_match('/^13[\d]{9}$|14^[0-9]\d{8}|^15[0-9]\d{8}$|^18[0-9]\d{8}$/', $mobilephone) ? true : false;
    }

    /**
     * 判断是否为座机号码。
     * @param string $telphone
     * @return boolean
     */
    public static function is_telphone($telphone) {
        return preg_match('/^((\(\d{2,3}\))|(\d{3}\-))?(\(0\d{2,3}\)|0\d{2,3}-)?[1-9]\d{6,7}(\-\d{1,4})?$/', $telphone) ? true : false;
    }

    /**
     * 判断是否为邮政编码。
     * @param string $zipcode
     * @return boolean
     */
    public static function is_zipcode($zipcode) {
        return preg_match('/^[1-9]\d{5}$/', $zipcode) ? true : false;
    }

    /**
     * 判断字母是否在某个区域内。用于判断某个字符只能介于[a-h](包含)之间的类似情况。
     * @param string $alpha 原值。
     * @param string $start_alpha 起始值。
     * @param string $end_alpha 截止值。
     * @return boolean
     */
    public static function alpha_between($alpha, $start_alpha, $end_alpha) {
        if (Validator::is_alpha($alpha) === false) {
            return false;
        }
        if (Validator::is_alpha($start_alpha) === false) {
            return false;
        }
        if (Validator::is_alpha($end_alpha) === false) {
            return false;
        }
        if ($start_alpha >= $end_alpha) {
            return false;
        }
        if ($alpha < $start_alpha) {
            return false;
        }
        if ($alpha > $end_alpha) {
            return false;
        }
        return true;
    }
    
    /**
     * 判断数字是否在某个区域之间。[2, 10],包含边界值。
     * @param int $value 原值。
     * @param int $start_value 起始值。
     * @param int $end_value 截止值。
     * @return boolean
     */
    public static function number_between($value, $start_value, $end_value) {
        if (is_numeric($value) === false || is_numeric($start_value) === false || is_numeric($end_value) === false) {
            return false;
        }
        if ($start_value >= $end_value) {
            return false;
        }
        if ($value < $start_value) {
            return false;
        }
        if ($value > $end_value) {
            return false;
        }
        return true;
    }

    /**
     * 验证是否为中文。
     * @param string $char
     * @return bool
     */
    public static function is_chinese($char) {
        if (strlen($char) === 0) {
            return false;
        }
        return (preg_match("/^[\x7f-\xff]+$/", $char)) ? true : false;
    }

    /**
     * 判断是否为字母、数字、下划线（_）、破折号（-）。
     * @param string $str
     * @return boolean
     */
    public static function is_alpha_dash($str) {
        return preg_match('/^([a-z0-9_-])+$/i', $str) ? true : false;
    }
    
    /**
     * 验证身份证号码是否合法。
     * @param string $vStr
     * @return bool
     */
    public static function is_idcard($vStr) {
        $vCity = array(
            '11','12','13','14','15','21','22',
            '23','31','32','33','34','35','36',
            '37','41','42','43','44','45','46',
            '50','51','52','53','54','61','62',
            '63','64','65','71','81','82','91'
        );
        if (!preg_match('/^([\d]{17}[xX\d]|[\d]{15})$/', $vStr)) {
            return false;
        }
        if (!in_array(substr($vStr, 0, 2), $vCity)) {
            return false;
        }
        $vStr = preg_replace('/[xX]$/i', 'a', $vStr);
        $vLength = strlen($vStr);
     
        if ($vLength == 18) {
            $vBirthday = substr($vStr, 6, 4) . '-' . substr($vStr, 10, 2) . '-' . substr($vStr, 12, 2);
        } else {
            $vBirthday = '19' . substr($vStr, 6, 2) . '-' . substr($vStr, 8, 2) . '-' . substr($vStr, 10, 2);
        }
        if (date('Y-m-d', strtotime($vBirthday)) != $vBirthday) {
            return false;
        }
        if ($vLength == 18) {
            $vSum = 0;
            for ($i = 17 ; $i >= 0 ; $i--) {
                $vSubStr = substr($vStr, 17 - $i, 1);
                $vSum += (pow(2, $i) % 11) * (($vSubStr == 'a') ? 10 : intval($vSubStr, 11));
            }
            if($vSum % 11 != 1) {
                return false;
            }
        }
        return true;
    }
    
    /**
     * 验证日期时间格式。
     * -- 1、验证$value是否为$format格式。
     * -- 2、只能验证格式，不能验证时间是否正确。比如：2014-22-22
     * @param string $format 格式。格式如：Y-m-d 或H:i:s
     * @param string $value 日期。
     * @return boolean
     */
    public static function is_date_format($format, $value) {
        return date_create_from_format($format, $value) !== false;
    }
    
    /**
     * 判断是否为整数。
     * @param string $str
     * @return boolean
     */
    public static function is_integer($str) {
        return filter_var($str, FILTER_VALIDATE_INT) !== false;
    }
    
    /**
     * 判断是否为字母数字。
     * @param string $str
     * @return boolean
     */
    public static function is_alpha_number($str) {
        return preg_match('/^([a-z0-9])+$/i', $str) ? true : false;
    }

    /**
     * 判断是否为字母。
     * @param string $str
     * @return boolean
     */
    public static function is_alpha($str) {
        return preg_match('/^([a-z])+$/i', $str) ? true : false;
    }
    
    /**
     * 验证IP是否合法。
     * @param string $ip
     * @return bool
     */
    public static function is_ip($ip) {
        return filter_var($ip, FILTER_VALIDATE_IP) !== false;
    }
    
    /**
     * 验证URL是否合法。
     * -- 合法的URL：http://www.baidu.com
     * @param string $url
     * @return bool
     */
    public static function is_url($url) {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }

    /**
     * 判断email格式是否正确。
     * @param string $email
     * @return bool
     */
    function is_email($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * 是否必需。
     * @param string $str
     * @return bool
     */
    public static function is_require($str) {
        return strlen($str) ? true : false;
    }

    /**
     * 判断字符串是否为utf8编码，英文和半角字符返回ture。
     * @param string $string
     * @return bool
     */
    public static function is_utf8($string) {
        return preg_match('%^(?:
                    [\x09\x0A\x0D\x20-\x7E] # ASCII
                    | [\xC2-\xDF][\x80-\xBF] # non-overlong 2-byte
                    | \xE0[\xA0-\xBF][\x80-\xBF] # excluding overlongs
                    | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2} # straight 3-byte
                    | \xED[\x80-\x9F][\x80-\xBF] # excluding surrogates
                    | \xF0[\x90-\xBF][\x80-\xBF]{2} # planes 1-3
                    | [\xF1-\xF3][\x80-\xBF]{3} # planes 4-15
                    | \xF4[\x80-\x8F][\x80-\xBF]{2} # plane 16
                    )*$%xs', $string) ? true : false;
    }
    
    /**
     * 检查字符串长度。
     * @param string $str 字符串。
     * @param int $min 最小长度。
     * @param int $max 最大长度。
     * @param bool $is_utf8 是否UTF-8字符。
     * @return boolean
     */
    public static function len($str, $min = 0, $max = 255, $is_utf8 = false) {
        $len = $is_utf8 ? mb_strlen($str) : strlen($str);
        if (($len >= $min) && ($len <= $max)) {
            return true;
        } else {
            return false;
        }
    }
}