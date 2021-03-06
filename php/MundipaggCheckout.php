<?php

if (!function_exists('curl_init')) {
    throw new Exception('System Integration needs the CURL PHP extension.');
}
if (!function_exists('json_decode')) {
    throw new Exception('System Integration needs the JSON PHP extension.');
}

class MundipaggCheckout
{
    protected $secretKey;
    protected $merchantKey;

    protected $_domainRequest;
    protected $_trustForwarded = FALSE;
    protected $_domain = 'api.mundipagg.com/core/v1/';
    protected $_webservice;
    protected $_timeout = 30;
    protected $_sandbox;
    public $response;

    private $_validation_map = array(
        'cli002' => array('msg' => 'Você deve informar a merchantKey!'),
        'cli003' => array('msg' => 'Não há dados a serem tratados!'),
    );

    /**
     * HTTP response codes array
     *
     * @var array
     * @see http://en.wikipedia.org/wiki/List_of_HTTP_status_codes
     **/
    private $_codes = array(
        200 => 'OK',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Time-out',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Time-out'
    );

    function __construct($config)
    {
        if (!$config['merchantKey']) {
            $this->validationError('cli002');
        }

        $this->secretKey = ((isset($config['secretKey']) && $config['secretKey']) ? $config['secretKey'] : '');
        $this->merchantKey = ((isset($config['merchantKey']) && $config['merchantKey']) ? $config['merchantKey'] : '');

        $this->_domainRequest = $this->getHttpHost();
        $this->_trustForwarded = ((isset($config['trust'])) ? $config['trust'] : (($this->getHttpProtocol() == 'https') ? TRUE : FALSE));

        $this->_webservice = (($this->_trustForwarded) ? 'https://' : 'http://') . $this->_domain;

        if (isset($config['sandbox']) and $config['sandbox']) {
            $this->_sandbox = $config['sandbox'];
        }
    }

    function transmitData($data, $action, $method)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->_webservice . $action,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_HTTPHEADER => array(
                "Authorization: Basic " . base64_encode($this->secretKey),
                "Cache-Control: no-cache",
                "Content-Type: application/x-www-form-urlencoded",
                "Postman-Token: 6fec4d70-241a-4bab-944b-1dddb8728d50"
            ),
        ));

        $return = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $json = json_decode($return, FALSE);

        if (empty($json)) {
            if ($this->_sandbox){
                echo '<pre>';
                echo "cURL Error #:" . $err;

                $this->debug($return);
                $this->callException($return);
            }
        }

        return $json;
    }

    private function validationError($validatioId)
    {
        if (!$validatioId)
            return FALSE;

        $msgError = $this->_validation_map[$validatioId];

        return new ArrayObject(array('success' => FALSE, 'msg' => $msgError['msg']), ArrayObject::STD_PROP_LIST);
    }

    public function getNameError($code)
    {
        if (!$code)
            return FALSE;

        return ((isset($this->_codes[$code])) ? $this->_codes[$code] : '');
    }

    private function callException($error)
    {
        throw new Exception(__METHOD__ . ' -> ' . $error);
    }

    static public function debug($object, $kill = TRUE)
    {
        echo '<pre style="text-align: left;">' . 'BEGIN DEBUG -->> ';
        print_r($object);
        echo '</pre><br />';
        if ($kill)
            die('DIE');

        return ($object);
    }

    protected function getHttpProtocol()
    {
        if ($this->_trustForwarded && isset($_SERVER['HTTP_X_FORWARDED_PROTO'])) {
            if ($_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
                return 'https';
            }

            return 'http';
        }
        /*apache + variants specific way of checking for https*/
        if (isset($_SERVER['HTTPS']) &&
            ($_SERVER['HTTPS'] === 'on' || $_SERVER['HTTPS'] == 1)
        ) {
            return 'https';
        }
        /*nginx way of checking for https*/
        if (isset($_SERVER['SERVER_PORT']) &&
            ($_SERVER['SERVER_PORT'] === '443')
        ) {
            return 'https';
        }

        return 'http';
    }

    protected function getHttpHost()
    {
        if ($this->_trustForwarded && isset($_SERVER['HTTP_X_FORWARDED_HOST'])) {
            return $_SERVER['HTTP_X_FORWARDED_HOST'];
        }

        return $_SERVER['HTTP_HOST'];
    }

    private function toArray($obj)
    {
        if (is_object($obj)) $obj = (array)$obj;
        if (is_array($obj)) {
            $new = array();
            foreach ($obj as $key => $val) {
                $new[$key] = self::toArray($val);
            }
        } else {
            $new = $obj;
        }

        return $new;
    }

    public function genProtocol($prefix)
    {
        return str_pad(date("Ymd") . '.' . mt_rand(), 5, "0", STR_PAD_LEFT) . '/' . $prefix;
    }

    //- Methods Integrations
    #- -------------------------------------------------------------------------------------------------------------
    public function serviceCheckout($data = array())
    {
        return $this->transmitData($data, 'orders', 'POST');
    }
    #- -------------------------------------------------------------------------------------------------------------
    public function serviceCheckoutReturn($order_id)
    {
        return $this->transmitData(array(), 'orders' . '/' . $order_id, 'GET');
    }
    #- -------------------------------------------------------------------------------------------------------------
}

?>