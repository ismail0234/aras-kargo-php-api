<?php 

namespace IS\Kargo\Aras;

Class ArasKargoFormats
{

	/**
	 *
	 * @description SOAP loginInfo Yapısı
	 *
	 */
	public $login;

	/**
	 *
	 * @description SOAP Kullanıcı Bilgileri
	 * @param string $username
	 * @param string $password
	 * @param string $customerCode
	 *
	 */
	public function __construct($username, $password, $customerCode)
	{

		$this->login = $this->loginInformation($username, $password, $customerCode);

	}

	/**
	 *
	 * @description SOAP Kullanıcı Bilgileri Şeması
	 * @param string $username
	 * @param string $password
	 * @param string $customerCode
	 * @return string
	 *
	 */
	protected function loginInformation($username, $password, $customerCode)
	{

		return sprintf('<LoginInfo>
			<UserName>%s</UserName>
			<Password>%s</Password>
			<CustomerCode>%s</CustomerCode>
		</LoginInfo>', $username, $password, $customerCode);

	}

	/**
	 *
	 * @description SOAP Sorgu Bilgileri
	 * @param int 
	 * @param array 
	 * @return string 
	 *
	 */
	protected function queryInfoFormat($queryType, $options)
	{

		$queryFormat = array();
		foreach ($options as $key => $value) {
			array_push($queryFormat, "<{$key}>{$value}</{$key}>");
		}

		return sprintf('<QueryInfo>
			<QueryType>%d</QueryType>
			%s
		</QueryInfo>', $queryType, implode('', $queryFormat));

	}

	/**
	 *
	 * @description SOAP queryInfo için kabul edilebilen özel sorgulamalar
	 * @param array $data 
	 * @return array 
	 *
	 */
	protected function requestOptionsFormat($data = array())
	{

		$returnArray = array();
		if (isset($data['TrackingNumber'])) {
			$returnArray['TrackingNumber'] = $data['TrackingNumber'];
		}

		if (isset($data['ReportType'])) {
			$returnArray['ReportType'] = $data['ReportType'] == 'fatura' ? 2 : 1;
		}

		if (isset($data['InvoiceSerialNumber'])) {
			$returnArray['InvoiceSerialNumber'] = $data['InvoiceSerialNumber'];
		}

		if (isset($data['CampaignCode'])) {
			$returnArray['CampaignCode'] = $data['CampaignCode'];
		}

		if (isset($data['Barcode'])) {
			$returnArray['Barcode'] = $data['Barcode'];
		}

		if (isset($data['DateType'])) {
			$returnArray['DateType'] = $data['DateType'];
		}

		if (isset($data['Date'])) {
			$returnArray['Date'] = $this->dateFormat($data['Date']);
		}

		if (isset($data['StartDate'])) {
			$returnArray['StartDate'] = $this->dateFormat($data['StartDate']);
		}

		if (isset($data['EndDate'])) {
			$returnArray['EndDate'] = $this->dateFormat($data['EndDate']);
		}

		return $returnArray;
	}

	protected function dateFormat($date, $hours = false)
	{

		$format = 'd-m-Y';
		if ($hours) {
			$format .= ' H:i:s';
		}

		if (is_int($date)) {
			return date($format, $date);
		}

		return $date;
	}

}