<?php
    function getPackage($myString, $docFile, $filePath){
    	// PACKAGE
		$p_name = "";
		$p_file_name = "";
		$p_download_location = "";
		$p_copyright_text = "";
		$p_version = "";
		$p_description = "";
		$p_summary = "";
		$p_originator = "";
		$p_supplier = "";
		$p_license_concluded = "";
		$p_license_declared = "";
		$p_checksum = "";
		$check_algorithm = "";
		$p_home_page = "";
		$p_source_info = "";
		$p_license_comments = "";
		$p_verification_code = "";
		$p_verification_code_excluded_file = "";
		$create = "";
		$updated = "";
		
		$docID;
		$packageID;
		$fileID;
		
		$rdf_regex = array(
			'file_name' => "<spdx:packageFileName>(?P<name>.*?)<\/spdx:packageFileName>",
			'copyright' => "<spdx:copyrightText>(?P<name>.*?)<\/spdx:copyrightText>",
			'version' => "<spdx:versionInfo>(?P<name>.*?)<\/spdx:versionInfo>",
			'desc' => "<spdx:description>(?P<name>.*?)<\/spdx:description>",
			'sum' => "<spdx:summary>(?P<name>.*?)<\/spdx:summary>",
			'origin' => "<spdx:originator>(?P<name>.*?)<\/spdx:originator>",
			'supp' => "<spdx:supplier>(?P<name>.*?)<\/spdx:supplier>",
			'conclude' => "<spdx:licenseConcluded rdf:resource=\"http:\/\/spdx.org\/licenses\/(?P<name>.*?)\"\/>",
			'declare' => "<spdx:licenseDeclared rdf:resource=\"http:\/\/spdx.org\/licenses\/(?P<name>.*?)\"\/>",
			'checksum' => "<spdx:checksum rdf:nodeID=\"(?P<name>.*?)\"\/>",
			'home' => "<doap:homepage>(?P<name>.*?)<\/doap:homepage>",
			'lic_comments' => "<spdx:licenseComments>(?P<name>.*?)<\/spdx:licenseComments>",
			'ver_code' => "<spdx:verificationCodeValue>(?P<name>.*?)<\/spdx:verificationCodeValue>",
			'ver_code_ex' => "<packageVerificationCodeExcludedFile>(?P<name>.*?)<\/packageVerificationCodeExcludedFile>",
			'created' => "<spdx:created>(?P<name>.*?)<\/spdx:created>",
		);
		
		$regex = array(
			'rdf' => $rdf_regex,
		);

		// PACKAGE PARSE
	  	$p_name = $docFile ?: NULL;
		if (preg_match('/' . $regex['rdf']['file_name'] . '/', $myString, $matches)) {
		  	$p_file_name = $matches[1] ?: NULL;
		}	
		$p_download_location = $filePath ?: NULL;
		if (preg_match('/' . $regex['rdf']['copyright'] . '/', $myString, $matches)) {
		  	$p_copyright_text = $matches[1] ?: NULL;
		}
		if (preg_match('/' . $regex['rdf']['version'] . '/', $myString, $matches)) {
		  	$p_version = $matches[1] ?: NULL;
		}
		if (preg_match('/' . $regex['rdf']['desc'] . '/', $myString, $matches)) {
		  	$p_description = $matches[1] ?: NULL;
		}
		if (preg_match('/' . $regex['rdf']['sum'] . '/', $myString, $matches)) {
		  	$p_summary = $matches[1] ?: NULL;
		}
		if (preg_match('/' . $regex['rdf']['origin'] . '/', $myString, $matches)) {
		  	$p_originator = $matches[1] ?: NULL;
		}	
		if (preg_match('/' . $regex['rdf']['supp'] . '/', $myString, $matches)) {
		  	$p_supplier = $matches[1] ?: NULL;
		}
		if (preg_match('/' . $regex['rdf']['conclude'] . '/', $myString, $matches)) {
		  	$p_license_concluded = $matches[1] ?: NULL;
		}
		if (preg_match('/' . $regex['rdf']['declare'] . '/', $myString, $matches)) {
		  	$p_license_declared = $matches[1] ?: NULL;
		}
		if (preg_match('/' . $regex['rdf']['checksum'] . '/', $myString, $matches)) {
		  	$p_checksum = $matches[1] ?: NULL;
		}
		$check_algorithm = NULL;
		if (preg_match('/' . $regex['rdf']['home'] . '/', $myString, $matches)) {
		  	$p_home_page = $matches[1] ?: NULL;
		}
		$p_source_info = NULL;
		if (preg_match('/' . $regex['rdf']['lic_comments'] . '/', $myString, $matches)) {
		  	$p_license_comments = $matches[1] ?: NULL;
		}
		if (preg_match('/' . $regex['rdf']['ver_code'] . '/', $myString, $matches)) {
		  	$p_verification_code = $matches[1] ?: NULL;
		}
		if (preg_match('/' . $regex['rdf']['ver_code_ex'] . '/', $myString, $matches)) {
		  	$p_verification_code_excluded_file = $matches[1] ?: NULL;
		}
		if (preg_match('/' . $regex['rdf']['created'] . '/', $myString, $matches)) {
		  	$create = $matches[1] ?: NULL;
		}
		$updated = NULL;
		
		$query 	= 	"INSERT INTO `packages` (`package_name`, `package_file_name`, `package_download_location`, `package_copyright_text`, 
	        		`package_version`, `package_description`, `package_summary`, `package_originator`, `package_supplier`,
					`package_license_concluded`, `package_license_declared`, `package_checksum`, `checksum_algorithm`,
					`package_home_page`, `package_source_info`, `package_license_comments`, `package_verification_code`,
					`package_verification_code_excluded_file`, `created_at`, `updated_at`) 
					VALUES ('$p_name', '$p_file_name', '$p_download_location', '$p_copyright_text', '$p_version', '$p_description',
					'$p_summary', '$p_originator', '$p_supplier', '$p_license_concluded', '$p_license_declared', '$p_checksum',
					'$check_algorithm', '$p_home_page', '$p_source_info', '$p_license_comments', '$p_verification_code',
					'$p_verification_code_excluded_file', '$create', '$updated')";
					
		return $query;
    }
    
?>
