<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\I18n\Time;

/**
 * Utils component
 */
class UtilsComponent extends Component {

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function startsWith($string, $startString) {
        $len = strlen($startString);
        return (substr($string, 0, $len) === $startString);
    }

    public function adMDYToYMD($strDate = '') {
        $ext = explode('/', $strDate);

        $converted = ($ext[2]) . '-' . $ext[1] . '-' . $ext[0];
        return $converted;
    }

    public function generateNormalDocNo($prefix = '') {
        $time = Time::now();
        $timeStr = $time->i18nFormat('yyMMddHHmmu');
        
        return $prefix.$timeStr;
    }

}
