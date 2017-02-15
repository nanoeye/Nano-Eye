<?php

class Visitor
{

    public function __construct(){}

    private function url_origin($s, $use_forwarded_host = false)
    {
        $ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on');
        $sp = strtolower($s['SERVER_PROTOCOL']);
        $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
        $port = $s['SERVER_PORT'];
        $port = ((!$ssl && $port == '80') || ($ssl && $port == '443')) ? '' : ':' . $port;
        $host = ($use_forwarded_host && isset($s['HTTP_X_FORWARDED_HOST'])) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
        $host = isset($host) ? $host : $s['SERVER_NAME'] . $port;
        return $protocol . '://' . $host;
    }

    public function VisitedPageURL($s, $use_forwarded_host = false)
    {
        return $this->url_origin($s, $use_forwarded_host) . $s['REQUEST_URI'];
    }

    public function VisitedPage()
    {
        return $this->VisitedPageURL($_SERVER);
    }

    public function VisitedPageTitle()
    {
        error_reporting(E_ALL);
        
        // SET DEFAULT
        $title = 'NO TITLE FOUND';
        
        //Web url
        $url = $this->VisitedPage();
        
        // OPEN THE REMOTE PAGE
        $file = fopen($url,"r") or die ("url not found");
        
        // ITERATE OVER THE PAGE DATA
        while (!feof($file))
        {
            $text = fread($file,16384);
            if (preg_match('/<title>(.*?)<\/title>/is',$text,$found))
            {
                $title = $found[1];
                break;
            }
        }
        
        return $title;

    }
    
    public function Visitor()
    {
        $client = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote = $_SERVER['REMOTE_ADDR'];

        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }

        return $ip;
    }

    public function VisitorCountry()
        {

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://www.geoplugin.net/json.gp?ip=".$this->Visitor());
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $ip_data_in = curl_exec($ch); // string
            curl_close($ch);

            $ip_data = json_decode($ip_data_in,true);
            $ip_data = str_replace('&quot;', '"', $ip_data); // for PHP 5.2 see stackoverflow.com/questions/3110487/


            if($ip_data && $ip_data['geoplugin_countryName'] != null) {
                $country = $ip_data['geoplugin_countryName'];
            }

            return $country;
        }

    public function VisitorInfo($ip = NULL, $purpose = "location", $deep_detect = TRUE)
    {
        $output = NULL;
        if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
            $ip = $_SERVER["REMOTE_ADDR"];
            if ($deep_detect) {
                if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
        $purpose = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
        $support = array("country", "countrycode", "state", "region", "city", "location", "address");
        $continents = array(
            "AF" => "Africa",
            "AN" => "Antarctica",
            "AS" => "Asia",
            "EU" => "Europe",
            "OC" => "Australia (Oceania)",
            "NA" => "North America",
            "SA" => "South America"
        );
        if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
            $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
            if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
                switch ($purpose) {
                    case "location":
                        $output = array(
                            "city" => @$ipdat->geoplugin_city,
                            "state" => @$ipdat->geoplugin_regionName,
                            "country" => @$ipdat->geoplugin_countryName,
                            "country_code" => @$ipdat->geoplugin_countryCode,
                            "continent" => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                            "continent_code" => @$ipdat->geoplugin_continentCode
                        );
                        break;
                    case "address":
                        $address = array($ipdat->geoplugin_countryName);
                        if (@strlen($ipdat->geoplugin_regionName) >= 1)
                            $address[] = $ipdat->geoplugin_regionName;
                        if (@strlen($ipdat->geoplugin_city) >= 1)
                            $address[] = $ipdat->geoplugin_city;
                        $output = implode(", ", array_reverse($address));
                        break;
                    case "city":
                        $output = @$ipdat->geoplugin_city;
                        break;
                    case "state":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "region":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "country":
                        $output = @$ipdat->geoplugin_countryName;
                        break;
                    case "countrycode":
                        $output = @$ipdat->geoplugin_countryCode;
                        break;
                }
            }
        }
        return $output;

    }

    public function VisitorOS()
    {


        $os_platform = "Unknown OS Platform";

        $os_array = array(
            '/windows nt 10/i' => 'Windows 10',
            '/windows nt 6.3/i' => 'Windows 8.1',
            '/windows nt 6.2/i' => 'Windows 8',
            '/windows nt 6.1/i' => 'Windows 7',
            '/windows nt 6.0/i' => 'Windows Vista',
            '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
            '/windows nt 5.1/i' => 'Windows XP',
            '/windows xp/i' => 'Windows XP',
            '/windows nt 5.0/i' => 'Windows 2000',
            '/windows me/i' => 'Windows ME',
            '/win98/i' => 'Windows 98',
            '/win95/i' => 'Windows 95',
            '/win16/i' => 'Windows 3.11',
            '/macintosh|mac os x/i' => 'Mac OS X',
            '/mac_powerpc/i' => 'Mac OS 9',
            '/linux/i' => 'Linux',
            '/ubuntu/i' => 'Ubuntu',
            '/iphone/i' => 'iPhone',
            '/ipod/i' => 'iPod',
            '/ipad/i' => 'iPad',
            '/android/i' => 'Android',
            '/blackberry/i' => 'BlackBerry',
            '/webos/i' => 'Mobile'
        );

        foreach ($os_array as $regex => $value) {

            if (preg_match($regex, $_SERVER['HTTP_USER_AGENT'])) {
                $os_platform = $value;
            }

        }

        return $os_platform;

    }

    public function VisitorBrowser()
    {

        $browser = "Unknown Browser";

        $browser_array = array(
            '/msie/i' => 'Internet Explorer',
            '/firefox/i' => 'Mozilla Firefox',
            '/safari/i' => 'Safari',
            '/chrome/i' => 'Google Chrome',
            '/edge/i' => 'Edge',
            '/opera/i' => 'Opera',
            '/netscape/i' => 'Netscape',
            '/maxthon/i' => 'Maxthon',
            '/konqueror/i' => 'Konqueror',
            '/mobile/i' => 'Handheld Browser'
        );

        foreach ($browser_array as $regex => $value) {

            if (preg_match($regex, $_SERVER['HTTP_USER_AGENT'])) {
                $browser = $value;
            }

        }

        return $browser;

    }

    public function PageLoadTime($name)
    {

        $mtime = explode(' ', microtime());
        $time = $mtime[1] + $mtime[0];

        //determine if we're starting the timer or ending it
        if ($_SESSION["timer-$name"]) {
            $stime = $_SESSION["timer-$name"];
            unset($_SESSION["timer-$name"]);
            return ($time - $stime);
        } else {
            $_SESSION["timer-$name"] = $time;
            return (true);
        }
    }

    public function HostIPAddress()
    {
        return gethostbyname($_SERVER["SERVER_NAME"]);
 
    }

    public function HostComputerName()
    {
        return gethostname();
    }

    public function HostComputerDetails()
    {
        return php_uname();
    }

    public function test()
    {
        return 'ok';
        /*        return $message;*/
    }
}