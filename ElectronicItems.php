<?php
class ElectronicItems
{

    private $items = array();

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
    * Returns the items depending on the sorting type requested
    *
    * @return array
    */
    public function getSortedItems()
    {
        $sorted = $this->items;

        usort($sorted, function ($a, $b) {
            return $a->getTotalPrice() > $b->getTotalPrice();
        });

        return $sorted;
    }

    /**
    *
    * @param string $type
    * @return array
    */
    public function getItemsByType($type)
    {

        if (in_array($type, ElectronicItem::$types))
        {

            $callback = function($item) use ($type)
            {

                return $item->type == $type;
            };

            $items = array_filter($this->items, $callback);
        }

        return false;
    }

    public function getTotalPrice()
    {
        $totalPrice = 0.00;

        foreach ($this->items as $item) {
            $totalPrice += $item->getTotalPrice();
        }

        return $totalPrice;
    }
}
