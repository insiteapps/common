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

use SilverStripe\Assets\Image;

class FittedImage extends Image
{

   function Fit($width, $height){
       return $this->CroppedResize($width, $height);
   }

    function ScaleWidth($width){
        return $this->ResizeByWidth($width);
    }
    function ScaleHeight($height){
        return $this->ResizeByHeight($height);
    }
    function generateCroppedResize($gd, $width, $height)
    {
        return $gd->croppedResize($width, $height);
    }

    function generatePaddedResize($gd, $width, $height)
    {
        return $gd->paddedResize($width, $height);
    }

    function generateFittedResize($gd, $width, $height)
    {
        return $gd->fittedResize($width, $height);
    }

    function generateResize($gd, $width, $height)
    {
        return $gd->resize($width, $height);
    }

    function generateResizeByWidth($gd, $width)
    {
        return $gd->resizeByWidth($width);
    }

    function generateResizeByHeight($gd, $height)
    {
        return $gd->resizeByHeight($height);
    }

    function generateResizeRatio($gd, $width, $height)
    {
        return $gd->resizeRatio($width, $height);
    }

}
