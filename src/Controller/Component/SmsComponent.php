<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;

/**
 * Sms component
 */
class SmsComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    var $api_url   = 'http://www.thsms.com/api/rest';
     var $username  = 'sakorns';
     var $password  = '929da5';
 
    private function sendOTP( $from='0000', $to=null, $message=null)
    {
        $params['method']   = 'send';
        $params['username'] = $this->username;
        $params['password'] = $this->password;
 
        $params['from']     = $from;
        $params['to']       = $to;
        $params['message']  = $message;
 
        if (is_null( $params['to']) || is_null( $params['message']))
        {
            return FALSE;
        }
 
        $result = $this->curl( $params);
        $xml = @simplexml_load_string( $result);
        if (!is_object($xml))
        {
            return array( FALSE, 'Respond error');
        } else {
            if ($xml->send->status == 'success')
            {
                return array( TRUE, $xml->send->uuid);
            } else {
                return array( FALSE, $xml->send->message);
            }
        }
    }
     
    private function curl( $params=array())
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->api_url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query( $params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 
        $response  = curl_exec($ch);
        $lastError = curl_error($ch);
        $lastReq = curl_getinfo($ch);
        curl_close($ch);
 
        return $response;
    }

    public function getSendOTP ($id = '',$mobile = '') {
        $this->Otps = TableRegistry::get('user_otps');
        $otp = $this->Otps->newEntity();
        $otp->user_id = $id;
        $otp->otp_ref = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"), 0, 4);
        $otp->otp_code = substr(str_shuffle("0123456789"), 0, 6);
        if($this->Otps->save($otp)){
            $message = "รหัส OTP ของคุณคือ ".$otp->otp_code." รหัสอ้างอิง ".$otp->otp_ref." สำหรับลงทะเบียน BP Shopping Mall";
            $this->sendOTP('0000', $mobile, $message);
            return $otp_return = [$id, $otp->otp_ref];
        }
    }
}
