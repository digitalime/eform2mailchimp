<?php
function eForm2mailchimp( &$fields )
	{
        /*---------------------------------------------------------------       
        eForm2mailchimp 
        Version: 0.1
        Author: digitalime
        ---------------------------------------------------------------
        Requirements:
            eForm 1.4+
			MailChimp API by drewm github.com/drewm/mailchimp-api/
        ---------------------------------------------------------------
      
        ---------------------------------------------------------------*/
 
      
	// Bring needed resources into scope
        global $modx;
		include('assets/snippets/mailchimp/MailChimp.php');
	$listid = $modx->db->escape($fields[listid]);

	$apikey = "APIKEY HERE"; //From https://admin.mailchimp.com/account/api/
	
		// Grab the values from the form
		$firstname = $modx->db->escape($fields[firstname]);
		$lastname = $modx->db->escape($fields[lastname]);
		$email = $modx->db->escape($fields[email]);
		$organisation = $modx->db->escape($fields[organisation]);
		$tel = $modx->db->escape($fields[tel]);
	
			//Let's call the Maichimp API and send the stuff
			
$MailChimp = new \Drewm\MailChimp($apikey);
$result = $MailChimp->call('lists/subscribe', array(
				'id'                => $listid, //SET THIS AS A HIDDEN FIELD IN YOUR FORM, 
                'email'             => array('email'=>$email),
                'merge_vars'        => array('FNAME'=>$firstname, 'LNAME'=>$lastname, 'ORGA'=>$organisation, 'TEL'=>$tel ),
                'double_optin'      => true,
                'update_existing'   => true,
                'replace_interests' => false,
                'send_welcome'      => false,
            ));
	//print_r($result);
	//echo "listid id ".$listid;
}

return false;
?>
