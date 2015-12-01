<?php
	
	$tPosArray = ["0", "1/25", "2/25", "3/25", "4/25", "5/25", "6/25", "7/25", "8/25"];
	$wPosArray = ["0", "1/5",  "1/4",  "1/3",  "1/2",  "2/3",  "3/4",  "4/5",  "1/5"];
	
	/*$tPosArrayGroup = [
		["0",     "1/23",   "2/23",  "3/23",  "4/23",  "5/23",  "6/23",  "7/23"],
		["8/23",  "9/23",   "10/23", "11/23", "12/23", "13/23", "14/23", "15/23"],
		["16/23", "17/23",  "18/23", "19/23", "20/23", "21/23", "22/23", "23/23"]
	];
	$wPosArrayGroup = [
		["0", "1/5",  "1/4",  "1/3",  "1/2",  "2/3",  "3/4",  "4/5",  "1/5"],
		["0", "1/5",  "1/4",  "1/3",  "1/2",  "2/3",  "3/4",  "4/5",  "1/5"],
		["0", "1/5",  "1/4",  "1/3",  "1/2",  "2/3",  "3/4",  "4/5",  "1/5"]
	];*/
	
	$counter = 1;
	$outputArray = [];
	
	/*foreach ($tPosArrayGroup as $tPosGroupKey => $tPosArray) {
		foreach ($tPosArray as $tPosArrayKey => $tPos) {
			foreach ($wPosArrayGroup[$tPosGroupKey] as $wPosGroupKey => $wPosGroup) {
				
				
				
			}
			
			
			$outputArray[] = "
			
TriggerTop    = [Monitor1Top]  + [Monitor1Height] * " . $tPosGroupKey . "
TriggerBottom = [Monitor1Top]  + [Monitor1Height] * " .  . "
TriggerLeft   = [Monitor1Left] + [Monitor1Width]  * " .  . "
TriggerRight  = [Monitor1Left] + [Monitor1Width]  * " .  . "
GridTop       = [Monitor1Top]  + [Monitor1Height] *  " .  . "
GridBottom    = [Monitor1Top]  + [Monitor1Height] *  " .  . "
GridLeft      = [Monitor1Left] + [Monitor1Width]  *  " .  . "
GridRight     = [Monitor1Left] + [Monitor1Width]  *  " .  . "";
			
		}
	}*/
	
	for ($i = 0; $i < 7; $i++) {
		for ($j = 0; $j < 7; $j++) {
			
			$outputArray[] = "[" . $counter . "]
TriggerTop    = [Monitor1Top]  + [Monitor1Height] * " . $tPosArray[$i] . "
TriggerBottom = [Monitor1Top]  + [Monitor1Height] * " . $tPosArray[$i + 1] . "
TriggerLeft   = [Monitor1Left] + [Monitor1Width]  * " . $tPosArray[$j] . "
TriggerRight  = [Monitor1Left] + [Monitor1Width]  * " . $tPosArray[$j + 1] . "
GridTop       = [Monitor1Top]  + [Monitor1Height] *  0
GridBottom    = [Monitor1Top]  + [Monitor1Height] *  " . $wPosArray[$i + 1] . "
GridLeft      = [Monitor1Left] + [Monitor1Width]  *  0
GridRight     = [Monitor1Left] + [Monitor1Width]  *  " . $wPosArray[$j + 1] . "

";
			$counter += 1;
		}
	}
	
	$handle = fopen("test.grid", "w");
	
	fwrite($handle, "[Groups]
NumberOfGroups = " . ($counter - 1) . "

");

	foreach ($outputArray as $output) {
		fwrite($handle, $output);
	}
	
	fclose($handle);