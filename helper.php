<?php
/*
 * Встановлюємо лічильники добавлених обновлених видалених
 */
function set_counter($add, $update, $delete){
    setcookie("add", $add);
    setcookie("update", $update);
    setcookie("delete", $delete);
}
/*
 * Вертаємо на головну
 */
function redirect(){
    header('location: index.php');
}
/*
 * Перетворюємо файл в масив
 */
function csv_to_array($filename='', $delimiter=',')
{
    if(!file_exists($filename) || !is_readable($filename))
        return false;

    $header = null;
    $data = [];
    if (($handle = fopen($filename, 'r')) !== false)
    {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
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
/*
 * Створюємо масив з ід які не видаляти
 */
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
