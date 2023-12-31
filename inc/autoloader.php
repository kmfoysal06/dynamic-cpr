<?php
spl_autoload_register(function($name){
	require_once plugin_dir_path(__FILE__)."inc/".$name."inc.php";
});