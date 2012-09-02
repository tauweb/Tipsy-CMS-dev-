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

        try
        {
            @$logfile = fopen (_TPATH_ROOT . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . 'log.txt', 'a');

            if(!$logfile)
            {
                echo 'Не могу';
                throw new TRuntimeException('Не могу открыть или создать файл для записи логов');
                die();
            }

            $message ='/n' .date('l jS \of F Y h:i:s A') .  $message;

            fwrite($logfile, $message);

            fclose($logfile);

        }catch (TRuntimeException $e){

        }

        return true;
    }
}
