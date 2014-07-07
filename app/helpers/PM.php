<?php

use Toomdrix\Pm\Configuration;
use Toomdrix\Pm\Project;

class PM {

    public static function getModuleName() {
        return strtolower(strstr(Route::currentRouteName(),'.', true));
    }

    public static function getActionName() {
        return strtolower(strstr(Route::currentRouteName(),'.'));
    }

    public static function formatDate($date) {
        return \DateTime::createFromFormat('Y-m-d', $date)->format('d/m/Y');
    }

    public static function getPriorityList() {
    	return json_decode(Configuration::find('priority_list')->value);
    }

    public static function getTypeFromCollection($collection) {
        if (!$collection->isEmpty()) {
            return str_replace('Toomdrix\\Pm\\', '', get_class($collection->first()));
        } elseif (isset($collection->type)) {
            return $collection->type;
        } else {
            return self::getModuleName();
        }
    }

    public static function log($data) {
        file_put_contents(dirname(__FILE__).'/log.txt', print_r($data, true));
    }
}