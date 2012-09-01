<?php
/**
 * Created by JetBrains PhpStorm.
 * User: whiskeyman
 * Date: 31.08.12
 * Time: 21:40
 */
class TLogger
{
    
    public static function WriteLogs($message)
    {
        if(empty($message))
        {
            return false;
        }

        try{
        @$logfile = fopen (_TPATH_ROOT . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . 'log.txt', 'a');



        if(!$logfile)
        {
            throw new TRuntimeException('Не могу открыть или создать файл для записи логов');
        }
            throw new TRuntimeException('Не могу открыть или создать файл для записи логов');

        fwrite($logfile, $message);

        fclose($logfile);
        }catch (TRuntimeException $e){

        }

        return true;
    }
}
