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

## Lesson Questions :
1. What is a unit test?
	- Unit test is the process of testing each service method through assertions and protect the app refactoring process from breaking the logic
2. How is a unit test different from an integration test?
	- Unit Test tests the services (Busiess Logic) and ensure that each method is working as intended
	- Integration Test: tests the endpoint , controller , service together to ensure the flow is working correctly
3. Why do tests use the array cache store instead of Redis?
	- because using array cache store is fast , reliable than testing real production redis store
4. What is Arrange → Act → Assert?
	- Arrange: is preparing the data we will test (eg. Time, Service, mocks and refrence shapes)
	- Act: The process of firing the method that returns the intended data
	- Assert: The step where we check the returned value match our expectation or not
5. Why test `generated_at` staying the same on two calls?
	- That means that it reades the cached object , also worth mentioning that forgeting the cach and rebuilding requires a time margin to get diffrent timestamp.
6. What should your forget/refresh method do, and how do you prove it in a test?
	- refresh methods deletes the key. Prove it with `Cache::has` false after forget, then call the getter again and assert a new generated_at.
7. Why do cache-related unit tests need `uses(Tests\TestCase::class)`?
	- because the cache facade expects the laravel app to boot
8. What belongs in `tests/Unit` vs `tests/Feature` in this training path?
	- `tests/Unit` : Should include unit tests done on service classes
	- `tests/Feature` : Should include feature , integration tests on endpoints, controllers , services together
9. Why are behavior-based test names better than `test1` / `test catalog`?
	- because naming the tests is documenting it so if a test fails , the reason appears clear and decribing what actually broke
10. How do you isolate cache in unit tests without Redis, and how do you assert a key was stored?
	- We isolate cache using the `phpunit.xml` file and setting the `CACHE_STORE` to `array` so the stored keys are stored away from production redis store
	- we assert the keys using `Cache::has($cacheKey)`