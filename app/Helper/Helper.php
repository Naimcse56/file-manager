<?php


use Carbon\Carbon;
use Modules\ClearanceManagement\Models\ClearanceSetup;

if (!function_exists('showUserAvatar')) {
    function showUserAvatar($path) : string
    {
        if($path && file_exists('uploads/users/'.$path)){
            return asset('uploads/users/'.$path);
        }else{
            return asset('assets/images/avatars/avatar-1.png');
        }
    }
}

if (!function_exists('moduleManager')) {
    function moduleManager($moduleName) : string
    {
        if($moduleName == 'Mututal Assesments'){
            if(request()->is('/') || request()->is('mututal-assesments/*') || request()->is('user-management/*')){
                return true;
            }
        }elseif($moduleName == 'Clearance'){
            if(request()->is('clearance/*')){
                return true;
            }
        }
        return false;
    }
}

if (!function_exists('gv')) {
    function gv($params, $key, $default = null)
    {
        return (isset($params[$key]) && $params[$key]) ? $params[$key] : $default;
    }
}

if (!function_exists('getSubsectionNote')) {
    function getSubsectionNote($clearanceId, $subSection)
    {
        $clearance = ClearanceSetup::where('clearance_id', $clearanceId)->where('sub_section_id', $subSection)->first();
        if($clearance){
            return $clearance;
        }else{
            return NULL;
        }
    }
}

if (!function_exists('findSubSections')) {
    function findSubSections($clearanceId, $sectionId)
    {
        return ClearanceSetup::where('clearance_id', $clearanceId)
                ->where('section_id', $sectionId)
                ->whereNotNull('sub_section_id')
                ->count();
    }
}