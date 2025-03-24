<?php

require "vendor/autoload.php";

/*Loading the data*/
//$data = new \Phpml\Dataset\CsvDataset("./data/insurance.csv",1,true);
$data = new \Phpml\Dataset\CsvDataset("./data/wine.csv",13,true);
/*Preprocessing the data*/
//$dataset = new \Phpml\CrossValidation\RandomSplit($data,0.2,156);
$dataset = new \Phpml\CrossValidation\StratifiedRandomSplit($data,0.2,156);
//$dataset->getTestSamples();
//$dataset->getTestLabels();
//$dataset->getTrainSamples();
//$dataset->getTrainLabels();
/*Training*/
//$regression = new \Phpml\Regression\LeastSquares();  //Linear Regression
//Support Vector Regressor: Find the best line 0r plan that separate different groups and match the nearest match
//$regression = new \Phpml\Regression\SVR();
//Classification there is no flow of data only discrete data. opp of regression.
//KNN: KnearestNeighbours assign label to u based on the closed neighbour
$classification = new \Phpml\Classification\KNearestNeighbors();
$classification->train($dataset->getTrainSamples(),$dataset->getTrainLabels());

$predict = $classification->predict($dataset->getTestSamples()); //To check
/*Evaluate*/
//$score = \Phpml\Metric\Regression::r2Score($dataset->getTestLabels(),$predict); //static method no instance
//echo "r2Score is ".$score."\n";
//
//foreach ($predict as &$target){ //& only change the positioned value
//    $target = round($target,0);
//}
$accuracy = \Phpml\Metric\Accuracy::score($dataset->getTestLabels(),$predict); //mainly for classification so no decimal
echo "accuracy is ".$accuracy."\n";

/*Making prediction with trained models*/
//var_dump($regression->predict([80]));