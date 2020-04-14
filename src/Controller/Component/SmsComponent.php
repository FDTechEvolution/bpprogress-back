<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

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
 
    public function sendOTP( $from='0000', $to=null, $message=null)
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
}
