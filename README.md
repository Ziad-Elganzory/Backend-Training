# Micro Tasks

### Task 1:

1. Manual testing may miss regressions after refactors and is easy to forget in repeated checks.
2. The Service because the core logic happens inside the service and the controller uses it

### Task 2:

1. Unit Test should not send http requests , should not require services running
2. `ProductCatalogService::getProducts()`

### Task 3:

1. Ran the command

```bash
./vendor/bin/sail artisan test --compact
```

1. File `tests/Unit/ExampleTest.php` read
2. `toBeTrue()` changed to `toBeFalse()` and it failed

### Task 4:

1. Arrange : Clear Cache state (`Cache:flush()`) and Instantiate `ProductCatalogService::class`
2. Act: call `getProducts()` twice and store it in 2 variables
3. Assert: that the 2 results have the same `generated_at` value



### Task 5:

```bash
sail artisan make:test --pest --unit DashboardStatsServiceTest
```



### Task 6:

1. Unit Test
2. Integration Test
3. Unit Test
4. Integration Test



### Task 7:

1. Code added in `tests/Unit/ProductCatalogServiceTest.php`

```php
use Illuminate\Support\Facades\Cache;
use App\Services\ProductCatalogService;

uses(Tests\TestCase::class);

beforeEach(function(){
    Cache::flush();
});

it('stores the catalog in cache', function () {
	$service = new ProductCatalogService();
	$service->getProducts();

	expect(Cache::has('products.catalog.v1'))->toBeTrue();
});
```



### Task 8:

1. Cache hit test added
2. i added cache miss test too



### Task 9:

1. Test added `rebuilds the catalog after forget`



### Task 10:

1. Test added `returns products with generated_at`



### Task 11:

1. Tests use the in-memory array store so they stay fast, don’t need Sail Redis, and don’t read/write production cache keys.
2. use a mock to isolate the code you are testing by replacing dependencies that are slow, unpredictable, or depend on external systems (like APIs, databases, or time).It guarantees your tests run instantly, predictably, and without side effects.



### Task 12:

- All test names are well typed and documented



### Task 13:

- [x] File named *Test.php

- [x] uses(Tests\TestCase::class) present

- [x] Cache::flush() used between tests

- [x] No HTTP calls

- [x] At least 3 focused tests

### Task 14:
1. i would unit test that `NotificationFacade` sends email, database notification , firebase notification and also test the failure cases
2. i would unit-test that `ProductObserver` clears `products.catalog.v1` when product is saved `(CUD)` operations

### Task 15:
1. All tests passed after running
```bash
./vendor/bin/sail artisan test tests/Unit --compact
```

### Task 16:
1. Testing Requests (Get,Post,Put,Delete)
2. Testing Routes + Controller + Service Together
3. Refresh Database with real DB
4. `Http::fake()` for external APIs

