<?php


namespace PickPointSdk\Components;


class TariffPrice
{
    /**
     * @var int
     */
    private $priorityMaxDay;

    /**
     * @var int
     */
    private $priorityMinDay;
    /**
     * @var int
     */
    private $standardMaxDay;

    /**
     * @var int
     */
    private $standardMinDay;

    /**
     * @var int
     */
    private $zone;

    /**
     * @var string
     */
    private $errorMessage;

    /**
     * @var int
     */
    private $errorCode;

    /**
     * @var array
     */
    private $prices;

    /**
     * TariffPrice constructor.
     * @param int $priorityMaxDay
     * @param int $priorityMinDay
     * @param int $standardMaxDay
     * @param int $standardMinDay
     * @param int $zone
     * @param string $errorMessage
     * @param int $errorCode
     * @param array $prices
     */
    public function __construct(array $prices = [], int $priorityMaxDay = 0, int $priorityMinDay = 0, int $standardMaxDay = 0, int $standardMinDay = 0, int $zone = 0, string $errorMessage = '', int $errorCode = 0)
    {
        $this->prices = $prices;
        $this->priorityMaxDay = $priorityMaxDay;
        $this->priorityMinDay = $priorityMinDay;
        $this->standardMaxDay = $standardMaxDay;
        $this->standardMinDay = $standardMinDay;
        $this->zone = $zone;
        $this->errorMessage = $errorMessage;
        $this->errorCode = $errorCode;

    }

    /**
     * @return int
     */
    public function getPriorityMaxDay(): int
    {
        return $this->priorityMaxDay;
    }

    /**
     * @return int
     */
    public function getPriorityMinDay(): int
    {
        return $this->priorityMinDay;
    }

    /**
     * @return int
     */
    public function getStandardMaxDay(): int
    {
        return $this->standardMaxDay;
    }

    /**
     * @return int
     */
    public function getStandardMinDay(): int
    {
        return $this->standardMinDay;
    }

    /**
     * @return int
     */
    public function getZone(): int
    {
        return $this->zone;
    }

    /**
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    /**
     * @return int
     */
    public function getErrorCode(): int
    {
        return $this->errorCode;
    }

    /**
     * @return array
     */
    public function getPrices(): array
    {
        return $this->prices;
    }

    /**
     * Returns commons sum of standard tariff
     * @return float
     */
    public function getStandardCommonPrice()
    {
        return $this->getPriceByType('Standard');
    }

    public function getPriorityPrice()
    {
        return $this->getPriceByType('Priority');
    }

    private function getPriceByType($type)
    {
        if (!in_array($type, ['Standard', 'Priority'])) {
            return 0;
        }
        $sum = 0;
        foreach ($this->prices as $price) {
            if ($price['DeliveryMode'] == $type) {
                $sum += $price['Tariff'];
            }
        }
        return $sum;
    }

    public function existsPriorityType(): bool
    {
        foreach ($this->prices as $price) {
            if ($price['DeliveryMode'] == 'Priority') {
                return true;
            }
        }
        return false;
    }

}