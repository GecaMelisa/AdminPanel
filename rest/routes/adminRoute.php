<?php 


Flight::route("GET /admins", function(){
    Flight::json(Flight::admin_service()->get_all());
 });
 
 Flight::route("GET /admin_by_id", function(){
    Flight::json(Flight::admin_service()->get_by_id(Flight::request()->query['id']));
 });
 
 Flight::route("GET /admins/@id", function($id){
    Flight::json(Flight::admin_service()->get_by_id($id));
 });
 
 ?>