<?php
	
	$numberOfMonitors = 3; // EDIT THIS ACCORDING TO YOUR NUMBER OF MONITORS
	$major = 2;
	$minor = 0;
	$build = 1;
	
	$inputFile      = fopen("inputFile.txt", "r"); // BEST LEAVE AS IS
	$outputFileName = "nbGrid_" . $numberOfMonitors . "mon_v" . $major . "." . $minor . "." . $build . ".grid";
	$outputFile     = fopen($outputFileName, "w"); // BEST LEAVE AS IS
	
	$inputFileLineArray = [];
	$outputLineArray    = [];
	$counter            = 1;
	
	while ($inputFileLine = fgets($inputFile)) {
		if (trim($inputFileLine) != "") {
			$inputFileLineArray[] = $inputFileLine;
		}
	}
	
	$inputFileLineArray[] = "\n\n";
	
	for ($i = 1; $i <= $numberOfMonitors; $i++) {
		foreach ($inputFileLineArray as $outputLine) {
			if (substr($outputLine, 0, 1) == "[") {
				$outputLine = "\n[" . $counter . "]\n";
				$counter += 1;
			}
			$outputLineArray[] = str_replace("Monitor1", "Monitor" . $i, $outputLine);
		}
	}
	
	$counter -= 1;
	
	$header = ";-------------------------------------------------------------------------
; Created:   " . date("Y-m-d") . "
; Grid Name: nbGrid
; Version:   " . $major . "." . $minor . "." . $build . "
; Monitors:  " . $numberOfMonitors . "
; Groups:    " . $counter . "
; By:        Nikola Bogdanovic
; 
; Based on xipergrid2.grid and an amazing idea and work put into it.
;-------------------------------------------------------------------------

[Groups]
NumberOfGroups = " . $counter . "\n";
	
	fwrite($outputFile, $header);
	
	foreach ($outputLineArray as $outputLine) {
		fwrite($outputFile, $outputLine);
	}
	
	fclose($inputFile);
	fclose($outputFile);
	
	echo "Finished building " . $outputFileName;