<?php
header("Content-Type: application/json");

$path = "../db/tasks.json";
$data = json_decode(file_get_contents($path), true);

$input = json_decode(file_get_contents("php://input"), true);

$kode = $input["kode"];

foreach ($data as &$row) {
    if ($row["kode"] == $kode) {

        if (isset($input["nama"])) 
            $row["nama"] = $input["nama"];

        if (isset($input["batas_jam"])) 
            $row["batas_jam"] = $input["batas_jam"];

        // ✅ terpakai default 0 kalau tidak ada
        if (!isset($row["terpakai"])) 
            $row["terpakai"] = 0;

        // ✅ warna jangan hilang
        if (!isset($row["warna"]) || $row["warna"] == "") 
            $row["warna"] = "#1e40af";
    }
}

file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT));

echo json_encode(["status"=>"ok"]);
?>
