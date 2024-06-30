<?php

declare(strict_types=1);

namespace TestTask\Service;

use Exception;
use TestTask\Contracts\ContentRepositoryInterface;
use TestTask\Contracts\ContentServiceInterface;
use TestTask\Dto\InputDataDTO;
use TestTask\Repository\ContentRepository;
use TestTask\ValueObjects\FixedAmount;

/**
 * ContentService
 *
 * Main business logic
 */
readonly class ContentService implements ContentServiceInterface
{
    private ContentRepositoryInterface $contentRepository;

    public function __construct()
    {
        $this->contentRepository = new ContentRepository();
    }

    /**
     * ProcessContent - Business logic
     *
     * @param string $inputFile
     * @return array
     */
    public function processContent(string $inputFile): array
    {
        try {
            $result = [];

            foreach ($this->getData($inputFile) as $row) {
                if (!$row) {
                    break;
                }

                $inputDataObject = (new InputDataDTO)->fromArray($row);

                $rate = $this->getRate($inputDataObject->getCurrency());

                $binCurrency = $this->getBinCurrency($inputDataObject->getBin());

                if ($binCurrency) {
                    $fixedAmount = new FixedAmount(
                        $rate,
                        $binCurrency,
                        $inputDataObject->getCurrency(),
                        $inputDataObject->getAmount()
                    );

                    $result[] = $fixedAmount
                        ->fixedAmountBuilder()
                        ->calculateFixedAmountWithCurrencyCoefficient()
                        ->getFixedAmount();
                }
            }

            return $result;
        } catch (Exception $exception) {
            // @todo - In the future, it makes sense to add a logger to save errors or notify developers about errors
            throw $exception;
        }
    }

    /**
     * GetData
     *
     * @param string $inputFile
     * @return array
     */
    private function getData(string $inputFile): array
    {
        try {
            return $this->contentRepository->getInputData($inputFile);
        } catch (Exception $exception) {
            // @todo - In the future, it makes sense to add a logger to save errors or notify developers about errors
            throw $exception;
        }
    }

    /**
     * GetRate
     *
     * @param string $key
     * @return float
     */
    private function getRate(string $key): float
    {
        try {
            $ratesData = $this->contentRepository->getExchangeRate();

            return ($ratesData && key_exists('rates', $ratesData) && key_exists($key, $ratesData['rates']))
                ? $ratesData['rates'][$key]
                : 0;
        } catch (Exception $exception) {
            // @todo - In the future, it makes sense to add a logger to save errors or notify developers about errors
            throw $exception;
        }
    }

    /**
     * GetBinCurrency
     *
     * @param int $code
     * @return string|null
     */
    private function getBinCurrency(int $code): ?string
    {
        try {
            $binData = $this->contentRepository->getBinList($code);

            return ($binData
                && key_exists('country', $binData)
                && key_exists('alpha2', $binData['country'])
                && $binData['country']['alpha2']
            ) ? $binData['country']['alpha2'] : null;
        } catch (Exception $exception) {
            // @todo - In the future, it makes sense to add a logger to save errors or notify developers about errors
            throw $exception;
        }
    }
}