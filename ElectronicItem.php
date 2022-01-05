<?php
use Interfaces\ElectronicItemInterface;

abstract class ElectronicItem
{

    /**
    * @var float
    */
    public $price;

    /**
    * @var string
    * @var bool
    * @var ElectronicItems
    */
    protected $type;
    protected $wired;
    protected $extras;
    private $totalPrice = null;

    protected const ELECTRONIC_ITEM_TELEVISION = 'television';
    protected const ELECTRONIC_ITEM_CONSOLE = 'console';
    protected const ELECTRONIC_ITEM_MICROWAVE = 'microwave';
    protected const ELECTRONIC_ITEM_CONTROLLER = 'controller';
    protected const MAX_EXTRA = self::MAX_EXTRA;

    private static $types = [
        self::ELECTRONIC_ITEM_CONSOLE,
        self::ELECTRONIC_ITEM_MICROWAVE,
        self::ELECTRONIC_ITEM_TELEVISION,
        self::ELECTRONIC_ITEM_CONTROLLER
    ];

    public function getPrice()
    {
        return $this->price;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getWired()
    {
        return $this->wired;
    }

    public function getExtras()
    {
        return $this->extras;
    }

    public function getRemote()
    {
        return $this->remote;
    }

    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function setWired($wired)
    {
        $this->wired = $wired;
        return $this;
    }

    /**
     * Set extras list
     * @param array $extras  [ElectronicItem]
     */
    public function setExtras(array $extras)
    {
        $maxExtra = $this->maxExtras();

        if ($maxExtra && count($extras) > $maxExtra)
            throw new \Exception("This {$this->getType()} can't contain this extras' quantity.");

        $this->extras = new ElectronicItems($extras);

        return $this;
    }

    /**
     * Calculates recursively item total price based on item extras
     * @return totoal amount
     */
    public function getTotalPrice(): float
    {
        // Verify if item has been already calculated
        if ($this->totalPrice !== null)
            return $this->totalPrice;

        $this->totalPrice = (float) $this->getPrice();

        // Verify is there are extra items
        $items = $this->extras ? $this->extras->getSortedItems() : null;

        if ($items) {
            foreach ($items as $item) {
                $this->totalPrice += $item->getTotalPrice();
            }
        }

        return $this->totalPrice;
    }

    /**
     * Force method declaration
     * @var int
     */
    abstract public function maxExtras(): int;
}
