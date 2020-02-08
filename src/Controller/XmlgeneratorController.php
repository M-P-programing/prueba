<?php

namespace App\Controller;

use App\Entity\Xml;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use \DOMDocument;

class XmlgeneratorController extends AbstractController
{
	public $filename_xml = "../public/assets/temp/ping_request.xml";
	public $path_xsd = "../public/assets/xsds";

    /**
     * @Route("/xmlgenerator", name="xmlgenerator")
     */
    public function index()
    {
        return $this->render('xmlgenerator/index.html.twig', [
            'controller_name' => 'XmlgeneratorController',
        ]);
    }

    public function xml_to_array($filename_xml){

    	$xmlfile = file_get_contents($filename_xml);
    	$ob= simplexml_load_string($xmlfile);
		$json  = json_encode($ob);
		$configData = json_decode($json, true);

		return $configData;
	}


    public function load_and_validate_xml( $new_xml, $xsd )
	{

	    libxml_use_internal_errors(true);
	    $product_schema_errors=array();
	    
	    $xml_doc = new DOMDocument('1.0', 'utf-8');
	    $xml_doc->load($new_xml);
	    $valid_xml = $xml_doc->schemaValidate($xsd) ? $xml_doc : false;

	    foreach (libxml_get_errors() as $error) {
	        $product_schema_errors[]=$error; // handle errors
	    }
	    libxml_clear_errors();

	    // if valid xml, save it to array
	    if($valid_xml){
	        $valid_xml_array = $this->xml_to_array($new_xml);
	        echo '<br>'.basename($new_xml).'-> OK SCHEMA VALIDATION'.'<br>';
	    }else{
	    	echo '<br>'.basename($new_xml).'-> ERROR ON SCHEMA VALIDATION'.'<br>';
	    	//generatexml(nack, error-attribute, data, code_error)
	        //$msg=json_encode($product_schema_errors);
	        //fn_nl_digitecgalaxus_log('', basename($filename_xml), $msg, 'ERROR', 'SCHEMA VALIDATION', '');
	    }
	    //return !empty($valid_xml_array) ? $valid_xml_array : 'false';
	    var_dump($valid_xml);
	    return new Response(($valid_xml) ? true : false);
	}



    public function startProcess (Request $request)
    {

    	$json = array(
		  "sender" => "pepe",
		  "recipient" => "dfbhrgf",
		  "reference" => "gfdfg",
		  "message" => "hola"
		);

    	//$data = json_decode($request->getContent());
		$data_encode = json_encode($json);
    	$data = json_decode($data_encode);

    	//$timestamp = date("Y-m-d H:i:s");

    	if true $this->createPing( $data , 'ping_request' );

    }


    public function createPing( $data , $xsd )
    {
    	$xml = new Xml(); -> xsd ? 

  		$xml->test(
  			$data->type, 
  			$data->sender,
  			$data->recipient,
  			$data->reference,
  			//$timestamp,
  			$data->message
  		 );

  		var_dump($xml);

		//$new_xml

		resuqest done
		response done

		$validate = $this->load_and_validate_xml ($new_xml , $xsd);

		if($validate){
			echo "createPing($data, 'ping_response')"; -> return true;

			IF(RESPONSE TRUE) createReverse(reverse_REQUEST)

		}else{
			echo "createNack($data, error, 'nack')"; -> return false;
		}
    }

    public function createReverse( $data , $xsd )
    {


    	$xml = new Xml(); -> xsd ? 

  		$xml->test(
  			$data->type, 
  			$data->sender,
  			$data->recipient,
  			$data->reference,
  			//$timestamp,
  			$data->message
  		 );

  		var_dump($xml);

		//$new_xml
		$validate = $this->load_and_validate_xml ($new_xml , $xsd);

		if($validate){
			echo "createReverse($data, 'reverse_response')"; -> return true;
		}else{
			echo "createNack($data, error, 'nack')"; -> return false;
		}

    }


    public function createNack( $data , $xsd )
    {

    	$xml = new Xml(); -> xsd ? 

  		$xml->test(
  			$data->type, 
  			$data->sender,
  			$data->recipient,
  			$data->reference,
  			//$timestamp,
  			$data->message
  		 );

  		var_dump($xml);
		//$new_xml

		$validate = $this->load_and_validate_xml ($new_xml , $xsd);
		if($validate){
			return true;
		}else{
			return false;
		}

    }
}
