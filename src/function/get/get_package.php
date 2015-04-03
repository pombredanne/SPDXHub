<?php
    function getPackage($myFile, $docFile, $filePath, $docID){
    	// PACKAGE
    	
    	$myString = "";
    	if (preg_match('/' . "(?P<name><spdx:Package.*<\/spdx:Package>)" . '/s', $myFile, $matches)) {
			$myString = $matches[1] ?: NULL;
		}		
		
    	$packageArray = array(
			$name = $docFile ?: NULL,
			$pspdx_id = "",
			$version = "",
			$filename = "",
			$supplier = "",
			$originator = "",
			$download_location = "",
			$checksum = "",
			$verificationcode = "",
			$home_page = "",
			$source_Information = "",
			$source_info = "",
			$license_declared = "",
			$license_concluded = "",
			$license_info_from_files = "",
			$license_comment = "",
			$package_copyright_text = "",
			$summary = "",
			$description = "",
			$summary_description = "",
			$package_detailed_description = "",
			$package_comment = "",
			$spdx_fk = $docID,
		);
		
		$rdf_regex = array(
			$name = "<spdx:name>(?P<name>.*?)<\/spdx:name>",
			$pspdx_id = "<Package.*?ID=\"(?P<name>.*?)\".*>",
			$version = "<spdx:versionInfo>(?P<name>.*?)<\/spdx:versionInfo>",
			$filename = "<spdx:packageFileName>(?P<name>.*?)<\/spdx:packageFileName>",
			$supplier = "<spdx:supplier>(?P<name>.*?)<\/spdx:supplier>",
			$originator = "<spdx:originator>(?P<name>.*?)<\/spdx:originator>",
			$download_location = "<spdx:downloadLocation>(?P<name>.*?)<\/spdx:downloadLocation>",
			$checksum = "<spdx:checksum rdf:nodeID=\"(?P<name>.*?)\"\/>",
			$verificationcode = "<spdx:verificationCodeValue>(?P<name>.*?)<\/spdx:verificationCodeValue>",
			$home_page = "<doap:homepage>(?P<name>.*?)<\/doap:homepage>",
			$source_Information = "<spdx:sourceInfo>(?P<name>.*?)<\/spdx:sourceInfo>",
			$source_info = "<spdx:sourceInfo>(?P<name>.*?)<\/spdx:sourceInfo>",
			$license_declared ="<spdx:licenseDeclared rdf:resource=\".*\/(?P<name>.*?)\"\/>",
			$license_concluded = "<spdx:licenseConcluded rdf:resource=\".*\/(?P<name>.*?)\"\/>",
			$license_info_from_files = NULL,
			$license_comment = "<spdx:licenseComments>(?P<name>.*?)<\/spdx:licenseComments>",
			$package_copyright_text = "<spdx:copyrightText>(?P<name>.*?)<\/spdx:copyrightText>",
			$summary = "<spdx:summary>(?P<name>.*?)<\/spdx:summary>",
			$description = "<spdx:description>(?P<name>.*?)<\/spdx:description>",
			$summary_description = "<spdx:summary>(?P<name>.*?)<\/spdx:summary>",
			$package_detailed_description = "<spdx:description>(?P<name>.*?)<\/spdx:description>",
			$package_comment = NULL,
			$spdx_fk = NULL,
		);
		
		$regex = array(
			'rdf' => $rdf_regex,
		);

    	for($x = 0; $x < sizeof($regex['rdf']); $x++){ 
    		if ($regex['rdf'][$x] == NULL){
    			continue;
    		}
    		if (preg_match('/' . $regex['rdf'][$x] . '/', $myString, $matches)) {
		  		$packageArray[$x] = $matches[1] ?: NULL;
			}
		}
		
		$query 	= 	"INSERT INTO `spdx_package_info` (`name`, `pspdx_id`, `version`, `filename`, 
	        		`supplier`, `originator`, `download_location`, `checksum`, `verificationcode`,
					`home_page`, `source_Information`, `source_info`, `license_declared`,
					`license_concluded`, `license_info_from_files`, `license_comment`, `package_copyright_text`,
					`summary`, `description`, `summary_description`, `package_detailed_description`,
					`package_comment`, `spdx_fk`) 
					VALUES ('$packageArray[0]', '$packageArray[1]', '$packageArray[2]', '$packageArray[3]', '$packageArray[4]', '$packageArray[5]',
					'$packageArray[6]', '$packageArray[7]', '$packageArray[8]', '$packageArray[9]', '$packageArray[10]', '$packageArray[11]',
					'$packageArray[12]', '$packageArray[13]', '$packageArray[14]', '$packageArray[15]', '$packageArray[16]',
					'$packageArray[17]', '$packageArray[18]', '$packageArray[19]', '$packageArray[20]', '$packageArray[21]', '$packageArray[22]')";
					
		return $query;
    }
    
?>
