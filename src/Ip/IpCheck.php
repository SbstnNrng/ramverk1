<?php

namespace Seb\Ip;

class IpCheck
{
    /**
     * @return string to show the status of the Ip.
     */

    public function checkIp($ipIn)
    {
        if (filter_var($ipIn, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return ("$ipIn is a valid IPV4 address");
        } else if (filter_var($ipIn, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            return ("$ipIn is a valid IPV6 address");
        } else {
            return ("$ipIn is not a valid IP address");
        }
    }

    /**
     * @return string to show the status of the guess made.
     */

    public function checkDomain($ipIn)
    {
        if (filter_var($ipIn, FILTER_VALIDATE_IP)) {
            $domain = gethostbyaddr($ipIn);
            if ($domain == $ipIn) {
                return ("$ipIn has no domain");
            }
            return ("$domain");
        } else {
            return ("Invalid IP");
        }
    }
}
