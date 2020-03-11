<?php
namespace Modules\Languages\Facades;

use Modules\Languages\Entities\Language;
class LanguagesFacade
{
    public static function getArrayLanguageCode(){
        $languages = Language::where('actif', 1)->get();
        $result = array();
        foreach ($languages as $key=>$language)
        {
            $result[$language->name] =$language->name;
        }

        return $result;
    }
}