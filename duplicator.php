<?php
	
	$inputFile = fopen("inputFile.txt", "r");
	$outputFile = fopen("nbGrid-1-3.grid", "w");
	
	$numberOfMonitors = 10;
	$fileLineArray = [];
	$outputLineArray = [];
	$counter = 1;
	
	while ($line = fgets($inputFile)) {
			$fileLineArray[] = $line;
	}
	
	$fileLineArray[] = "\n\n";
	
	for ($i = 1; $i <= $numberOfMonitors; $i++) {
		foreach ($fileLineArray as $outputLine) {
			if (substr($outputLine, 0, 1) == "[") {
				$outputLine = "[" . $counter . "]\n";
				$counter += 1;
			}
			$outputLineArray[] = str_replace("Monitor1", "Monitor" . $i, $outputLine);
			//fwrite($outputFile, str_replace("Monitor1", "Monitor" . $i, $outputLine));
		}
	}
	
	$counter -= 1;
	
	$header = ";-------------------------------------------------------------------------
; Created:   " . date("Y-m-d") . "
; Grid Name: nbGrid
; Version:   1.2
; Monitors:  " . $numberOfMonitors . "
; Groups:    " . $counter . "
; By:        Nikola Bogdanovic
; 
; Based on xipergrid2.grid and an amazing idea and work put into it.
;-------------------------------------------------------------------------

[Groups]
NumberOfGroups = " . $counter . "\n\n";
	
	fwrite($outputFile, $header);
	
	foreach ($outputLineArray as $outputLine) {
		fwrite($outputFile, $outputLine);
	}
	
	fclose($inputFile);
	fclose($outputFile);