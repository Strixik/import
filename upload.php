<?php

require "./conn.php";
require "./helper.php";

$db_conn = Database::connect();

if (isset($_POST['upload'])) {
    $add = 0;
    $update = 0;
    $delete = 0;
    if (!empty($_FILES['file']['name'])) {
        $filename = explode(".", $_FILES['file']['name']);
        $ext = end($filename);
        if ($ext == "csv") {
            $csv = csv_to_array($_FILES['file']['tmp_name']);
            $ids_file = csv_ids_array($csv);
            foreach ($csv as $data) {
                if ($data === false) continue;
                try {
                    $query = $db_conn->prepare("SELECT * FROM documets WHERE uid = :uid;");
                    $uid = ["uid" => $data['uid']];
                    $query->execute($uid);
                    $items = $query->fetchAll();
                    $values = $data;
                    $count = count($items);
                    if ($count > 0) {
                        if ($items[0]['dateChange'] != $data['dateChange']) {
                            $query = $db_conn->prepare("UPDATE documets SET firstName=:firstName, lastName=:lastName, birthDay=:birthDay, dateChange=:dateChange, description =:description WHERE uid=:uid");
                            $query->execute($values);
                            $update += $query->rowCount();
                        }
                    }
                    if ($count === 0) {
                        $query = $db_conn->prepare("INSERT INTO documets (uid,firstName,lastName,birthDay,dateChange, description) VALUES(:uid,:firstName,:lastName,:birthDay,:dateChange,:description)");
                        $query->execute($values);
                        $add += $query->rowCount();
                    }
                    $ids = implode("', '", $ids_file);
                    $query = $db_conn->prepare("DELETE FROM documets WHERE  uid NOT IN('" . $ids . "')");
                    $query->execute();
                    $delete += $query->rowCount();
                } catch (PDOException $e) {
                    setcookie("error", $e->getMessage());
                }
            }

            set_counter($add, $update, $delete);
            setcookie ("error", "", time() - 3600);
            redirect();
        } else {
            setcookie("error", 'Only csv file is allowed to be upload!');
            redirect();
        }
    } else {
        set_counter($add, $update, $delete);
        setcookie ("error", "", time() - 3600);
        redirect();
    }

}

