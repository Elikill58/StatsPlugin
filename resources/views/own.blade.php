@extends('layouts.app')

<?php
$database = setting('playerstats.database');
$dbType = config("database.default");
config([
    'database.connections.' . $database . '.driver' => $dbType,
    'database.connections.' . $database . '.host' => setting('playerstats.host') ? setting('playerstats.host') : config("database.connections." . $dbType . ".host"),
    'database.connections.' . $database . '.port' => setting('playerstats.port') ? setting('playerstats.port') : config("database.connections." . $dbType . ".port"),
    'database.connections.' . $database . '.username' => setting('playerstats.username') ? setting('playerstats.username') : config("database.connections." . $dbType . ".username"),
    'database.connections.' . $database . '.password' => setting('playerstats.password') ? setting('playerstats.password') : config("database.connections." . $dbType . ".password"),
    'database.connections.' . $database . '.database' => $database
]);
$name = $user->name;
$result = DB::connection($database)->select("SELECT * FROM " . setting("playerstats.table") . " WHERE " . setting("playerstats.column_name") . " = ?", [$name]);
if(isset($result) && count($result) > 0) {
    $dbResult = json_decode(json_encode($result[0]), true);
    $uuid = $dbResult[setting("playerstats.column_uuid")];
    $name = $dbResult[setting("playerstats.column_name")];
} else {
    $uuid = $name;
}
?>

@section('title', trans('playerstats::messages.own.title'))

@include('playerstats::_one_player')