# validator

### 判断是否为合法的用户名
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
public static function is_username($username, $min_len, $max_len, $mode = 'mix') {}