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
 * Same as the normal system email class, but runs the content through
 * Emogrifier to merge css rules inline before sending.
 *
 * @author Patrick Chitovoro
 * @package insiteapps-common
 * @subpackage emails
 */
class InsiteProcessedEmail extends Email
{

    public $signature;

    protected function parseVariables($isPlain = false)
    {
        parent::parseVariables($isPlain);

        // if it's an html email, filter it through emogrifier
        if (!$isPlain && preg_match('/<style[^>]*>(?:<\!--)?(.*)(?:-->)?<\/style>/ims', $this->body, $match)) {
            $css = $match[1];
            $html = str_replace(
                array(
                    "<p>\n<table>",
                    "</table>\n</p>",
                    '&copy ',
                    $match[0],
                ),
                array(
                    "<table>",
                    "</table>",
                    '',
                    '',
                ),
                $this->body
            );

            $emog = new Emogrifier($html, $css);
            $this->body = $emog->emogrify();
        }
    }

}
