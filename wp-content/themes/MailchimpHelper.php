<?php

class MailchimpHelper
{

    protected $email;
    protected $fname;
    protected $apikey;
    protected $server;
    protected $auth;
    protected $userid;

    function __construct($email, $fname = '')
    {

        $this->apikey     = MAILCHIMP_API_KEY;
        $this->server     = MAILCHIMP_SERVER;
        $this->auth       = base64_encode( 'user:'.$this->apikey );

        $this->email      = $email;
        $this->fname      = $fname;
        $this->userid     = md5($this->email);

    }

    private function getList($list_id)
    {
        return is_null($list_id) ? MAILCHIMP_LIST_ID : $list_id;
    }

    public function mc_subscribe($list_id = null)
    {

        $list_id = $this->getList($list_id);

        $data = [
    		'apikey'        => $this->apikey,
    		'email_address' => $this->email,
    		'status'        => 'subscribed',
    		'merge_fields'  => [
    			'FNAME' => $this->fname
    		]
    	];


    	$json_data = json_encode($data);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://'.$this->server.'.api.mailchimp.com/3.0/lists/'.$list_id.'/members/');
    	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Basic '.$this->auth));
    	curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    	curl_setopt($ch, CURLOPT_POST, true);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    	curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

        $result = curl_exec($ch);

    	return json_decode($result);
    }

    public function mc_changename($list_id = null)
    {

        $list_id = $this->getList($list_id);

        $data = [
    		'apikey'        => $this->apikey,
    		'email_address' => $this->email,
    		'merge_fields'  => [
    			'FNAME' => $this->fname
            ]
    	];

    	$json_data = json_encode($data);

    	$ch = curl_init();

    	curl_setopt($ch, CURLOPT_URL, 'https://'.$this->server.'.api.mailchimp.com/3.0/lists/'.$list_id.'/members/' . $this->userid);
    	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Basic '. $this->auth));
    	curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    	curl_setopt($ch, CURLOPT_POST, true);
    	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    	curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

        $result = curl_exec($ch);

    	return json_decode($result);
    }

    public function mc_addinterest($interest, $list_id = null)
    {

        $list_id = $this->getList($list_id);

    	$data = [
    		'apikey'        => $this->apikey,
    		'email_address' => $this->email,
    		'interests' => [
    			$interest => true
            ]
    	];

    	$json_data = json_encode($data);

    	$ch = curl_init();

    	curl_setopt($ch, CURLOPT_URL, 'https://'.$this->server.'.api.mailchimp.com/3.0/lists/'.$list_id.'/members/' . $this->userid);
    	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Basic '. $this->auth));
    	curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    	curl_setopt($ch, CURLOPT_POST, true);
    	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    	curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

    	$result = curl_exec($ch);

    	return json_decode($result);
    }

    public function mc_reminterest($interest, $list_id = null)
    {

        $list_id = $this->getList($list_id);

    	$data = [
    		'apikey'        => $this->apikey,
    		'email_address' => $this->email,
    		'interests' => [
    			$interest => false
    		]
    	];

    	$json_data = json_encode($data);

    	$ch = curl_init();

    	curl_setopt($ch, CURLOPT_URL, 'https://'.$this->server.'.api.mailchimp.com/3.0/lists/'.$list_id.'/members/' . $this->userid);
    	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Basic '. $this->auth));
    	curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    	curl_setopt($ch, CURLOPT_POST, true);
    	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    	curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

        $result = curl_exec($ch);

    	return json_decode($result);
    }

    public function mc_checklist($list_id = null)
    {

        $list_id = $this->getList($list_id);

    	$data = [
    		'apikey'        => $this->apikey,
    		'email_address' => $this->email
    	];

    	$json_data = json_encode($data);

    	$ch = curl_init();

    	curl_setopt($ch, CURLOPT_URL, 'https://'.$this->server.'.api.mailchimp.com/3.0/lists/'.$list_id.'/members/' . $this->userid);
    	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
    		'Authorization: Basic '. $this->auth));
    	curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    	curl_setopt($ch, CURLOPT_POST, true);
    	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    	curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

    	$result = curl_exec($ch);

    	$json = json_decode($result);
    	return $json->{'status'};
    	// return $result;
    }
}
