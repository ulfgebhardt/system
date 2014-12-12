<?php
namespace SYSTEM\SAI;

class saimod_sys_todo extends \SYSTEM\SAI\SaiModule {
    
    public static function sai_mod__SYSTEM_SAI_saimod_sys_todo_action_close($todo){
        \SYSTEM\DBD\SYS_SAIMOD_TODO_CLOSE::QI(array($todo));
        return \SYSTEM\LOG\JsonResult::ok();}
    public static function sai_mod__SYSTEM_SAI_saimod_sys_todo_action_open($todo){
        \SYSTEM\DBD\SYS_SAIMOD_TODO_OPEN::QI(array($todo));
        return \SYSTEM\LOG\JsonResult::ok();}
    public static function sai_mod__SYSTEM_SAI_saimod_sys_todo_action_add($todo){
        self::exception(new \Exception($todo), false, true);
        return \SYSTEM\LOG\JsonResult::ok();}
    
    public static function sai_mod__SYSTEM_SAI_saimod_sys_todo(){
        $vars = array();        
        $vars['PICPATH'] = \SYSTEM\WEBPATH(new \SYSTEM\PSAI(), 'modules/saimod_sys_log/img/');
        return \SYSTEM\PAGE\replace::replaceFile(\SYSTEM\SERVERPATH(new \SYSTEM\PSAI(),'modules/saimod_sys_todo/tpl/saimod_sys_todo.tpl'), $vars);
    }
    
    public static function sai_mod__SYSTEM_SAI_saimod_sys_todo_action_new(){
        $vars = array();        
        return \SYSTEM\PAGE\replace::replaceFile(\SYSTEM\SERVERPATH(new \SYSTEM\PSAI(),'modules/saimod_sys_todo/tpl/saimod_sys_todo_new.tpl'), $vars);
    }
    
    public static function sai_mod__SYSTEM_SAI_saimod_sys_todo_action_todolist(){
        $result = $result_user = '';
        $res = \SYSTEM\DBD\SYS_SAIMOD_TODO_TODO_LIST::QQ();
        $count = \SYSTEM\DBD\SYS_SAIMOD_TODO_TODO_COUNT::Q1()['count'];
        while($row = $res->next()){
            $row['class_row'] = self::trclass($row['type'],$row['class']);
            $row['time_elapsed'] = self::time_elapsed_string(strtotime($row['time']));
            //$row['report_type'] = self::reporttype($row['type']);
            $row['state_string'] = self::state($row['count']);
            $row['state_btn'] = self::statebtn($row['count']);
            if($row['type'] == \SYSTEM\DBD\system_todo::FIELD_TYPE_USER){
                $row['message'] = str_replace("\r", '<br/>', $row['message']);
                $result_user .=  \SYSTEM\PAGE\replace::replaceFile(\SYSTEM\SERVERPATH(new \SYSTEM\PSAI(),'modules/saimod_sys_todo/tpl/todo_user_list_element.tpl'), $row);
            } else {
                $result .=  \SYSTEM\PAGE\replace::replaceFile(\SYSTEM\SERVERPATH(new \SYSTEM\PSAI(),'modules/saimod_sys_todo/tpl/todo_list_element.tpl'), $row);
            }}
        return \SYSTEM\PAGE\replace::replaceFile(\SYSTEM\SERVERPATH(new \SYSTEM\PSAI(),'modules/saimod_sys_todo/tpl/todo_list.tpl'), array('todo_user_list_elements' => $result_user,'todo_list_elements' => $result, 'count' => $count));
    }
    
    public static function sai_mod__SYSTEM_SAI_saimod_sys_todo_action_dotolist(){
        $result = $result_user = '';
        $res = \SYSTEM\DBD\SYS_SAIMOD_TODO_DOTO_LIST::QQ();
        $count = \SYSTEM\DBD\SYS_SAIMOD_TODO_DOTO_COUNT::Q1()['count'];
        while($row = $res->next()){
            $row['class_row'] = self::trclass($row['type'],$row['class']);
            $row['time_elapsed'] = self::time_elapsed_string(strtotime($row['time']));
            $row['state_string'] = self::state($row['count']);
            $row['state_btn'] = self::statebtn($row['count']);
            if($row['type'] == \SYSTEM\DBD\system_todo::FIELD_TYPE_USER){
                $row['message'] = str_replace("\r", '<br/>', $row['message']);
                $result_user .=  \SYSTEM\PAGE\replace::replaceFile(\SYSTEM\SERVERPATH(new \SYSTEM\PSAI(),'modules/saimod_sys_todo/tpl/todo_user_list_element.tpl'), $row);
            } else {
                $result .=  \SYSTEM\PAGE\replace::replaceFile(\SYSTEM\SERVERPATH(new \SYSTEM\PSAI(),'modules/saimod_sys_todo/tpl/todo_list_element.tpl'), $row);
            }
        }
        return \SYSTEM\PAGE\replace::replaceFile(\SYSTEM\SERVERPATH(new \SYSTEM\PSAI(),'modules/saimod_sys_todo/tpl/todo_list.tpl'), array('todo_user_list_elements' => $result_user,'todo_list_elements' => $result, 'count' => $count));
    }
    
    public static function statistics(){
        /* COUNT(*);state;type
         *  147;0;0
         *  4;0;1
         *  149;1;0
         *  1;1;1
         */
        $res = \SYSTEM\DBD\SYS_SAIMOD_TODO_STATS_COUNT::QA();
        $vars = array();
        $vars['todo_count'] = $res[0]['count']+$res[1]['count'];
        $vars['doto_count'] = $res[2]['count']+$res[3]['count'];
        $vars['todo_perc'] = round(floatval($vars['todo_count']) / floatval($vars['todo_count']+$vars['doto_count']) * 100,2);
        $vars['doto_perc'] = round(floatval($vars['doto_count']) / floatval($vars['todo_count']+$vars['doto_count']) * 100,2);
        $vars['todo_gen_count'] = $res[0]['count'];
        $vars['doto_gen_count'] = $res[2]['count'];
        $vars['todo_gen_perc'] = round(floatval($vars['todo_gen_count']) / floatval($vars['todo_gen_count']+$vars['doto_gen_count']) * 100,2);
        $vars['doto_gen_perc'] = round(floatval($vars['doto_gen_count']) / floatval($vars['todo_gen_count']+$vars['doto_gen_count']) * 100,2);
        $vars['todo_user_count'] = $res[1]['count'];
        $vars['doto_user_count'] = $res[3]['count'];
        $vars['todo_user_perc'] = round(floatval($vars['todo_user_count']) / floatval($vars['todo_user_count']+$vars['doto_user_count']) * 100,2);
        $vars['doto_user_perc'] = round(floatval($vars['doto_user_count']) / floatval($vars['todo_user_count']+$vars['doto_user_count']) * 100,2);;
        
        $vars['project_perc'] = round(floatval($vars['doto_gen_perc'])/2+floatval($vars['doto_user_perc'])/2,2);
        return $vars;
    }
    
    public static function sai_mod__SYSTEM_SAI_saimod_sys_todo_action_stats(){
        return \SYSTEM\PAGE\replace::replaceFile(\SYSTEM\SERVERPATH(new \SYSTEM\PSAI(),'modules/saimod_sys_todo/tpl/todo_stats.tpl'), self::statistics());}
    
    private static function time_elapsed_string($ptime)
    {
        $etime = time() - $ptime;

        if ($etime < 1)
        {
            return '0 seconds';
        }

        $a = array( 12 * 30 * 24 * 60 * 60  =>  'year',
                    30 * 24 * 60 * 60       =>  'month',
                    24 * 60 * 60            =>  'day',
                    60 * 60                 =>  'hour',
                    60                      =>  'minute',
                    1                       =>  'second'
                    );

        foreach ($a as $secs => $str)
        {
            $d = $etime / $secs;
            if ($d >= 1)
            {
                $r = round($d);
                return $r . ' ' . $str . ($r > 1 ? 's' : '') . ' ago';
            }
        }
    }
    
    private static function state($state){
        if($state == 1){
            return 'Closed';}
        return 'Open';}
    
    private static function statebtn($state){
        if($state == 1){
            return '<input type="submit" class="btn-danger" value="reopen">';}
        return '<input type="submit" class="btn-danger" value="close">';}
    
    private static function trclass($type,$class){
        if($type == \SYSTEM\DBD\system_todo::FIELD_TYPE_USER){
            return 'success';}
        switch($class){
            case 'SYSTEM\LOG\INFO': case 'INFO': case 'SYSTEM\LOG\COUNTER':
                return 'success';
            case 'SYSTEM\LOG\DEPRECATED': case 'DEPRECATED':
                return 'info';
            case 'SYSTEM\LOG\ERROR': case 'ERROR': case 'Exception': case 'SYSTEM\LOG\ERROR_EXCEPTION':
            case 'ErrorException': case 'SYSTEM\LOG\SHUTDOWN_EXCEPTION':
                return 'error';
            case 'SYSTEM\LOG\WARNING': case 'WARNING':
                return 'warning';
            default:
                return '';
        }
    }
    
    public static function sai_mod__SYSTEM_SAI_saimod_sys_todo_action_close_all(){
        \SYSTEM\DBD\SYS_SAIMOD_TODO_CLOSE_ALL::QI();
        return \SYSTEM\LOG\JsonResult::ok();}
    
    public static function sai_mod__SYSTEM_SAI_saimod_sys_todo_action_edit($todo, $message){
        \SYSTEM\DBD\SYS_SAIMOD_TODO_EDIT::QI(array($message,$message,$todo));
        return \SYSTEM\LOG\JsonResult::ok();}
        
    public static function sai_mod__SYSTEM_SAI_saimod_sys_todo_action_todo($todo){
        $vars = \SYSTEM\DBD\SYS_SAIMOD_TODO_TODO::Q1(array($todo));
        $vars['trace'] = implode('</br>', array_slice(explode('#', $vars['trace']), 1, -1));
        return $vars[\SYSTEM\DBD\system_todo::FIELD_TYPE] == \SYSTEM\DBD\system_todo::FIELD_TYPE_USER ?
               \SYSTEM\PAGE\replace::replaceFile(\SYSTEM\SERVERPATH(new \SYSTEM\PSAI(),'modules/saimod_sys_todo/tpl/saimod_sys_todo_todo_user.tpl'), $vars) :
               \SYSTEM\PAGE\replace::replaceFile(\SYSTEM\SERVERPATH(new \SYSTEM\PSAI(),'modules/saimod_sys_todo/tpl/saimod_sys_todo_todo.tpl'), $vars);}
    
    public static function html_li_menu(){return '<li><a href="#" saimenu=".SYSTEM.SAI.saimod_sys_todo">ToDo</a></li>';}
    public static function right_public(){return false;}    
    public static function right_right(){return \SYSTEM\SECURITY\Security::check(\SYSTEM\SECURITY\RIGHTS::SYS_SAI);}
    
    public static function sai_mod__SYSTEM_SAI_saimod_sys_todo_flag_css(){}
    public static function sai_mod__SYSTEM_SAI_saimod_sys_todo_flag_js(){return \SYSTEM\LOG\JsonResult::toString(
            array(\SYSTEM\WEBPATH(new \SYSTEM\PSAI(),'modules/saimod_sys_todo/js/saimod_sys_todo.js')));}
    
    public static function exception(\Exception $E, $thrown, $user = false){
        try{
            if(\property_exists(get_class($E), 'todo_logged') && $E->todo_logged){                
                return false;} //alrdy logged(this prevents proper thrown value for every system exception)
                if($user){
                    \SYSTEM\DBD\SYS_SAIMOD_TODO_USER_EXCEPTION_INSERT::Q1(  array(  get_class($E), $E->getMessage(), $E->getCode(), $E->getFile(), $E->getLine(), $E->getTraceAsString(),
                                                                                    getenv('REMOTE_ADDR'),round(microtime(true) - \SYSTEM\time::getStartTime(),5),
                                                                                    $_SERVER["SERVER_NAME"],$_SERVER["SERVER_PORT"],$_SERVER['REQUEST_URI'], serialize($_POST),
                                                                                    array_key_exists('HTTP_REFERER', $_SERVER) ? $_SERVER['HTTP_REFERER'] : null,
                                                                                    array_key_exists('HTTP_USER_AGENT',$_SERVER) ? $_SERVER['HTTP_USER_AGENT'] : null,
                                                                                    ($user = \SYSTEM\SECURITY\Security::getUser()) ? $user->id : null, $thrown ? 1 : 0, sha1($E->getMessage())),
                                                                            array(  get_class($E), $E->getMessage(), $E->getCode(), $E->getFile(), $E->getLine(), $E->getTraceAsString(),
                                                                                    getenv('REMOTE_ADDR'),round(microtime(true) - \SYSTEM\time::getStartTime(),5),date('Y-m-d H:i:s', microtime(true)),
                                                                                    $_SERVER["SERVER_NAME"],$_SERVER["SERVER_PORT"],$_SERVER['REQUEST_URI'], serialize($_POST),
                                                                                    array_key_exists('HTTP_REFERER', $_SERVER) ? $_SERVER['HTTP_REFERER'] : null,
                                                                                    array_key_exists('HTTP_USER_AGENT',$_SERVER) ? $_SERVER['HTTP_USER_AGENT'] : null,
                                                                                    ($user = \SYSTEM\SECURITY\Security::getUser()) ? $user->id : null,$thrown,$E->getMessage()));
                } else {
                    \SYSTEM\DBD\SYS_SAIMOD_TODO_EXCEPTION_INSERT::Q1(   array(  get_class($E), $E->getMessage(), $E->getCode(), $E->getFile(), $E->getLine(), $E->getTraceAsString(),
                                                                                getenv('REMOTE_ADDR'),round(microtime(true) - \SYSTEM\time::getStartTime(),5),
                                                                                $_SERVER["SERVER_NAME"],$_SERVER["SERVER_PORT"],$_SERVER['REQUEST_URI'], serialize($_POST),
                                                                                array_key_exists('HTTP_REFERER', $_SERVER) ? $_SERVER['HTTP_REFERER'] : null,
                                                                                array_key_exists('HTTP_USER_AGENT',$_SERVER) ? $_SERVER['HTTP_USER_AGENT'] : null,
                                                                                ($user = \SYSTEM\SECURITY\Security::getUser()) ? $user->id : null, $thrown ? 1 : 0, sha1($E->getMessage())),
                                                                        array(  get_class($E), $E->getMessage(), $E->getCode(), $E->getFile(), $E->getLine(), $E->getTraceAsString(),
                                                                                getenv('REMOTE_ADDR'),round(microtime(true) - \SYSTEM\time::getStartTime(),5),date('Y-m-d H:i:s', microtime(true)),
                                                                                $_SERVER["SERVER_NAME"],$_SERVER["SERVER_PORT"],$_SERVER['REQUEST_URI'], serialize($_POST),
                                                                                array_key_exists('HTTP_REFERER', $_SERVER) ? $_SERVER['HTTP_REFERER'] : null,
                                                                                array_key_exists('HTTP_USER_AGENT',$_SERVER) ? $_SERVER['HTTP_USER_AGENT'] : null,
                                                                                ($user = \SYSTEM\SECURITY\Security::getUser()) ? $user->id : null,$thrown,$E->getMessage()));
                }
            if(\property_exists(get_class($E), 'logged')){
                $E->todo_logged = true;} //we just did log
        } catch (\Exception $E){return false;} //Error -> Ignore
        
        return false; //We just log and do not handle the error!
    }
}