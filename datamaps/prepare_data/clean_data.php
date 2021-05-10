<?php
// Format json to be used by d3js datamaps

$data = file_get_contents('bulgaria_provinces.topojson');
$array = (array)json_decode($data, true);

$cleaned = [];
$cleaned['type'] = $array['type'];
$cleaned['arcs'] = $array['arcs'];
$cleaned['transform'] = $array['transform'];
$cleaned['objects'] = $array['objects'];
$cleaned['objects']['subunits'] = ((array)$array['objects'])['BGR_adm1'];
$cleaned['objects']['BGR_adm1'] = [];
$cleaned['objects']['subunits']['geometries'] = [];


$geometries = [];
foreach (((array)$array['objects'])['BGR_adm1']['geometries'] as $region) {
    $geometry = $region;
    $geometry['id'] = $region['properties']['NAME_1'];
    $geometries[] = $geometry;
}

$cleaned['objects']['subunits']['geometries'] = $geometries;

$newjson = json_encode($cleaned);
file_put_contents('provinces.json', $newjson);


