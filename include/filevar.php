<?php
class QwbFileVar {
    function __construct($p) {
        $this->path = $p;
        $dir_file = ROOT.'/data'.$this->path;
        if(!file_exists($dir_file)) {
            mkdir($dir_path, 755, true);
        }
    }
    public function get($name, $ar = false) {
        $file = ROOT.'/../data/'.$this->path.'/'.$name;
        if(file_exists($file)) {
            $f = fopen($file, "r");
            flock($f, LOCK_EX);
            $ret = fgets($f);
            flock($f, LOCK_UN);
            fclose($f);
            if($ar) $ret = explode("|", $ret);
            return $ret;
        }
        else {
            if($ar) return array();
            return "";
        }
    }

    public function set($name, $content) {
        $file = ROOT.'/../data/'.$this->path.'/'.$name;

        $flag = false;
        if(is_array($content) && !count($content)) $flag = true;
        if(is_numeric($content) && $content == 0) $flag = true;
        if(is_string($content) && !strlen($content)) $flag = true;
        if($flag) {
            @unlink($file);
            return;
        }

        $f = fopen($file, "w+");
        flock($f, LOCK_EX);
        if(is_array($content)) $content = implode("|", $content);
        $ret = fwrite($f, $content);
        flock($f, LOCK_UN);
        fclose($f);
    }
}
?>
