<?php

namespace Tests\Feature;

use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use TestTask\Repository\ContentRepository;
use TestTask\Service\ContentService;

final class LogicTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function test_logic(): void
    {
        $this->mockInputResult();
        $this->mockBinListResult();
        $this->mockExchangeRateResult();

        $inputFile = 'input.txt';

        $outputResult = [
            1,
            0.47,
            1.16,
            23.61,
        ];

        $contentService = $this->createMock(ContentService::class);

        $contentService->expects($this->once())
            ->method('processContent')
            ->with($inputFile)
            ->willReturn($outputResult);

        $contentService->processContent($inputFile);
    }

    /**
     * @throws Exception
     */
    private function mockInputResult(): void
    {
        $inputFile = 'input.txt';

        $outputResult = [
            1,
            0.47,
            1.16,
            23.61,
        ];

        $contentRepository = $this->createMock(ContentRepository::class);

        $contentRepository->expects($this->once())
            ->method('getInputData')
            ->with($inputFile)
            ->willReturn($outputResult);

        $contentRepository->getInputData($inputFile);
    }

    /**
     * @throws Exception
     */
    private function mockBinListResult(): void
    {
        $value = 45717360;

        $outputResult = json_decode('
            {
                "number": [],
                "scheme": "visa",
                "type": "debit",
                "brand": "Visa Classic",
                "country": {
                    "numeric": "208",
                    "alpha2": "DK",
                    "name": "Denmark",
                    "emoji": "\ud83c\udde9\ud83c\uddf0",
                    "currency": "DKK",
                    "latitude": 56,
                    "longitude": 10
                },
                "bank": {
                    "name": "Jyske Bank A\/S"
                }
            }
        ', true);

        $contentRepository = $this->createMock(ContentRepository::class);

        $contentRepository->expects($this->once())
            ->method('getBinList')
            ->with($value)
            ->willReturn($outputResult);

        $contentRepository->getBinList($value);
    }

    /**
     * @throws Exception
     */
    private function mockExchangeRateResult(): void
    {
        $outputResult = json_decode('
            {
                "success": true,
                "timestamp": 1719768124,
                "base": "EUR",
                "date": "2024-06-30",
                "rates": {
                    "AED": 3.937362,
                    "AFN": 76.102349,
                    "ALL": 100.353098,
                    "AMD": 415.712833,
                    "ANG": 1.93016,
                    "AOA": 915.075886,
                    "ARS": 975.66562,
                    "AUD": 1.601648,
                    "AWG": 1.93225,
                    "AZN": 1.894175,
                    "BAM": 1.95586,
                    "BBD": 2.162467,
                    "BDT": 125.843885,
                    "BGN": 1.957499,
                    "BHD": 0.403712,
                    "BIF": 3080.995113,
                    "BMD": 1.071983,
                    "BND": 1.451445,
                    "BOB": 7.400228,
                    "BRL": 5.996005,
                    "BSD": 1.070933,
                    "BTC": 1.7351982e-5,
                    "BTN": 89.237755,
                    "BWP": 14.551449,
                    "BYN": 3.504908,
                    "BYR": 21010.868625,
                    "BZD": 2.158767,
                    "CAD": 1.46792,
                    "CDF": 3065.87155,
                    "CHF": 0.967983,
                    "CLF": 0.037106,
                    "CLP": 1023.861608,
                    "CNY": 7.790421,
                    "CNH": 7.825353,
                    "COP": 4479.338281,
                    "CRC": 560.617307,
                    "CUC": 1.071983,
                    "CUP": 28.407552,
                    "CVE": 110.268404,
                    "CZK": 25.049561,
                    "DJF": 190.685887,
                    "DKK": 7.463039,
                    "DOP": 63.261953,
                    "DZD": 144.260453,
                    "EGP": 51.430588,
                    "ERN": 16.079746,
                    "ETB": 61.829509,
                    "EUR": 1,
                    "FJD": 2.39931,
                    "FKP": 0.84108,
                    "GBP": 0.84725,
                    "GEL": 3.006146,
                    "GGP": 0.84108,
                    "GHS": 16.332504,
                    "GIP": 0.84108,
                    "GMD": 72.653651,
                    "GNF": 9218.284577,
                    "GTQ": 8.322257,
                    "GYD": 224.066917,
                    "HKD": 8.37117,
                    "HNL": 26.511818,
                    "HRK": 7.523647,
                    "HTG": 141.954382,
                    "HUF": 395.325866,
                    "IDR": 17527.405964,
                    "ILS": 4.037035,
                    "IMP": 0.84108,
                    "INR": 89.365174,
                    "IQD": 1402.94331,
                    "IRR": 45130.488389,
                    "ISK": 148.76993,
                    "JEP": 0.84108,
                    "JMD": 167.255163,
                    "JOD": 0.759712,
                    "JPY": 172.465979,
                    "KES": 138.694282,
                    "KGS": 92.66801,
                    "KHR": 4402.135898,
                    "KMF": 492.951269,
                    "KPW": 964.784924,
                    "KRW": 1480.709006,
                    "KWD": 0.328841,
                    "KYD": 0.892528,
                    "KZT": 505.98562,
                    "LAK": 23634.729626,
                    "LBP": 95906.560723,
                    "LKR": 327.730117,
                    "LRD": 208.196427,
                    "LSL": 19.479001,
                    "LTL": 3.165288,
                    "LVL": 0.648432,
                    "LYD": 5.221161,
                    "MAD": 10.656729,
                    "MDL": 19.213593,
                    "MGA": 4797.148092,
                    "MKD": 61.5319,
                    "MMK": 3481.759271,
                    "MNT": 3698.341776,
                    "MOP": 8.614766,
                    "MRU": 42.43231,
                    "MUR": 50.599881,
                    "MVR": 16.513885,
                    "MWK": 1856.957326,
                    "MXN": 19.658666,
                    "MYR": 5.057083,
                    "MZN": 68.280006,
                    "NAD": 19.479001,
                    "NGN": 1645.944402,
                    "NIO": 39.421217,
                    "NOK": 11.411625,
                    "NPR": 142.780408,
                    "NZD": 1.759802,
                    "OMR": 0.412223,
                    "PAB": 1.071033,
                    "PEN": 4.106827,
                    "PGK": 4.121127,
                    "PHP": 62.614246,
                    "PKR": 298.054601,
                    "PLN": 4.313565,
                    "PYG": 8076.249321,
                    "QAR": 3.906221,
                    "RON": 4.978323,
                    "RSD": 117.039213,
                    "RUB": 91.822735,
                    "RWF": 1399.143193,
                    "SAR": 4.021794,
                    "SBD": 9.046915,
                    "SCR": 14.865196,
                    "SDG": 644.262198,
                    "SEK": 11.375245,
                    "SGD": 1.454139,
                    "SHP": 1.354397,
                    "SLE": 24.491922,
                    "SLL": 22478.951526,
                    "SOS": 612.018894,
                    "SRD": 33.058351,
                    "STD": 22187.885702,
                    "SVC": 9.371289,
                    "SYP": 2693.390138,
                    "SZL": 19.472601,
                    "THB": 39.385714,
                    "TJS": 11.432753,
                    "TMT": 3.762661,
                    "TND": 3.358104,
                    "TOP": 2.533849,
                    "TRY": 35.110652,
                    "TTD": 7.269224,
                    "TWD": 34.860356,
                    "TZS": 2878.888874,
                    "UAH": 43.324637,
                    "UGX": 3973.122654,
                    "USD": 1.071983,
                    "UYU": 42.381308,
                    "UZS": 13446.415103,
                    "VEF": 3883315.070751,
                    "VES": 39.02286,
                    "VND": 27287.329635,
                    "VUV": 127.26795,
                    "WST": 3.002212,
                    "XAF": 655.977251,
                    "XAG": 0.036789,
                    "XAU": 0.000461,
                    "XCD": 2.897088,
                    "XDR": 0.813325,
                    "XOF": 655.977251,
                    "XPF": 119.331742,
                    "YER": 268.424959,
                    "ZAR": 19.509626,
                    "ZMK": 9649.126602,
                    "ZMW": 25.730794,
                    "ZWL": 345.178119
                }
            }
        ', true);

        $contentRepository = $this->createMock(ContentRepository::class);

        $contentRepository->expects($this->once())
            ->method('getExchangeRate')
            ->willReturn($outputResult);

        $contentRepository->getExchangeRate();
    }
}