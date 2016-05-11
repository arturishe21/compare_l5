
В composer.json добавляем в блок require
```json
 "vis/compare_l5": "1.*"
```

Выполняем
```json
composer update
```

Добавляем в app.php в массив providers
```php
  Vis\Compare\CompareServiceProvider::class,
```

Использование
сверху
```php
    use Vis\Compare\Facades\Compare;
```

методы:
```php
  // добавить в сравнение
   Compare::addCompare($idProduct, $model = "Product");

  // удалить из сравнения
  Compare::doRemoveCompare($idProduct);

  // проверить или товара в сравнении
   Compare::hasCompare($idProduct);

  //вернуть количество товаров в сравнении
  Compare::getCountCompare();

  //вернуть все товары
    Compare::getProducts($model = "Product");
```
