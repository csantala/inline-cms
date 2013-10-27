<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	include_once('/libaries/bigpipe/browser.php');

	// alternatively, set this in php.ini
	date_default_timezone_set('America/New_York');

    class Stats_lib
    {

        public function getStats()
        {
            if(is_null(self::$me))
                self::$me = new Stats_lib();
            return self::$me;
        }

        public static function track($page_title = '')
        {

			$browser          = new Browser();

            $dt               = self::dater();
            $referer          = getenv('HTTP_REFERER');
            $referer_is_local = self::refererIsLocal($referer);
            $url              = self::full_url();
            $search_terms     = self::searchTerms();
            $img_search       = '0';
            $ip               = self::getIP();
            $info             = self::browserInfo();
            $browser_family   = $browser->getBrowser();
            $browser_version  = $browser->getVersion();
            $os               = $info['platform'];
            $os_version       = '';
            $user_agent       = $info['useragent'];

            $exec_time = defined('START_TIME') ? microtime(true) - START_TIME : 0;
            $num_queries      = '0';

            $stats = array('dt'               => $dt,
                          'referer_is_local' => $referer_is_local,
                          'referer'          => $referer,
                          'url'              => $url,
                          'page_title'       => $page_title,
                          'search_terms'     => $search_terms,
                          'img_search'       => $img_search,
                          'ip'               => $ip,
                          'browser_family'   => $browser_family,
                          'browser_version'  => $browser_version,
                          'os_version'       => $os_version,
                          'os'               => $os,
                          'user_agent'       => $user_agent,
                          'exec_time'        => $exec_time,
                          'num_queries'      => $num_queries);
			$CI =& get_instance();
            $CI->db->insert('stats', $stats);
        }

		function full_url()
		{
			$s = empty($_SERVER['HTTPS']) ? '' : ($_SERVER['HTTPS'] == 'on') ? 's' : '';
			$protocol = substr(strtolower($_SERVER['SERVER_PROTOCOL']), 0, strpos(strtolower($_SERVER['SERVER_PROTOCOL']), '/')) . $s;
			$port = ($_SERVER['SERVER_PORT'] == '80') ? '' : (":".$_SERVER['SERVER_PORT']);
			return $protocol . "://" . $_SERVER['HTTP_HOST'] . $port . $_SERVER['REQUEST_URI'];
		}


        public static function refererIsLocal($referer = null)
        {
            if(is_null($referer)) $referer = getenv('HTTP_REFERER');
            if(!strlen($referer)) return 0;
            $regex_host = preg_quote(getenv('HTTP_HOST'));
            return (preg_match("!^https?://$regex_host!i", $referer) !== false) ? 1 : 0;
        }

        public static function getIP()
        {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
            if(!$ip) $ip = getenv('HTTP_CLIENT_IP');
            if(!$ip) $ip = getenv('REMOTE_ADDR');
            return $ip;
        }

        public static function searchTerms($url = null)
        {
            if(is_null($url)) $url = self::full_url();
            // if(self::refererIsLocal($url)) return;

            $arr = array();
            parse_str(parse_url($url, PHP_URL_QUERY), $arr);

            return isset($arr['q']) ? $arr['q'] : '';
        }

        // From http://us3.php.net/get_browser comments
        public static function browserInfo($a_browser = false, $a_version = false, $name = false)
        {
            $browser_list = 'msie firefox konqueror safari netscape navigator opera mosaic lynx amaya omniweb chrome avant camino flock seamonkey aol mozilla gecko';
            $user_browser = strtolower(getenv('HTTP_USER_AGENT'));
            $this_version = $this_browser = '';

            $browser_limit = strlen($user_browser);
            foreach(explode(' ', $browser_list) as $row)
            {
                $row = ($a_browser !== false) ? $a_browser : $row;
                $n = stristr($user_browser, $row);
                if(!$n || !empty($this_browser)) continue;

                $this_browser = $row;
                $j = strpos($user_browser, $row) + strlen($row) + 1;
                for(; $j <= $browser_limit; $j++)
                {
                    $s = trim(substr($user_browser, $j, 1));
                    $this_version .= $s;

                    if($s === '') break;
                }
            }

            if($a_browser !== false)
            {
                $ret = false;
                if(strtolower($a_browser) == $this_browser)
                {
                    $ret = true;

                    if($a_version !== false && !empty($this_version))
                    {
                        $a_sign = explode(' ', $a_version);
                        if(version_compare($this_version, $a_sign[1], $a_sign[0]) === false)
                        {
                            $ret = false;
                        }
                    }
                }

                return $ret;
            }

            $this_platform = '';
            if(strpos($user_browser, 'linux'))
            {
                $this_platform = 'linux';
            }
            elseif(strpos($user_browser, 'macintosh') || strpos($user_browser, 'mac platform x'))
            {
                $this_platform = 'mac';
            }
            elseif(strpos($user_browser, 'windows') || strpos($user_browser, 'win32'))
            {
                $this_platform = 'windows';
            }

            if($name !== false)
            {
                return $this_browser . ' ' . $this_version;
            }

            return array("browser"   => $this_browser,
                         "version"   => $this_version,
                         "platform"  => $this_platform,
                         "useragent" => $user_browser);
        }

		    // Converts a date/timestamp into the specified format
		function dater($date = null, $format = null)
		{
			if(is_null($format))
				$format = 'Y-m-d H:i:s';

			if(is_null($date))
				$date = time();

			// if $date contains only numbers, treat it as a timestamp
			if(ctype_digit($date) === true)
				return date($format, $date);
			else
				return date($format, strtotime($date));
		}
    }