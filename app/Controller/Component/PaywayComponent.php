<?php include 'Qvalent_PayWayAPI.php' ?>
<?php
App::uses('Component', 'Controller');
class PaywayComponent extends Component {
    
    protected $TAILORED         = false;
    protected $encryptionKey    = 'V6BBRh+iAUhjef14cAyfdQ==';
    protected $logDir           = 'log';
    protected $billerCode       = '101252';
    protected $username         = 'T10125';
    protected $password         = 'Nwwifeic3';
    protected $caCertsFile      = 'cacerts.crt';
    protected $proxyHost        = null;
    protected $proxyPort        = null;
    protected $proxyUser        = null;
    protected $proxyPassword    = null;
    protected $merchantId       = 'TEST';
    protected $paypalEmail      = 'test@example.com';
    protected $payWayBaseUrl    = 'https://www.payway.com.au/';
    
    public function checkOut($products) {
        $parameters = array();
        $parameters['username'] = $this->username;
        $parameters['password'] = $this->password;
        $parameters['biller_code'] = $this->billerCode;
        $parameters['merchant_id'] = $this->merchantId;
        $parameters['paypal_email'] = $this->paypalEmail;
        $parameters['payment_reference'] = time();
        $parameters['payment_reference_change'] = 'false';
        $parameters['surcharge_rates'] = 'VI/MC=0.0,AX=1.5,DC=1.5';
        
        foreach ($products as $data) {
            $parameters[$data['product_name']] = $data['quantity'] . ',' . $data['price'];
        }
        
        // More parameters
        $parameters['hidden_fields'] = 'UserId,Type';
        //$parameters['information_fields'] = 'UserId,Type';
        
        $parameters['UserId'] = CakeSession::read('Auth.User._id');
        $parameters['Type'] = '1M';
        
        $token = $this->getToken($parameters);
        
        if ($this->TAILORED) {
            $_SESSION['token'] = $token;
            $handOffUrl = './enterCCDetails.php?';
        } else {
            $handOffUrl = $this->payWayBaseUrl . "MakePayment?";
        }
        
        $handOffUrl = $handOffUrl . "biller_code=" . $this->billerCode . "&token=" . urlencode( $token );
        $this->debugLog( "Hand-off URL: " . $handOffUrl );
        
        header( "Location: " . $handOffUrl );
        exit;
    }
    
    private function debugLog($message) {
        list($usec, $sec) = explode(" ", microtime());
        $dtime = date("Y-m-d H:i:s." . sprintf("%03d", (int) (1000 * $usec)), $sec);
        $filename = dirname(__FILE__) . '/' . $this->logDir . "/" . "net_" . date("Ymd") . ".log";
        $fp = fopen($filename, "a");
        fputs($fp, $dtime . ' ' . $message . "\r\n");
        fclose($fp);
    }

    private function getToken($parameters) {
        // Find the port setting, if any.
        $payWayUrl = $this->payWayBaseUrl;
        $port = 443;
        $portPos = strpos($this->payWayBaseUrl, ":", 6);
        $urlEndPos = strpos($this->payWayBaseUrl, "/", 8);
        if ($portPos !== false && $portPos < $urlEndPos) {
            $port = (int) substr($this->payWayBaseUrl, ((int) $portPos) + 1, ((int) $urlEndPos));
            $payWayUrl = substr($this->payWayBaseUrl, 0, ((int) $portPos)) . substr($this->payWayBaseUrl, ((int) $urlEndPos), strlen($this->payWayBaseUrl));
            $this->debugLog("Found alternate port setting: " . $port);
        }

        $ch = curl_init($payWayUrl . "RequestToken");
        $this->debugLog("Configuring token request to : " . $payWayUrl . "RequestToken");

        if ($port != 443) {
            curl_setopt($ch, CURLOPT_PORT, $port);
            $this->debugLog("Set port to: " . $port);
        }

        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Set proxy information as required
        if (!is_null($this->proxyHost) && !is_null($this->proxyPort)) {
            curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, true);
            curl_setopt($ch, CURLOPT_PROXY, $this->proxyHost . ":" . $this->proxyPort);
            if (!is_null($this->proxyUser)) {
                if (is_null($this->proxyPassword)) {
                    curl_setopt($ch, CURLOPT_PROXYUSERPWD, $this->proxyUser . ":");
                } else {
                    curl_setopt($ch, CURLOPT_PROXYUSERPWD, $this->proxyUser . ":" . $this->proxyPassword);
                }
            }
        }

        // Set timeout options
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        // Set references to certificate files
        curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/' . $this->caCertsFile);

        // Check the existence of a common name in the SSL peer's certificate
        // and also verify that it matches the hostname provided
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);

        // Verify the certificate of the SSL peer
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

        // Build the parameters string to pass to PayWay
        $parametersString = '';
        $init = true;
        foreach ($parameters as $paramName => $paramValue) {
            if ($init) {
                $init = false;
            } else {
                $parametersString = $parametersString . '&';
            }
            $parametersString = $parametersString . urlencode($paramName) . '=' . urlencode($paramValue);
        }

        curl_setopt($ch, CURLOPT_POSTFIELDS, $parametersString);

        $this->debugLog("Token Request POST: " . $parametersString);

        // Make the request  
        $responseText = curl_exec($ch);

        $this->debugLog("Token Response: " . $responseText);

        // Check the response for errors
        $errorNumber = curl_errno($ch);
        if ($errorNumber != 0) {
            trigger_error("CURL Error getting token: Error Number: " . $errorNumber .
                    ", Description: '" . curl_error($ch) . "'");
            $this->debugLog("Errors: " . curl_error($ch));
        }

        curl_close($ch);

        // Split the response into parameters
        $responseParameterArray = explode("&", $responseText);
        $responseParameters = array();
        foreach ($responseParameterArray as $responseParameter) {
            list( $paramName, $paramValue ) = explode("=", $responseParameter, 2);
            $responseParameters[$paramName] = $paramValue;
        }

        if (array_key_exists('error', $responseParameters)) {
            trigger_error("Error getting token: " . $responseParameters['error']);
        } else {
            return $responseParameters['token'];
        }
    }

    private function pkcs5_unpad($text) {
        $pad = ord($text{strlen($text) - 1});
        if ($pad > strlen($text))
            return false;
        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad)
            return false;
        return substr($text, 0, -1 * $pad);
    }

    public function decrypt_parameters($encryptedParametersText, $signatureText) {
        $key = base64_decode($this->encryptionKey);
        $iv = "\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0";
        $td = mcrypt_module_open('rijndael-128', '', 'cbc', '');

        // Decrypt the parameter text
        mcrypt_generic_init($td, $key, $iv);
        $parametersText = mdecrypt_generic($td, base64_decode($encryptedParametersText));
        $parametersText = $this->pkcs5_unpad($parametersText);
        mcrypt_generic_deinit($td);

        // Decrypt the signature value
        mcrypt_generic_init($td, $key, $iv);
        $hash = mdecrypt_generic($td, base64_decode($signatureText));
        $hash = bin2hex($this->pkcs5_unpad($hash));
        mcrypt_generic_deinit($td);

        mcrypt_module_close($td);

        // Compute the MD5 hash of the parameters
        $computedHash = md5($parametersText);

        // Check the provided MD5 hash against the computed one
        if ($computedHash != $hash) {
            trigger_error("Invalid parameters signature");
        }

        $parameterArray = explode("&", $parametersText);
        $parameters = array();

        // Loop through each parameter provided
        foreach ($parameterArray as $parameter) {
            list( $paramName, $paramValue ) = explode("=", $parameter);
            $parameters[urldecode($paramName)] = urldecode($paramValue);
        }
        return $parameters;
    }

    public function purchase($orderAmountCents, $cardNumber, $cardVerificationNumber, $cardExpiryYear, $cardExpiryMonth) {
        $initParams =   "certificateFile=" . dirname(__FILE__) . '/' . "ccapi.pem" . "&" .
                        "caFile=" . dirname(__FILE__) . '/' . "cacerts.crt" . "&" .
                        "logDirectory=" . dirname(__FILE__) . '/' . "log";
        $paywayAPI = new Qvalent_PayWayAPI();
        $paywayAPI->initialise($initParams);
        
        $orderECI = "SSL";
        $orderType = "capture";
        
        $cardCurrency = "AUD";

        $customerUsername = "T10125";
        $customerPassword = "A3jt6fsgg";
        $customerMerchant = "TEST";
        
        $orderNumber = time();

        //----------------------------------------------------------------------------
        // Process credit card request
        //----------------------------------------------------------------------------
        $requestParameters = array();
        $requestParameters["order.type"] = $orderType;
        $requestParameters["customer.username"] = $customerUsername;
        $requestParameters["customer.password"] = $customerPassword;
        $requestParameters["customer.merchant"] = $customerMerchant;
        $requestParameters["customer.orderNumber"] = $orderNumber;
        $requestParameters["customer.originalOrderNumber"] = $orderNumber;
        $requestParameters["card.PAN"] = $cardNumber;
        $requestParameters["card.CVN"] = $cardVerificationNumber;
        $requestParameters["card.expiryYear"] = $cardExpiryYear;
        $requestParameters["card.expiryMonth"] = $cardExpiryMonth;
        $requestParameters["card.currency"] = $cardCurrency;
        $requestParameters["order.amount"] = $orderAmountCents;
        $requestParameters["order.ECI"] = $orderECI;

        $requestText = $paywayAPI->formatRequestParameters($requestParameters);

        $responseText = $paywayAPI->processCreditCard($requestText);

        // Parse the response string into an array
        return $paywayAPI->parseResponseParameters($responseText);
    }
}
