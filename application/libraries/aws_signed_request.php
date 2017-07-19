<?php
define('DEBUG', TRUE);
//DEFINE(DEBUG, FALSE);
//hash_hmac code from comment by Ulrich in http://mierendo.com/software/aws_signed_query/
//sha256.inc.php from http://www.nanolink.ca/pub/sha256/ 
include("sha256.inc.php");
class aws_signed_request
{
    function fhash_hmac($algo, $data, $key, $raw_output=False)
	{
	  // RFC 2104 HMAC implementation for php.
	  // Creates a sha256 HMAC.
	  // Eliminates the need to install mhash to compute a HMAC
	  // Hacked by Lance Rushing
	  // source: http://www.php.net/manual/en/function.mhash.php
	  // modified by Ulrich Mierendorff to work with sha256 and raw output
	  $b = 64; // block size of md5, sha256 and other hash functions
	  if (strlen($key) > $b)
	  {
		$key = pack("H*",$algo($key));
	  }
	  $key = str_pad($key, $b, chr(0x00));
	  $ipad = str_pad('', $b, chr(0x36));
	  $opad = str_pad('', $b, chr(0x5c));
	  $k_ipad = $key ^ $ipad ;
	  $k_opad = $key ^ $opad;
	  $hmac = $algo($k_opad . pack("H*", $algo($k_ipad . $data)));
	  if ($raw_output)
	  {
		return pack("H*", $hmac);
	  }
	  else
	  {
		return $hmac;
	  }
	} 
	//GetXMLTree and GetChildren code from http://whoooop.co.uk/2005/03/20/xml-to-array/
	function GetXMLTree ($xmldata)
	{
		// we want to know if an error occurs
		ini_set ('track_errors', '1');
	
		$xmlreaderror = false;
	
		$parser = xml_parser_create ('ISO-8859-1');
		xml_parser_set_option ($parser, XML_OPTION_SKIP_WHITE, 1);
		xml_parser_set_option ($parser, XML_OPTION_CASE_FOLDING, 0);
		if (!xml_parse_into_struct ($parser, $xmldata, $vals, $index)) {
			$xmlreaderror = true;
			echo "error1";
		}
		xml_parser_free ($parser);
	
		if (!$xmlreaderror) {
			$result = array ();
			$i = 0;
			if (isset ($vals [$i]['attributes']))
				foreach (array_keys ($vals [$i]['attributes']) as $attkey)
				$attributes [$attkey] = $vals [$i]['attributes'][$attkey];
	
			$result [$vals [$i]['tag']] = array_merge ($attributes, $this->GetChildren ($vals, $i, 'open'));
		}
	
		ini_set ('track_errors', '0');
		return $result;
	}
	function GetChildren ($vals, &$i, $type)
	{
		if ($type == 'complete') {
			if (isset ($vals [$i]['value']))
				return ($vals [$i]['value']);
			else
				return '';
		}
	
		$children = array (); // Contains node data
	
		/* Loop through children */
		while ($vals [++$i]['type'] != 'close') {
			$type = $vals [$i]['type'];
			// first check if we already have one and need to create an array
			if (isset ($children [$vals [$i]['tag']])) {
				if (is_array ($children [$vals [$i]['tag']])) {
					$temp = array_keys ($children [$vals [$i]['tag']]);
					// there is one of these things already and it is itself an array
					if (is_string ($temp [0])) {
						$a = $children [$vals [$i]['tag']];
						unset ($children [$vals [$i]['tag']]);
						$children [$vals [$i]['tag']][0] = $a;
					}
				} else {
					$a = $children [$vals [$i]['tag']];
					unset ($children [$vals [$i]['tag']]);
					$children [$vals [$i]['tag']][0] = $a;
				}
	
				$children [$vals [$i]['tag']][] = $this->GetChildren ($vals, $i, $type);
			} else
				$children [$vals [$i]['tag']] = $this->GetChildren ($vals, $i, $type);
			// I don't think I need attributes but this is how I would do them:
			if (isset ($vals [$i]['attributes'])) {
				$attributes = array ();
				foreach (array_keys ($vals [$i]['attributes']) as $attkey)
				$attributes [$attkey] = $vals [$i]['attributes'][$attkey];
				// now check: do we already have an array or a value?
				if (isset ($children [$vals [$i]['tag']])) {
					// case where there is an attribute but no value, a complete with an attribute in other words
					if ($children [$vals [$i]['tag']] == '') {
						unset ($children [$vals [$i]['tag']]);
						$children [$vals [$i]['tag']] = $attributes;
					}
					// case where there is an array of identical items with attributes
					elseif (is_array ($children [$vals [$i]['tag']])) {
						$index = count ($children [$vals [$i]['tag']]) - 1;
						// probably also have to check here whether the individual item is also an array or not or what... all a bit messy
						if ($children [$vals [$i]['tag']][$index] == '') {
							unset ($children [$vals [$i]['tag']][$index]);
							$children [$vals [$i]['tag']][$index] = $attributes;
						}
						$children [$vals [$i]['tag']][$index] = array_merge ($children [$vals [$i]['tag']][$index], $attributes);
					} else {
						$value = $children [$vals [$i]['tag']];
						unset ($children [$vals [$i]['tag']]);
						$children [$vals [$i]['tag']]['value'] = $value;
						$children [$vals [$i]['tag']] = array_merge ($children [$vals [$i]['tag']], $attributes);
					}
				} else
					$children [$vals [$i]['tag']] = $attributes;
			}
		}
	
		return $children;
	}
	//FormatASINResult by DJ Doena (me)
	function FormatASINResult($Result)
	{
		$Item = $Result['ItemLookupResponse']['Items']['Item'];
		$Price = $Item['Offers']['Offer']['OfferListing']['Price'];    
		$RetVal = array('ASIN' => $Item['ASIN'],
								'ProductGroup' => $Item['ItemAttributes']['ProductGroup'],
								'Title' => $Item['ItemAttributes']['Title'],
								'URL' => $Item['DetailPageURL'],
								'TotalOffers' => $Item['Offers']['TotalOffers'],
								'Amount' => $Price['Amount'] / 100.0,
								'Currency' => $Price['CurrencyCode'],
								'FormattedPrice' => $Price['FormattedPrice'],
								'Errors' => $Result['ItemLookupResponse']['Items']['Request']['Errors']
								);
		
		if(DEBUG)
		{
		 // echo('<br/><br/>');      
		  //print_r($RetVal);
		  //echo('<br/><br/>');
		}
		return $RetVal;  
	  } 
	
	
	//aws_signed_request code from http://mierendo.com/software/aws_signed_query/
	
	function aws_signed_request1($region, $params, $public_key, $private_key)
	{
		
		/*
		Copyright (c) 2009 Ulrich Mierendorff
	
		Permission is hereby granted, free of charge, to any person obtaining a
		copy of this software and associated documentation files (the "Software"),
		to deal in the Software without restriction, including without limitation
		the rights to use, copy, modify, merge, publish, distribute, sublicense,
		and/or sell copies of the Software, and to permit persons to whom the
		Software is furnished to do so, subject to the following conditions:
	
		The above copyright notice and this permission notice shall be included in
		all copies or substantial portions of the Software.
	
		THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
		IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
		FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
		THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
		LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
		FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
		DEALINGS IN THE SOFTWARE.
		*/
		
		/*
		Parameters:
			$region - the Amazon(r) region (ca,com,co.uk,de,fr,jp)
			$params - an array of parameters, eg. array("Operation"=>"ItemLookup",
							"ItemId"=>"B000X9FLKM", "ResponseGroup"=>"Small")
			$public_key - your "Access Key ID"
			$private_key - your "Secret Access Key"
		*/
	
		// some paramters
		$method = "GET";
		$host = "ecs.amazonaws.".$region;
		$uri = "/onca/xml";
		
		// additional parameters
		$params["Service"] = "AWSECommerceService";
		$params["AWSAccessKeyId"] = $public_key;
		// GMT timestamp
		$params["Timestamp"] = gmdate("Y-m-d\TH:i:s\Z");
		// API version
		$params["Version"] = "2009-03-31";
		
		// sort the parameters
		ksort($params);
		
		// create the canonicalized query
		$canonicalized_query = array();
		foreach ($params as $param=>$value)
		{
			$param = str_replace("%7E", "~", rawurlencode($param));
			$value = str_replace("%7E", "~", rawurlencode($value));
			$canonicalized_query[] = $param."=".$value;
		}
		$canonicalized_query = implode("&", $canonicalized_query);
		// create the string to sign
		$string_to_sign = $method."\n".$host."\n".$uri."\n".$canonicalized_query;
		// calculate HMAC with SHA256 and base64-encoding
		$signature = base64_encode($this->fhash_hmac("sha256", $string_to_sign, $private_key, True));
		// encode the signature for the request
		$signature = str_replace("%7E", "~", rawurlencode($signature));
		// create request
	    $request = "https://".$host.$uri."?".$canonicalized_query."&Signature=".$signature;
		if('DEBUG')
		{
		  //echo('<br/><br/>');
		//  echo($request);
		  //echo('<br/><br/>');
		}    
		// do request
		$response = @file_get_contents($request);
		if('DEBUG')
		{
		  //echo('<br/><br/>');
		  //print_r($response);
		  //echo('<br/><br/>');
		}
	    if ($response === False)
		{
		  return False;
		}
		else
		{
			 $pxml = $this->GetXMLTree($response);
			 if(DEBUG)
			 {
			  // echo('<br/><br/>');
			 //  print_r($pxml);
			   //echo('<br/><br/>');
			 }
			 return $pxml;
		}
		
	}
}

?>
