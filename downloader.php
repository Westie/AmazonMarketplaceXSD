<?php


function download($schema)
{
    foreach([ "https://images-na.ssl-images-amazon.com/images/G/01/rainier/help/xsd/release_4_1/", "https://images-na.ssl-images-amazon.com/images/G/01/rainier/help/xsd/release_1_9/" ] as $ns)
    {
        $source = @simplexml_load_file($ns.$schema);
        
        if($source)
        {
            $source->registerXPathNamespace("xsd", "http://www.w3.org/2001/XMLSchema");
            
            foreach($source->xpath("//xsd:include") as $include)
                download($include->attributes()->schemaLocation);
            
            file_put_contents($schema, $source->asXML());
            return true;
        }
    }
    
    return false;
}

download("amzn-envelope.xsd");
exit;