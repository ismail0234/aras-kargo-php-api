<?php

namespace IS\Kargo\Aras;

Class ArasKargoRequest extends ArasKargoFormats
{

	/**
	 *
	 * @description Aras Kargo SOAP Servis Canlı Ortam URL
	 *
	 */
	protected $realUrl = 'https://customerservices.araskargo.com.tr/ArasCargoCustomerIntegrationService/ArasCargoIntegrationService.svc?wsdl';

	/**
	 *
	 * @description Aras Kargo SOAP Kullanıcısı
	 *
	 */
	protected $client;

	/**
	 *
	 * @description  Aras Kargo SOAP Kullanıcısı Ayarlama
	 * @param string $username
	 * @param string $password
	 * @param string $customerCode
	 *
	 */
	public function __construct($username, $password, $customerCode)
	{

		parent::__construct($username, $password, $customerCode);
		
		try {
			$this->client = new \SoapClient($this->realUrl, array("trace" => 1, "exception" => 0)); 
		} catch (Exception $e) {
			throw new Exception("SOAP Oturumu Başarısız");
		}

	}

	/**
	 *
	 * @description Aras Kargo Soap İstek Fonksiyonu
	 * @param string $queryFormat
	 * @param int $queryType
	 * @param array $queryInfo
	 * @return array 
	 *
	 */
	protected function sendRequest($queryFormat, $queryType, $queryInfo = array())
	{

		switch ($queryFormat)
		{

			case 'xml':
				
				$response = $this->client->GetQueryXML(array('loginInfo' => $this->login, 'queryInfo' => $this->queryInfoFormat($queryType, $queryInfo)));
				if (!isset($response->GetQueryXMLResult)) {
					return false;
				}

				$response = simplexml_load_string($response->GetQueryXMLResult);
				if ($response->GetQueryXMLResult == null) {
					return false;
				}

				return $response->GetQueryXMLResult;

			break;

			case 'json':
				
				$response = $this->client->GetQueryJSON(array('loginInfo' => $this->login, 'queryInfo' => $this->queryInfoFormat($queryType, $queryInfo)));
				if (!isset($response->GetQueryJSONResult)) {
					return false;
				}

				if ($response->GetQueryJSONResult == null) {
					return array();
				}

				$response = json_decode($response->GetQueryJSONResult);
				if ($response->QueryResult == null) {
					return array();
				}

				return $response->QueryResult;

			break;

			case 'ds':
				
				$response = $this->client->GetQueryDS(array('loginInfo' => $this->login, 'queryInfo' => $this->queryInfoFormat($queryType, $queryInfo)));
				if (!isset($response->GetQueryDSResult)) {
					return false;
				}

				if (empty($response->GetQueryDSResult->any)) {
					return array();
				}

				return simplexml_load_string($response->GetQueryDSResult->any);

			break;
		}

	}

}
