<?php

require '../vendor/autoload.php';

use App\View\CurrencyConverterView;

$currencyConverterView = new CurrencyConverterView();
echo $currencyConverterView->renderAction(3);
