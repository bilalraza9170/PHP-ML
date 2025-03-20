<?php

require "vendor/autoload.php";

//Loading the data
$data = new \Phpml\Dataset\CsvDataset("./data/insurance.csv",1,true);
//Preprocessing the data
$dataset = new \Phpml\CrossValidation\RandomSplit($data,0.2,156);
//$dataset->getTestSamples();
//$dataset->getTestLabels();
//$dataset->getTrainSamples();
//$dataset->getTrainLabels();;
//Training
$regression = new \Phpml\Regression\LeastSquares();  //Linear Regression
$regression->train($dataset->getTrainSamples(),$dataset->getTrainLabels());

$predict = $regression->predict($dataset->getTestSamples()); //To check
//Evaluate
$score = \Phpml\Metric\Regression::r2Score($dataset->getTestLabels(),$predict); //static method no instance
//echo "r2Score is ".$score."\n";
//Making prediction with trained models
var_dump($regression->predict([80]));