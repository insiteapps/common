<?php

class InsiteMainController extends Controller
{

    static public function AddProtocol($url)
    {
        if (strtolower(substr($url, 0, 8)) !== 'https://' && strtolower(substr($url, 0, 7)) !== 'http://') {
            return 'http://' . $url;
        }
        return $url;
    }

    /**
     *
     * @param array $request
     * @param array $Unset
     * @return array
     */
    public static function cleanREQUEST(array $request, array $Unset = array())
    {
        $request = Convert::raw2sql($request);
        $aUnset = array('url', 'SecurityID');
        $arrUnset = array_merge($aUnset, $Unset);
        foreach ($arrUnset as $value) {
            unset($request[$value]);
        }
        return $request;
    }

}
