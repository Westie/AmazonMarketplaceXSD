Since Amazon is an absolute horror show when it comes to collating all XSDs into a bunch that actually works, I have gone to the effort of downloading all of them (most of them aren't actually listed on the website...) and corrected the XSDs that have duplicate types, etc.

This file also includes other schema, such as the ones for delivering encrypting content over XML. I'll let you figure out what that one is for. What I do usually is something along these lines:

	<?php
	
	if(file_exists("path/to/amzn-envelope.xsd"))
	{
		libxml_use_internal_errors(true);
		
		$document = new DOMDocument();
		$document->loadXML($your_amazon_envelope);
		
		if(!$document->schemaValidate("path/to/amzn-envelope.xsd"))
		{
			var_dump(libxml_get_errors());
			exit;
		}
	}
	
	?>

Obviously not as verbose as that, but hey, that gives you an idea. Also, there's a nice little header on all the XSD files:

	<!--
	$Date: 2005/04/01 $
	
	AMAZON.COM CONFIDENTIAL.  This document and the information contained in it are
	confidential and proprietary information of Amazon.com and may not be reproduced, 
	distributed or used, in whole or in part, for any purpose other than as necessary 
	to list products for sale on the www.amazon.com web site pursuant to an agreement 
	with Amazon.com.
	-->

I don't particularly care much about that myself, especially if you Google 'AMAZON.COM CONFIDENTIAL' and you get given loads
of documentation hosted on Amazon's own site.

Hope this is of help.