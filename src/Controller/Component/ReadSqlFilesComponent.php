<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\I18n\Time;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * Description of Utils
 *
 * @author sakorn.s
 */
class ReadSqlFilesComponent extends Component {

    public $Path = (ROOT . DS . 'src' . DS.'Controller'.DS.'Sql'.DS);
    
    public function read($fileName = '') {
        $dir = new Folder($this->Path);
        $files = $dir->find($fileName);
        if(sizeof($files) >0){
            //$this->log($this->Path.$files[0],'debug');
            $str = file_get_contents($this->Path.$files[0]);
           // $this->log($str,'debug');
            return $str;
        }
        return null;
    }

}
