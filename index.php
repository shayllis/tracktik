<?php
spl_autoload_register(function ($className)
{
    $className = ltrim($className, '\\');
    $fileName  = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
    if (stream_resolve_include_path($fileName)) {
        require_once $fileName;
    }
});

use ElectronicItems as ElectronicItems;
use ElectronicItem as ElectronicItem;

class Console extends ElectronicItem
{
    const MAX_EXTRA = 4;

    public function __construct()
    {
        // Shortcut type assignment
        $this->setType(self::ELECTRONIC_ITEM_CONSOLE);
    }

    public function maxExtras(): int
    {
        return self::MAX_EXTRA;
    }
}

class Television extends ElectronicItem
{
    const MAX_EXTRA = 0;

    public function __construct()
    {
        // Shortcut type assignment
        $this->setType(self::ELECTRONIC_ITEM_TELEVISION);
    }

    public function maxExtras(): int
    {
        return self::MAX_EXTRA;
    }
}

class Microwave extends ElectronicItem
{
    const MAX_EXTRA = -1;

    public function __construct()
    {
        // Shortcut type assignment
        $this->setType(self::ELECTRONIC_ITEM_MICROWAVE);
    }

    public function maxExtras(): int
    {
        return self::MAX_EXTRA;
    }
}

class Controller extends ElectronicItem
{
    const MAX_EXTRA = -1;

    public function __construct()
    {
        // Shortcut type assignment
        $this->setType(self::ELECTRONIC_ITEM_CONTROLLER);
    }

    public function maxExtras(): int
    {
        return self::MAX_EXTRA;
    }
}

//use ElectronicItem;

// Console controller list
$consoleControllerWired1 = (new Controller())
    ->setPrice(25)
    ->setWired(true);

$consoleControllerWired2 = clone $consoleControllerWired1; // The same as wired controller 1

$consoleControllerRemote1 = (new Controller())
    ->setPrice(60)
    ->setWired(false);

$consoleControllerRemote2 = clone $consoleControllerRemote1; // The same as remote controller 1

// Console
$console = new Console();
$console->setPrice(500);
$console->setExtras([
    $consoleControllerWired1,
    $consoleControllerWired2,
    $consoleControllerRemote1,
    $consoleControllerRemote2
]);

// TV 1
$tv1Controller1 = (new Controller())
    ->setPrice(20)
    ->setWired(false);

$tv1Controller2 = clone $tv1Controller1; // The same as controller 1

$tv1 = (new Television())
    ->setPrice(900)
    ->setExtras([
        $tv1Controller1,
        $tv1Controller2
    ]);

// TV 2
$tv2Controller = (new Controller())
    ->setPrice(20)
    ->setWired(false);

$tv2 = (new Television())
    ->setPrice(400)
    ->setExtras([$tv2Controller]);

$microwave = (new Microwave())
    ->setPrice(90);

// Shopping list;
$shoppingList = new ElectronicItems([
    $console,
    $tv1,
    $tv2,
    $microwave
]);

$itemsByPrice = $shoppingList->getSortedItems();

foreach($itemsByPrice as $item) {
    echo "Item: {$item->getType()} - {$item->getTotalPrice()}\n<br>";
}

echo "Total: {$shoppingList->getTotalPrice()}\n";

// Create buying items
