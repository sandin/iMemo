<?php

/** 
* 帮助解析main input里用户输入的内容，将其分解出时间，tag等信息
 */
class Lds_Helper_MainInput
{
    /** 
     * 正则表达式储存器
     * 
     * @return 
     */
    private $_patterns = array();

    /** 
     * 匹配结果储存器
     * 
     * @return 
     */
    private $_matchs   = array();

    /** 
     * 待解析的字符串
     */
    private $_string;

    public function __construct($string, $patterns = null)
    {
        if (is_array($patterns))
            $this->_patterns = $patterns;
        $this->_string = $string;
    
        $this->_patterns['time'][] = '/\b\d{1,2}:\d{1,2}\b/';
        
    }

    /** 
     * 加入正则表达式
     * 
     * @param $name
     * @param $pattern
     * 
     * @return 
     */
    public function addPattern($name, $pattern)
    {
        $this->_patterns[$name][] = $pattren;
    }

    public function setString($string)
    {
        $this->_string = $string;
    }

    /** 
     * 取出结果字符串
     * 
     * @return 
     */
    public function getString()
    {
        return $this->_string;
    }

    public function getPatterns($name = null)
    {
        if (isset($name)) { 
            return $this->_patterns[$name];
        } else {
            return $this->_patterns;
        }
    }

    /** 
     * 按名称读取匹配对象
     * 
     * @param $name
     * 
     * @return 
     */
    public function getMatchs($name = null)
    {
        if (isset($name)) { 
            return $this->_matchs[$name][0];
        } else {
            return $this->_matchs;
        }
    }

    /** 
     * 解析已存入的正则表达式匹配
     * 将匹配结果储存到$this->_matchs
     * 并将匹配的部分剔除出结果
     * 
     * @return String 
     */
    public function parse()
    {
        if (isset($this->_string) && is_string($this->_string) && count($this->_patterns) > 0)
        {
            foreach ($this->_patterns as $name => $item) {
                foreach ($item as $pattern) {
                    preg_match_all($pattern,$this->_string,$this->_matchs[$name]);
                    $limit = ($name = 'time') ? 1 : null;
                    $this->_string = preg_replace($pattern,'',$this->_string,$limit);

                }//foreach $item    
            }//foreach
            return $this->_matchs;
        }//fi
    }

    /** 
     * 根据已匹配的时间和日期，返回时间戳
     * @TODO 利用parse和makeDateStatic改造
     * 
     * @return String $timestamp 
     */
    public function makeDate()
    {
        if (isset($this->_matchs['time']) && count($this->getMatchs('time')) > 0 ) {
            $date = new Zend_Date();

            //因为可能匹配到多个时间
            $temp = $this->getMatchs('time');
            $time = $temp[0];
            $date->set($time,Zend_Date::TIME_SHORT);

            //设置日期，未指定则默认为今天
            if (isset($this->_matchs['date'])) {
                $date_str = $this->_matchs['date'];
                // D.M.Y
                $date->set($date_str,Zend_Date::DATES);
            }

            //var_dump($date->get(Zend_Date::W3C));
            return $date->get();
        }//fi
        
    }

    /** 
     * 根据提供的timestamp时间戳，和指定的date,time,制作新的时间戳
     * timestamp无则默认为今日
     * date可能值[newDate|oldDate|today]
     * time可能值[newTime|oldTime|00:00] 
     * 指定了新值则设置为新值
     * 未设置新值，则用旧值
     * 旧值也不存在则使用最后的默认值
     * 
     * @param String $timestamp
     * @param String $date
     * @param String $time
     * 
     * @return String $timestamp
     */
    public static function makeDateStatic($timestamp = null, $date = null, $time = null)
    {
        if (isset($timestamp)) {
            $zDate   = new Zend_Date($timestamp);
            //$oldDate = $zDate->get(Zend_Date::DATES);
            $oldTime = $zDate->get(Zend_Date::TIME_SHORT);
        } else {
            $zDate   = new Zend_Date();
            //$oldDate = 'today';
            $oldTime = '00:00';
        }
        if (isset($date)) {
            //解析时间格式
            $temp  = split("-",$date);
            $year  = $temp[0];
            $month = $temp[1];
            $day   = $temp[2];
            $dates = $day . '.' . $month . '.' . $year;
       
            $zDate->set($dates,Zend_Date::DATES);
        } 
        $newTime = (isset($time)) ? $time : $oldTime;
        $zDate->set($newTime,Zend_Date::TIME_SHORT);

        return $zDate->get();
    
    }

    /** 
     * 根据时间戳，返回人读时间格式
     * 
     * @param String $timestamp
     * 
     * @return Array $new_date
     */
    public static function dateFormater($timestamp) 
    {
        $t = Zend_Registry::get('translate');
        
        $result = array();

        $date      = new Zend_Date($timestamp);
        $result['date'] = $date->toString('YYYY-MM-dd');
        $result['time'] = $date->toString('HH:mm');

        //解析时间
        if ($date->isToday()) {
            $result['dateHuman'] = $t->_('Today'); 
        } elseif ($date->isTomorrow()) {
            $result['dateHuman'] = $t->_('Tomorrow'); 
        } elseif ($date->isYesterday()) {
            $result['dateHuman'] = $t->_('Yesterday'); 
        }

        return $result;
    }

}
