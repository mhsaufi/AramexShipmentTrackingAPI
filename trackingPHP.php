<?php	

	$soapClient = new SoapClient('shipments-tracking-api-wsdl.wsdl');
	// echo '<pre>';
	// shows the methods coming from the service 
	// print_r($soapClient->__getFunctions());
	
	/*
		parameters needed for the trackShipments method , client info, Transaction, and Shipments' Numbers.
		Note: Shipments array can be more than one shipment.
	*/

	// Aramex default testing credential
	$params = array(
		'ClientInfo'  			=> array(
									'AccountCountryCode'	=> 'JO',
									'AccountEntity'		 	=> 'AMM',
									'AccountNumber'		 	=> '20016',
									'AccountPin'		 	=> '543543',
									'UserName'			 	=> 'testingapi@aramex.com',
									'Password'			 	=> 'R123456789$r',
									'Version'			 	=> 'v1.0'
								),

		'Transaction' 			=> array(
									'Reference1'			=> '001' 
								),
		'Shipments'				=> array(
									'31101348471' // Replace with your Shipment number by looking in the Aramex dashboard
								)
	);

		'Transaction' 			=> array(
									'Reference1'			=> '001' 
								),
		'Shipments'				=> array(
									'31101348596'
								),
	);
	
	// calling the method and printing results
	try {

		$auth_call = $soapClient->TrackShipments($params);

		foreach($auth_call->TrackingResults as $result)
		{
				// var_dump($result->Value->TrackingResult);
				foreach($result->Value->TrackingResult as $val)
				{
						echo "WayBillNumber 	= ".$val->WaybillNumber."</br>";
						echo "UpdateCode		= ".$val->UpdateCode."</br>";
						echo "UpdateDescription = ".$val->UpdateDescription."</br>";
						echo "UpdateDateTime 	= ".$val->UpdateDateTime."</br>";
						echo "UpdateLocation 	= ".$val->UpdateLocation."</br>";
						echo "Comments 			= ".$val->Comments."</br></br></br>";
				}
		}

	} catch (SoapFault $fault) {
		
		// echo "TRY FAILED";

		die('Error : ' . $fault->faultstring);
	}
?>