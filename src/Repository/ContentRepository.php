<?php

declare(strict_types=1);

namespace TestTask\Repository;

use TestTask\Contracts\ContentRepositoryInterface;
use TestTask\CustomErrorHandlers\ErrorHandler;

/**
 * ContentRepository
 *
 * Methods for obtaining data from third-party services
 */
readonly class ContentRepository implements ContentRepositoryInterface
{
    /**
     * GetInputData
     *
     * @param string $url
     * @return array
     */
    public function getInputData(string $url): array
    {
        $dataString = $this->getFileContents($url);

        $content = [];
        foreach (explode("\n", $dataString) as $line) {
            $content[] = json_decode(trim($line), true);
        }

        return $content;
    }

    /**
     * GetBinList
     *
     * Getting data from the lookup.binlist.net
     *
     * @param $value
     * @return array
     */
    public function getBinList($value): array
    {
        $binFile = __DIR__ . '/../../' . $value . '.txt';
        $binResults = $this->getFileContents($binFile);

        $binURL = $_ENV['BIN_LIST_URL'];
//        $binResults = $this->getFileContents(sprintf('%s/%s', $binURL, $value));

        if (!$binResults) {
            $errorHandler = new ErrorHandler('bin list is empty');
            $errorHandler->render();
        }

        return json_decode($binResults, true);
    }

    /**
     * GetExchangeRate
     *
     * Getting data from the api.exchangeratesapi.io
     *
     * @return array
     */
    public function getExchangeRate(): array
    {
        $exchangeRateURL = $_ENV['EXCHANGE_RATE_URL'];
        if ($_ENV['EXCHANGE_RATE_ACCESS_KEY']) {
            $exchangeRateURL .= '?access_key=' . $_ENV['EXCHANGE_RATE_ACCESS_KEY'];
        }

        return json_decode($this->getFileContents($exchangeRateURL), true);
    }

    /**
     * GetFileContents
     *
     * @param string $url
     * @return false|string
     */
    private function getFileContents(string $url): false|string
    {
        $result = @file_get_contents($url);

        if ($result === FALSE) {
            $error = error_get_last();
            $errorHandler = new ErrorHandler($error['message']);
            $errorHandler->render();
        }

        return $result;
    }
}