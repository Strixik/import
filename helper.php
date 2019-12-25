<?php

function set_counter($add, $update, $delete){
    setcookie("add", $add);
    setcookie("update", $update);
    setcookie("delete", $delete);
}

function redirect(){
    header('location: index.php');
}

function csv_to_array($filename='', $delimiter=',')
{
    if(!file_exists($filename) || !is_readable($filename))
        return FALSE;

    $header = NULL;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== FALSE)
    {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
        {
            if(!$header)
                $header = $row;
            else
                $data[] = array_combine($header, $row);
        }
        fclose($handle);
    }
    return $data;
}
function csv_ids_array($csv)
{
    $ids_file = [];
    foreach ($csv as $item) {
        if (isset($item['uid'])) {
            $ids_file[] = $item['uid'];
        }

    }
    return $ids_file;
}
