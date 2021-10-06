<?php


function arr_filter($data, $keys, $val)
{
    $return = [];
    foreach ($data as $key => $value) {
        $return[$value[$keys]] = $value[$val];
    }

    return $return;
}

function arr_where($data){
    $return = '';
    foreach ($data as $key => $value) {
        $return .= $value.',';

    }
    return $return;
}
