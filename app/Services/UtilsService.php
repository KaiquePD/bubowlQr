<?php

namespace App\Services;

/**
 * Class utilsService
 * @package App\Services
 */
class UtilsService
{
    /**
     * utilsService constructor.
     */
    public function __construct()
    {
        #call your models, repositories and another things here
    }

    public static function removeSpecialChar($text){
        $text = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$text);
        $text = iconv('UTF-8', 'ASCII//TRANSLIT', $text);
        $text = str_replace(' ', '-', $text);
        $text = str_replace('"', '', $text);
        $text = strtolower($text);
        return str_replace('/', '-', $text);
    }
}