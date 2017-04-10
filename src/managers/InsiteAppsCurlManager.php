<?php
/**
 *
 * Copyright (c) 2017 Insite Apps - http://www.insiteapps.co.za
 * All rights reserved.
 * @package insiteapps
 * @author Patrick Chitovoro  <patrick@insiteapps.co.za>
 * Redistribution and use in source and binary forms, with or without modification, are NOT permitted at all.
 * There is no freedom to share or change it this file.
 *
 *
 */

/**
 * Class InsiteAppsCurlManager
 */
class InsiteAppsCurlManager extends InsiteAppsCommonManager
{

    /**
     * @param $url
     * @param null $postFields
     * @return mixed
     */
    public function processCurl($url, $postFields = null,array $aHeaders = array())
    {
        ob_start();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeaders);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $results = json_decode(curl_exec($ch), true);
        curl_close($ch);
        return $results;
    }

    /**
     * @param $url
     * @param array $aHeaders
     * @return mixed
     */
    public function processCurlWithHeaders($url, array $aHeaders = array())
    {
        ob_start();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30); //30 seconds
        curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeaders);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_NOBODY, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $return = curl_exec($ch);
        curl_close($ch);
        return json_decode($return, true);
    }
} 
