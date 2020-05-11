<?php 

    class GoogleAuth{
        protected $client;

        public function __construct(Google_Client $googleClient=null)
        {
          $this->client=$googleClient;
          if($this->client){
              $this->client->setClientId('551621774903-fsm3bi2pfmr34mk1s5q7tat77hnrbn98.apps.googleusercontent.com');
              $this->client->setClientSecret('TwDt3vnL0zK3XGlG3iASECet');
              $this->client->setRedirectUri('http://localhost/usb/Proyecto%20Final/index.php?ctl=login');
              $this->client->setScopes('email');
          }
        }

        public function isLoggedIn(){
            return isset($_SESSION['access_token']);
        }
        public function getAuthUrl(){
            return $this->client->createAuthUrl();
        }
        public function checkRedirectCode(){
            if(isset($_GET["code"])){
                $this->client->authenticate($_GET["code"]);
                $this->setToken($this->client->getAccessToken());
                return true;
            }else
            return false;
        }

        public function setToken($token){
            $_SESSION["access_token"]=$token;
            $this->client->setAccessToken($token);
        }
    }

?>