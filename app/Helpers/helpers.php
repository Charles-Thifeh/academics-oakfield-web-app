<?php

/**
 * Write code on Method
 *
 * @return response()
 */
if (! function_exists('add_combined')) {
    function add_combined($single, $combined){
        if($single != null){
            $combined[] = $single;
            return $combined;
        }
        return $combined;
    }
}

if (! function_exists('average')) {
    function average($combined){
        if(!is_null($combined)){
            $total = array_sum($combined);
            $freq = count($combined);
            if( $freq == 0 ){
                return null;
            }
            $average = $total/$freq;
            return $average;
        }
        return 'yess';
    }
}
