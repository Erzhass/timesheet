<?php
$tasks=json_decode(file_get_contents(__DIR__.'/../db/tasks.json'), true) ?? [];
$timesheet=json_decode(file_get_contents(__DIR__.'/../db/timesheet.json'), true) ?? [];
$assets=json_decode(file_get_contents(__DIR__.'/../db/assets.json'), true) ?? [];
$today = date('d-m-Y');
$filename = "timesheet_".$today.".xlsx";

$tmp = sys_get_temp_dir().'/xlsx_'.uniqid();
mkdir($tmp);
mkdir("$tmp/_rels");
mkdir("$tmp/xl");
mkdir("$tmp/xl/worksheets");
mkdir("$tmp/xl/_rels");

// content types
file_put_contents("$tmp/[Content_Types].xml","<?xml version='1.0' encoding='UTF-8'?>
<Types xmlns='http://schemas.openxmlformats.org/package/2006/content-types'>
<Default Extension='rels' ContentType='application/vnd.openxmlformats-package.relationships+xml'/>
<Default Extension='xml' ContentType='application/xml'/>
<Override PartName='/xl/workbook.xml' ContentType='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml'/>
<Override PartName='/xl/worksheets/sheet1.xml' ContentType='application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml'/>
<Override PartName='/xl/worksheets/sheet2.xml' ContentType='application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml'/>
<Override PartName='/xl/worksheets/sheet3.xml' ContentType='application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml'/>
<Override PartName='/xl/worksheets/sheet4.xml' ContentType='application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml'/>
<Override PartName='/xl/worksheets/sheet5.xml' ContentType='application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml'/>
</Types>");

// rels
file_put_contents("$tmp/_rels/.rels","<?xml version='1.0' encoding='UTF-8'?>
<Relationships xmlns='http://schemas.openxmlformats.org/package/2006/relationships'>
 <Relationship Id='rId1' Type='http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument' Target='xl/workbook.xml'/>
</Relationships>");

// workbook
file_put_contents("$tmp/xl/workbook.xml","<?xml version='1.0' encoding='UTF-8'?>
<workbook xmlns='http://schemas.openxmlformats.org/spreadsheetml/2006/main' xmlns:r='http://schemas.openxmlformats.org/officeDocument/2006/relationships'>
 <sheets>
  <sheet name='Timesheet' sheetId='1' r:id='rId1'/>
  <sheet name='Rekap Tugas' sheetId='2' r:id='rId2'/>
  <sheet name='Rekap Warna' sheetId='3' r:id='rId3'/>
  <sheet name='Aset' sheetId='4' r:id='rId4'/>
  <sheet name='Rekap Timesheet' sheetId='5' r:id='rId5'/>
 </sheets>
</workbook>");

// workbook rels
file_put_contents("$tmp/xl/_rels/workbook.xml.rels","<?xml version='1.0' encoding='UTF-8'?>
<Relationships xmlns='http://schemas.openxmlformats.org/package/2006/relationships'>
 <Relationship Id='rId1' Type='http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet' Target='worksheets/sheet1.xml'/>
 <Relationship Id='rId2' Type='http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet' Target='worksheets/sheet2.xml'/>
 <Relationship Id='rId3' Type='http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet' Target='worksheets/sheet3.xml'/>
 <Relationship Id='rId4' Type='http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet' Target='worksheets/sheet4.xml'/>
 <Relationship Id='rId5' Type='http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet' Target='worksheets/sheet5.xml'/>
</Relationships>");

// helper to create simple sheet xml with rows array of arrays
function sheet_xml($rows){
  $xml = "<?xml version='1.0' encoding='UTF-8'?><worksheet xmlns='http://schemas.openxmlformats.org/spreadsheetml/2006/main'><sheetData>";
  $ridx=1;
  foreach($rows as $r){
    $xml .= "<row r='{$ridx}'>";
    $cidx=1;
    foreach($r as $cell){
      $col = columnName($cidx);
      $xml .= "<c r='{$col}{$ridx}' t='inlineStr'><is><t>".htmlspecialchars($cell)."</t></is></c>";
      $cidx++;
    }
    $xml .= "</row>";
    $ridx++;
  }
  $xml .= "</sheetData></worksheet>";
  return $xml;
}
function columnName($n){
  $s='';
  while($n>0){
    $n--; $s = chr(65+($n%26)).$s; $n = intval($n/26);
  }
  return $s;
}

// Sheet 1 - Timesheet
$rows = [['Kode','Tanggal','Jam','Kegiatan']];
foreach($timesheet as $t) $rows[] = [$t['kode'],$t['tanggal'],$t['jam'],$t['kegiatan']];
file_put_contents("$tmp/xl/worksheets/sheet1.xml", sheet_xml($rows));

// Sheet 2 - Rekap Tugas
$rows = [['Kode','Nama','Terpakai','Batas']];
foreach($tasks as $t) $rows[] = [$t['kode'],$t['nama'],$t['terpakai']??0,$t['batas_jam']];
file_put_contents("$tmp/xl/worksheets/sheet2.xml", sheet_xml($rows));

// Sheet 3 - Rekap Warna
$rows = [['Kode','Warna','Nama']];
foreach($tasks as $t) $rows[] = [$t['kode'],$t['warna'],$t['nama']];
file_put_contents("$tmp/xl/worksheets/sheet3.xml", sheet_xml($rows));

// Sheet 4 - Aset
$rows = [['Tanggal','Nama','Alokasi','Keterangan']];
foreach($assets as $a) $rows[] = [$a['tanggal'],$a['nama'],$a['alokasi'],$a['keterangan']];
file_put_contents("$tmp/xl/worksheets/sheet4.xml", sheet_xml($rows));

// Sheet 5 - Rekap Timesheet grouped by kode
$rows = [['Kode','Tanggal','Kegiatan']];
$group = [];
foreach($timesheet as $t){ $group[$t['kode']][] = $t; }
foreach($group as $kode => $items){
  foreach($items as $it) $rows[] = [$it['kode'],$it['tanggal'],$it['kegiatan']];
  $rows[] = ['','',''];
}
file_put_contents("$tmp/xl/worksheets/sheet5.xml", sheet_xml($rows));

// create zip
$zip = new ZipArchive();
$out = __DIR__.'/../export/'.$filename;
if($zip->open($out, ZipArchive::CREATE|ZipArchive::OVERWRITE)!==TRUE){ header('HTTP/1.1 500 Internal Server Error'); echo 'Cannot create zip'; exit; }

$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($tmp), RecursiveIteratorIterator::LEAVES_ONLY);
foreach($files as $name=>$file){
  if(!$file->isDir()){
    $filePath = $file->getRealPath();
    $relPath = substr($filePath, strlen($tmp)+1);
    $zip->addFile($filePath, $relPath);
  }
}
$zip->close();

// output
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'.$filename.'"');
readfile($out);
?>