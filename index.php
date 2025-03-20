<?php

require "vendor/autoload.php";

//Loading the data
$data = new \Phpml\Dataset\CsvDataset("./data/insurance.csv",1,true);