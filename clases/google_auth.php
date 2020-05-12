<?php

class GoogleAuth
{
    protected $client;

    public function __construct(Google_Client $googleClient = null)
    {
        $this->client = $googleClient;
        if ($this->client) {
            $this->client->setClientId('551621774903-fsm3bi2pfmr34mk1s5q7tat77hnrbn98.apps.googleusercontent.com');
            $this->client->setClientSecret('TwDt3vnL0zK3XGlG3iASECet');
            $this->client->setRedirectUri('http://localhost/usb/Proyecto%20Final/index.php?ctl=main');
            $this->client->setScopes('email');
            $this->client->setAccessType("offline");
        }
    }

    public function isLoggedIn()
    {
        try {
            return isset($_SESSION['access_token']);
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . " isLogedIn" . PHP_EOL, 3, "logException.txt");
            return false;
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            return false;
        }
    }
    public function getAuthUrl()
    {
        try {
            return $this->client->createAuthUrl();
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . " getAuthUrl" . PHP_EOL, 3, "logException.txt");
            return false;
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            return false;
        }
    }
    public function checkRedirectCode()
    {
        try {
            if (isset($_GET["code"])) {
                $this->client->fetchAccessTokenWithAuthCode($_GET["code"]);
               /*  $_SESSION["access_token"] = $token; */
                $this->setToken($this->client->getAccessToken());
               echo  print_r($this->getPayLoad());
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . " checkRedirectCode" . PHP_EOL, 3, "logException.txt");
            return false;
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            return false;
        }
    }

    public function setToken($token)
    {
        try {
            $_SESSION["access_token"] = $token["access_token"];
            $this->client->setAccessToken($token["access_token"]);
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . " setToken $token" . PHP_EOL, 3, "logException.txt");
            return false;
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            return false;
        }
    }
    public function logout()
    {
        try {
            unset($_SESSION['access_token']);
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . " logout" . PHP_EOL, 3, "logException.txt");
            return false;
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            return false;
        }
    }

    public function getPayLoad(){
        $payload=$this->client->verifyIdToken()->getAttributes();
        return $payload;
    }
}
