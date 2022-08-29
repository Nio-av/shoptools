# Currency Converter

## Task

You need to design a simple converter which accepts a monetary value in a certain currency as an argument and outputs list of results converted to various world currencies (requested currencies and exchange rates will come from a data source).
Data source for currencies and exchange rates (for now data is in JSON, but you've already heard that soon you'll need to switch to CSV or XML so make the switch as easy as possible):

```
{
"baseCurrency": "EUR",
    "exchangeRates" : {
        "EUR": 1,
        "USD": 5,
        "CHF": 0.97,
        "CNY": 2.3
    }
}

```

The output (list of results) should be in JSON or CVS format (might change in the future).
Possible interface for the converter, it’s just an example, feel free to improve, modify it or define your own:

```
interface CurrencyConverterInterface
{
    public function convert(float $amount, Currency $currency): string;
}
```

## Documentation

- To start, just use docker-compose up -d.
- Webintercase and Browser-Readme: http://localhost/
- PHPUnit - Test is autoexecuted on docker-compose up.
- You might also can use a Plugin for your favorite IDE
- If you use docker-compose up -d, have a look into the logfiles of yout docker-Network
- TODOs: Improve Tests. This is just a basic Structure / Demo.
- Tests should also run without problems on docker-compose up -d (currently, there are some Problems while using REST-Communication )

### Important Files:

- www\Controller\Rest\RestService: Basic Communication with an API
- www\Controller\Rest\CurrencyApi: Implementation of specific JSON-API
- www\Controller\CurrencyConverterService: Calculate Values
- www\Model\Currency: Model for Currency
