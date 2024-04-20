<?php
    function loadRuhak() {
        if (!file_exists("json/ruhak.json"))
            die("Nem sikerült a fájl megnyitása!");

        $json = file_get_contents("json/ruhak.json");

        return json_decode($json, true);
    }

    function saveRuha($data) {
        $ruha = loadRuhak();
        $ruha["ruhak"][] = $data;

        $json_data = json_encode($ruha, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        file_put_contents("json/ruhak.json", $json_data);
    }

    function deleteRuha($deleteRuhaName) {
        $ruhak = loadRuhak();
        $ruhaFile = fopen("json/ruhak.json", "w");
        fclose($ruhaFile);

        foreach ($ruhak["ruhak"] as $ruha) {
            if (!($deleteRuhaName === $ruha["ruhanev"])) {
                saveRuha($ruha);
            }
        }
    }

    function changeRuhak($ruhaNev, $data) {
        $ruhak = loadRuhak();

        if (!is_null($ruhak)) {
            foreach($ruhak["ruhak"] as $ruha) {
                if ($ruhaNev === $ruha["ruhanev"]) {
                    deleteCart($ruha["ruhanev"]);
                    saveCart($data);
                    break;
                }
            }  
        }
    }
?>