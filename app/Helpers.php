<?php

function toAttrJson($data, $list = []){
    if (count($list)){
        $tmp = array();
        $data = (array)$data;
        foreach ($list as $key){
            $tmp[$key] = $data[$key];
        }
        return json_encode($tmp);
    }
    return json_encode($data);
}
