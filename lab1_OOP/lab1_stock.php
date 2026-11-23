<?php

/* ДЕЛ 1 - задолжителен за сите студенти
Класа StockPrice
Претставува цена на една акција за одреден датум.

Атрибути:

date - датум на цената (во формат dd/mm/yyyy)
closed_price - затворена цена на тој датум
opened_price - почетна цена на тој датум
highest_price - највисока цена на тој датум
lowest_price - најниска цена на тој датум
Конструктор:

__construct($date, $closed_price, $opened_price, $highest_price, $lowest_price)
Класа Stock
Претставува акција на компанија.

Атрибути:

ticker - симбол на акцијата (на пример „AAPL“)
shares_outstanding - број на издадени акции од компанијата
sector - enum со вредности TECHNOLOGY, FINANCE, HEALTHCARE, ENERGY
stock_prices - асоцијативна низа со претходни цени, каде клуч е датум (dd/mm/yyyy), а вредност е објект од класата StockPrice
Конструктор:

__construct($ticker, $shares_outstanding, $sector)
Методи:

addStockPrice($stockPrice) - додава историска цена во низата stock_prices.
Ако веќе постои цена за истиот датум, испечати: "There is already a historical price for this date for this stock"
Ако не постои, додај ја цената.
calculateMarketCapForDate($date) - пресметува пазарна капитализација за даден датум:
shares_outstanding * closed_price
Ако нема цена за тој датум, испечати: "No historical price for this date for this stock"
Ако постои, врати ја пресметаната вредност.
getLastClosedPrice() - ја враќа затворената цена (closed_price) од последната додадена цена.
Ако нема податоци, враќа null.
ДЕЛ 2 - задолжителен за сите студенти освен студентите од ССП
Класа StockExchange
Претставува берза на која се тргува со акции.

Атрибути:

exchange_name - име на берзата (на пример „NASDAQ“)
listed_stocks - низа со сите акции листирани на берзата
Конструктор:

__construct($exchange_name)
Методи:

listStock($stock) - додава акција во листата на берзата.
findStockByTicker($ticker) - враќа акција според нејзиниот ticker.
Ако не постои, испечати: "Stock not found"
Ако постои, врати го објектот Stock.
Класа Portfolio
Претставува портфолио на инвеститор.

Атрибути:

cash - износ на расположлив кеш за купување акции
stockHoldings - низа со записи во формат:
['numberOfShares' => број, 'stock' => објект од тип Stock]
Конструктор:

__construct($cash)
Методи:

buyStock($ticker, $numberOfShares, $stockExchange) – купување акции:
Ако акцијата не постои, испечати: "Stock not found"
Ако нема достапна последна цена, испечати: "No price available for this stock"
Ако нема доволно кеш, испечати: "Insufficient cash to buy this stock"
Ако сè е во ред, купи акции, намали cash и испечати: "Bought X shares of Y for Z USD on EXCHANGE_NAME"
sellStock($ticker, $numberOfShares, $stockExchange) – продажба на акции:
Ако не постои, испечати: "Stock not found"
Ако нема доволно акции, испечати: "Not enough shares to sell"
Ако нема цена, испечати: "No price available for this stock"
Ако сè е во ред, продај акции, зголеми cash и испечати: "Sold X shares of Y for Z USD on EXCHANGE_NAME"
Напоменa:
Датумот секогаш да биде во формат dd/mm/yyyy.
Ако не постои вредност (цена, акција, податок), методите враќаат null.
Сите пораки се печатат со echo.
Последната внесена цена се смета за актуелна.
При работа со низи користете ги функциите:
array_key_last() - за добивање на последниот елемент во низа
unset() - за бришење на елемент од низа
array_values() - за повторно порамнување на индексите по бришење
Сите класи може да се сместат во еден фајл main.php.

$applePrice1 = new StockPrice('01/01/2025', 100.0, 95.0, 102.0, 90.0);
$applePrice2 = new StockPrice('02/01/2025', 110.0, 100.0, 115.0, 98.0);
$applePrice3 = new StockPrice('03/01/2025', 120.0, 112.0, 125.0, 110.0);

$appleStock = new Stock('AAPL', 16000000000.0, Sector::TECHNOLOGY);
$appleStock->addStockPrice($applePrice1);
$appleStock->addStockPrice($applePrice2);
$appleStock->addStockPrice($applePrice3);

$microsoftStock = new Stock('MSFT', 7500000000.0, Sector::TECHNOLOGY);
$microsoftStock->addStockPrice(new StockPrice('01/01/2025', 300.0, 295.0, 310.0, 290.0));

$nasdaq = new StockExchange('NASDAQ');
$nasdaq->listStock($appleStock);
$nasdaq->listStock($microsoftStock);

echo "MarketCap 02/01/2025: ".($appleStock->calculateMarketCapForDate('02/01/2025') ?? 'null')." USD\n";

$portfolio = new Portfolio(10000.0);
$portfolio->buyStock('AAPL', 10, $nasdaq);
$portfolio->buyStock('MSFT', 5, $nasdaq);
$portfolio->buyStock('MSFT', 1000, $nasdaq);
$portfolio->sellStock('AAPL', 4, $nasdaq);
$portfolio->sellStock('MSFT', 50, $nasdaq);

echo "Cash: {$portfolio->cashBalance} USD\n";
print_r($portfolio->stockHoldings); */
enum Sector: string{
    case TECHNOLOGY = 'Technology';
    case FINANCE = 'Finance';
    case HEALTHCARE = 'Healthcare';
    case ENERGY = 'Energy';
}

class StockPrice {
    public string $date;
    public float $closed_price;
    public float $opened_price;
    public float $highest_price;
    public float $lowest_price;

    public function __construct(string $date, float $closed_price, float $opened_price, float $highest_price, float $lowest_price){
        $this->date = $date;
        $this->closed_price = $closed_price;
        $this->opened_price = $opened_price;
        $this->highest_price = $highest_price;
        $this->lowest_price = $lowest_price;
    }

}

class Stock {
    public string $ticker;
    public int $shares_outstanding;
    public Sector $sector;
    public array $stock_prices = [];

    public function __construct(string $ticker, int $shares_outstanding, Sector $sector){
        $this->ticker = $ticker;
        $this->shares_outstanding = $shares_outstanding;
        $this->sector = $sector;
    }

    public function addStockPrice($stockPrice): void{
        if(isset($this->stock_prices[$stockPrice->date])){
            echo "There is already a historical price for this date for this stock\n";
            return;
        }

        $this->stock_prices[$stockPrice->date] = $stockPrice;
    }

    public function calculateMarketCapForDate($date) {
        if(!isset($this->stock_prices[$date])){
            echo "No historical price for this date for this stock\n";
            return;
        }

        return $this->shares_outstanding * $this->stock_prices[$date]->closed_price;
    }

    public function getLastClosedPrice() {
        if(empty($this->stock_prices)) {
            return null;
        }

        return $this->stock_prices[array_key_last($this->stock_prices)]->closed_price;
    }

}

class StockExchange {
    public string $exchange_name;
    public array $listed_stocks = [];

    public function __construct(string $exchange_name) {
        $this->exchange_name = $exchange_name;
    }

    public function listStock($stock): void{
        $this->listed_stocks[$stock->ticker] = $stock;
    }

    public function findStockByTicker($ticker) {
        if(!isset($this->listed_stocks[$ticker])){
             echo "Stock not found\n";
             return;
        }

        return $this->listed_stocks[$ticker];
    }
}

class Portfolio {
    public float $cash;
    public array $stockHoldings = [];

    public function __construct(float $cash){
        $this->cash = $cash;
    }

    public function buyStock($ticker, $numberOfShares, $stockExchange): void {
        if($stockExchange->findStockByTicker($ticker) === null){
            echo "Stock not found\n";
            return;
        }

        if($stockExchange->findStockByTicker($ticker)->getLastClosedPrice() === null){
            echo "No price available for this stock\n";
            return;
        }

        if(($this->cash) < ($numberOfShares * $stockExchange->findStockByTicker($ticker)->getLastClosedPrice())){
            echo  "Insufficient cash to buy this stock\n";
            return;
        }

        $this->cash -= $numberOfShares * $stockExchange->findStockByTicker($ticker)->getLastClosedPrice();

        $this->stockHoldings[$ticker] = [
            'numberOfShares' => $numberOfShares,
            'stock' => $stockExchange->findStockByTicker($ticker)
        ];

        $totalCost = $numberOfShares * $stockExchange->findStockByTicker($ticker)->getLastClosedPrice();
        echo "Bought {$numberOfShares} shares of {$ticker} for {$totalCost} USD on {$stockExchange->exchange_name}\n";
        return;
    }
}


$applePrice1 = new StockPrice('01/01/2025', 100.0, 95.0, 102.0, 90.0);
$applePrice2 = new StockPrice('02/01/2025', 110.0, 100.0, 115.0, 98.0);
$applePrice3 = new StockPrice('03/01/2025', 120.0, 112.0, 125.0, 110.0);

$appleStock = new Stock('AAPL', 16000000000.0, Sector::TECHNOLOGY);
$appleStock->addStockPrice($applePrice1);
$appleStock->addStockPrice($applePrice2);
$appleStock->addStockPrice($applePrice3);

$microsoftStock = new Stock('MSFT', 7500000000.0, Sector::TECHNOLOGY);
$microsoftStock->addStockPrice(new StockPrice('01/01/2025', 300.0, 295.0, 310.0, 290.0));

$nasdaq = new StockExchange('NASDAQ');
$nasdaq->listStock($appleStock);
$nasdaq->listStock($microsoftStock);

echo "MarketCap 02/01/2025: ".($appleStock->calculateMarketCapForDate('02/01/2025') ?? 'null')." USD\n";

$portfolio = new Portfolio(10000.0);
$portfolio->buyStock('AAPL', 10, $nasdaq);
$portfolio->buyStock('MSFT', 5, $nasdaq);
$portfolio->buyStock('MSFT', 1000, $nasdaq);
$portfolio->sellStock('AAPL', 4, $nasdaq);
$portfolio->sellStock('MSFT', 50, $nasdaq);

echo "Cash: {$portfolio->cashBalance} USD\n";
print_r($portfolio->stockHoldings);
