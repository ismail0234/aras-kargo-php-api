<?php

namespace IS\Kargo\Aras;

Class ArasKargo extends ArasKargoRequest
{

	/**
	 *
	 * @description Aras Kargo Initialize
	 * @param string $username
	 * @param string $password
	 * @param string $customerCode
	 *
	 */
	public function __construct($username, $password, $customerCode)
	{

		parent::__construct($username, $password, $customerCode);

	}

	/**
	 *
	 * @description Bir kargonun durumu hakkında bilgi verir.
	 * @return array 
	 *
	 */
	public function getCargoInformation($trackingNumber)
	{

		return $this->sendRequest('json', 1, $this->requestOptionsFormat(array('TrackingNumber' => $trackingNumber)));
	}

	/**
	 *
	 * @description Belirli bir tarihe göre gönderilen kargoların listesini verir.
	 * @return array 
	 *
	 */
	public function getCargoMovementDate($date)
	{

		return $this->sendRequest('json', 2, $this->requestOptionsFormat(array('Date' => $date)));
	}

	/**
	 *
	 * @description Teslim tarihine göre teslim edilen kargoların listesini verir
	 * @return array 
	 *
	 */
	public function getCargoDevileryDate($date)
	{

		return $this->sendRequest('json', 3, $this->requestOptionsFormat(array('Date' => $date)));
	}

	/**
	 *
	 * @description İrsaliye tarihine göre teslim edilen kargoların listesini verir
	 * @return array 
	 *
	 */
	public function getCargoWaybillDevileryDate($date)
	{

		return $this->sendRequest('json', 4, $this->requestOptionsFormat(array('Date' => $date)));
	}

	/**
	 *
	 * @description Henüz teslim edilmemiş, bir nedenle teslimat şubesinde bekleyen kargoların listesini verir 
	 * @return array 
	 *
	 */
	public function getCargoUnDevilered()
	{

		return $this->sendRequest('json', 5);
	}

	/**
	 *
	 * @description Belirli bir tarihe göre yönlendirilen kargoların listesini verir 
	 * @return array 
	 *
	 */
	public function getCargoRedirectDate($date)
	{

		return $this->sendRequest('json', 6, $this->requestOptionsFormat(array('Date' => $date)));
	}

	/**
	 *
	 * @description İrsaliye tarihine göre Gidiş dönüş hizmet verilen Geri Dönüşlü kargo 
	 * 				ürünü ile gönderilen kargoların listesini verir
	 * @return array 
	 *
	 */
	public function getCargoWaybillBackRedirectDate($date)
	{

		return $this->sendRequest('json', 7, $this->requestOptionsFormat(array('Date' => $date)));
	}

	/**
	 *
	 * @description Göndericiye iade edilen kargoların listesini verir
	 * @return array 
	 *
	 */
	public function getCargoSenderReturnDate($date)
	{

		return $this->sendRequest('json', 8, $this->requestOptionsFormat(array('Date' => $date)));
	}

	/**
	 *
	 * @description Kargo hareket bilgisini verir
	 * @return array 
	 *
	 */
	public function getCargoMovementInformation($trackingNumber)
	{

		return $this->sendRequest('json', 6, $this->requestOptionsFormat(array('TrackingNumber' => $trackingNumber)));
	}

	/**
	 *
	 * @description Aras Kargoya Ait tüm şube ve şube adres bilgilerini verir
	 * @return array 
	 *
	 */
	public function getAllBranchs()
	{

		return $this->sendRequest('json', 10);
	}	

	/**
	 *
	 * @description İki Tarih aralığına göre (İrsaliye Tarihi), kargoların listesini verir.
	 * @return array 
	 *
	 */
	public function getCargoWaybillBetweenDate($startDate, $endDate)
	{

		return $this->sendRequest('json', 12, $this->requestOptionsFormat(array('StartDate' => $startDate, 'EndDate' => $endDate)));
	}

	/**
	 *
	 * @description İki tarih aralığına göre (İrsaliya Tarihi), kargo listesini verir.
	 *				getCargoWaybillBetweenDate'den farklı olarak tahsilatlı kargo bilgilerini de içerir. 
	 * @return array 
	 *
	 */
	public function getCargoWaybillExtraBetweenDate($startDate, $endDate)
	{

		return $this->sendRequest('json', 13, $this->requestOptionsFormat(array('StartDate' => $startDate, 'EndDate' => $endDate)));
	}

	/**
	 *
	 * @description İki Tarih aralığına göre, kargoların devir bilgisini verir
	 * @return array 
	 *
	 */
	public function getCargoTransferBetweenDate($startDate, $endDate)
	{

		return $this->sendRequest('json', 16, $this->requestOptionsFormat(array('StartDate' => $startDate, 'EndDate' => $endDate)));
	}

	/**
	 *
	 * @description İki Tarih aralığına göre, kargoların listesini verir.
	 * @return array 
	 *
	 */
	public function getCargoBetweenDate($startDate, $endDate)
	{

		return $this->sendRequest('json', 18, $this->requestOptionsFormat(array('StartDate' => $startDate, 'EndDate' => $endDate)));
	}

	/**
	 *
	 * @description İki Tarih aralığına gore (İrsaliye Tarihi), kargoların bilgisini verir
	 * @return array 
	 *
	 */
	public function getCargoWaybillInformationBetweenDate($startDate, $endDate)
	{

		return $this->sendRequest('json', 19, $this->requestOptionsFormat(array('StartDate' => $startDate, 'EndDate' => $endDate)));
	}

	/**
	 *
	 * @description Kargo Durumuyla ilgili genel bilgi verir.
	 * 				Eğer kargo geri dönüşlü ise bu dataset dolu gelir ve geri dönüş teslimat bilgilerini içerir.
	 *  			Eğer kargo Geri Dönüşlü değilse bu dataset dolu gelir ve kargo teslimat bilgilerini içerir.
	 *				Kargonun devir bilgilerini içerir.
	 *				Kargo Yönlendirme ve İade Hareketleri ve Nedenlerini içerir
	 *				Geri Dönüşlü Kargo Bilgilerini içerir
	 * @return array 
	 *
	 */
	public function getCargoRealInformation($trackingNumber)
	{

		return $this->sendRequest('ds', 22, $this->requestOptionsFormat(array('TrackingNumber' => $trackingNumber)));
	}

	/**
	 *
	 * @description Fatura Bilgilerini Döner
	 * 				Normal Fatura ve E-Fatura araması yapılabilir.
	 *				Fatura No ve Fatura Tipi parametre olarak geçilir. 
	 *				Normal fatura için 'fatura', EFatura için 'efatura' parametresi geçilir.
	 * @return array 
	 *
	 */
	public function getCargoInvoice($invoiceNumber, $reportType)
	{

		return $this->sendRequest('json', 23, $this->requestOptionsFormat(array('ReportType' => $reportType, 'InvoiceSerialNumber' => $invoiceNumber)));
	}

	/**
	 *
	 * @description Barkod ile kargo bilgisi sorgulama
	 * 				Son 90 gün içinde kesilen irsaliyelerin arasında arar.
	 * @return array 
	 *
	 */
	public function getCargoFindBarcode($barcode)
	{

		return $this->sendRequest('json', 24, $this->requestOptionsFormat(array('Barcode' => $barcode)));
	}

}