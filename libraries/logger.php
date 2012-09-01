<?php
/**
 * Created by JetBrains PhpStorm.
 * User: whiskeyman
 * Date: 31.08.12
 * Time: 21:40
 */
class TLogger
{
    public $logs = array();
    
    public function __construct($message = '')
    {
        $this->logs = $message;
    }
    
    public function WriteLogs()
    {
        if(empty($this->logs))
        {
            return false;
        }
         
        $logfile = fopen (_TPATH_ROOT . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . 'log.txt', 'a');
         
        foreach($this->logs as $logstr)
        {
            fwrite($logfile, $logstr);
        }

        fclose($logfile);
        
        return true;
    }
}
