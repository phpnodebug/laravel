<?php

namespace App\Traits\Model\Backend;

trait ModelsExtendsTrait
{
// 多where
    public function  scopeMultiwhere($query,$arr,$like='=')
    {
        if (!is_array($arr)) {
            return $query;
        }
        foreach ($arr as $key => $value) {
            if(!empty($value)){
                if($like=='like'){
                    $value='%'.$value.'%';
                }
                $query = $query->where($key,$like,$value);
            }
        }
        return $query;
    }
}