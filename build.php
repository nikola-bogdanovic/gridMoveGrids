<?php
	
	$numberOfMonitors = 2;                          // EDIT THIS ACCORDING TO YOUR NUMBER OF MONITORS
	
	$inputFile = fopen("inputFile.txt", "r");       // BEST LEAVE AS IS
	$outputFile = fopen("inDevelopment.grid", "w"); // BEST LEAVE AS IS
	
	$fileLineArray = [];
	$outputLineArray = [];
	$counter = 1;
	
	while ($line = fgets($inputFile)) {
		if (trim($line) != "") {
			$fileLineArray[] = $line;
		}
	}
	
	$fileLineArray[] = "\n\n";
	
	for ($i = 1; $i <= $numberOfMonitors; $i++) {
		foreach ($fileLineArray as $outputLine) {
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
; Version:   NEWVERSION
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
	
	echo "Finished building inDevelopment.grid";