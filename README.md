# Aras Kargo PHP Api

Bu api aras kargo müşterileri için websitelerinden kargo durumlarını görüntüleyebilmek ve raporlayabilmeleri için yazılmıştır.

## Kurulum

Kurulum için composer kullanmanız gerekmektedir. Composer'a sahip değilseniz windows için [Buradan](https://getcomposer.org/) indirebilirsiniz.

```php

composer require ismail0234/aras-kargo-php-api

```

## Kullanım

```php

include "vendor/autoload.php";

use IS\Kargo\Aras\ArasKargo;

$aras = new ArasKargo('XML Servisi Kullanıcı Adı', 'XML Servisi Şifreniz', 'Müşteri Kodunuz');

```

### Fonksiyonlar

```php

/**
 *
 * @description Bir kargonun durumu hakkında bilgi verir.
 * @param string Kargo Numarası
 *
 */
$aras->getCargoInformation(9093765601744);

/**
 *
 * @description Belirli bir tarihe göre gönderilen kargoların listesini verir.
 * @note string olarak (d-m-Y) veya int olarak unix timestamp kullanılabilir.
 * @param string veya int
 *
 */
$aras->getCargoMovementDate(date('d-m-Y'));

/**
 *
 * @description Teslim tarihine göre teslim edilen kargoların listesini verir.
 * @note string olarak (d-m-Y) veya int olarak unix timestamp kullanılabilir.
 * @param string veya int
 *
 */
$aras->getCargoDevileryDate(date('d-m-Y'));

/**
 *
 * @description İrsaliye tarihine göre teslim edilen kargoların listesini verir.
 * @note string olarak (d-m-Y) veya int olarak unix timestamp kullanılabilir.
 * @param string veya int
 *
 */
$aras->getCargoWaybillDevileryDate(date('d-m-Y'));

/**
 *
 * @description Henüz teslim edilmemiş, bir nedenle teslimat şubesinde bekleyen kargoların listesini verir.
 *
 */
$aras->getCargoUnDevilered();

/**
 *
 * @description Belirli bir tarihe göre yönlendirilen kargoların listesini verir.
 * @note string olarak (d-m-Y) veya int olarak unix timestamp kullanılabilir.
 * @param string veya int
 *
 */
$aras->getCargoRedirectDate(date('d-m-Y'));

/**
 *
 * @description İrsaliye tarihine göre Gidiş dönüş hizmet verilen Geri Dönüşlü kargo 
 * 				ürünü ile gönderilen kargoların listesini verir
 * @note string olarak (d-m-Y) veya int olarak unix timestamp kullanılabilir.
 * @param string veya int
 *
 */
$aras->getCargoWaybillBackRedirectDate(date('d-m-Y'));

/**
 *
 * @description Göndericiye iade edilen kargoların listesini verir
 * @note string olarak (d-m-Y) veya int olarak unix timestamp kullanılabilir.
 * @param string veya int
 *
 */
$aras->getCargoSenderReturnDate(date('d-m-Y'));

/**
 *
 * @description Kargo hareket bilgisini verir
 * @param int Kargo Numarası
 *
 */
$aras->getCargoMovementInformation(9093765601744);

/**
 *
 * @description Aras Kargoya Ait tüm şube ve şube adres bilgilerini verir.
 *
 */
$aras->getAllBranchs();

/**
 *
 * @description İki Tarih aralığına göre (İrsaliye Tarihi), kargoların listesini verir.
 * @note string olarak (d-m-Y) veya int olarak unix timestamp kullanılabilir.
 * @param string veya int 
 * @param string veya int
 *
 */
$aras->getCargoWaybillBetweenDate(date('d-m-Y', time() - 86400 * 30) , date('d-m-Y'));

/**
 *
 * @description İki tarih aralığına göre (İrsaliya Tarihi), kargo listesini verir.
 *				getCargoWaybillBetweenDate'den farklı olarak tahsilatlı kargo bilgilerini de içerir. 
 * @note string olarak (d-m-Y) veya int olarak unix timestamp kullanılabilir.
 * @param string veya int 
 * @param string veya int
 *
 */
$aras->getCargoWaybillExtraBetweenDate(date('d-m-Y', time() - 86400 * 30) , date('d-m-Y'));

/**
 *
 * @description İki Tarih aralığına göre, kargoların devir bilgisini verir.
 * @note string olarak (d-m-Y) veya int olarak unix timestamp kullanılabilir.
 * @param string veya int 
 * @param string veya int
 *
 */
$aras->getCargoTransferBetweenDate(date('d-m-Y', time() - 86400 * 30) , date('d-m-Y'));

/**
 *
 * @description İki Tarih aralığına göre, kargoların listesini verir.
 * @note string olarak (d-m-Y) veya int olarak unix timestamp kullanılabilir.
 * @param string veya int 
 * @param string veya int
 *
 */
$aras->getCargoBetweenDate(date('d-m-Y', time() - 86400 * 30) , date('d-m-Y'));

/**
 *
 * @description İki Tarih aralığına gore (İrsaliye Tarihi), kargoların bilgisini verir.
 * @note string olarak (d-m-Y) veya int olarak unix timestamp kullanılabilir.
 * @param string veya int 
 * @param string veya int
 *
 */
$aras->getCargoWaybillInformationBetweenDate(date('d-m-Y', time() - 86400 * 30) , date('d-m-Y'));

/**
 *
 * @description Kargo Durumuyla ilgili genel bilgi verir.
 * 				Eğer kargo geri dönüşlü ise bu dataset dolu gelir ve geri dönüş teslimat bilgilerini içerir.
 *  			Eğer kargo Geri Dönüşlü değilse bu dataset dolu gelir ve kargo teslimat bilgilerini içerir.
 *				Kargonun devir bilgilerini içerir.
 *				Kargo Yönlendirme ve İade Hareketleri ve Nedenlerini içerir
 *				Geri Dönüşlü Kargo Bilgilerini içerir
 * @param int Kargo Numarası
 * @return array 
 *
 */
$aras->getCargoRealInformation(9093773579276);

/**
 *
 * @description Fatura Bilgilerini Döner
 *				Normal Fatura ve E-Fatura araması yapılabilir.
 *				Fatura No ve Fatura Tipi parametre olarak geçilir. 
 *				Normal fatura için 'fatura', EFatura için 'efatura' parametresi geçilir.
 * @param string Fatura Numarası
 * @param string Fatura Türü (efatura/fatura)
 * @return array 
 *
 */
$aras->getCargoInvoice("AAA201400040405", 'fatura');
```
