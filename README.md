## Micro Tasks

### Task 1:
1. What can break even when all unit tests pass?
	- Wrong rout path
	- Controller Returns wrong json shape
	- endpoint forgets to call the service
	- prefix missing in the url
	- different response status code
2. Name one URL you will test in this lesson.
```bash
GET /api/products/catalog
```

## Task 2:
1. Which folder should `ProductCatalogApiTest.php` live in?
	- it lives under `tests/Feature` directory
2. What is the difference between testing `getProducts()` directly vs `GET /api/products/catalog`?
	- testing ``getProducts()` directly tests the service business logic that runs under the hood
	- testing `GET /api/products/catalog` tests the user facing problems

##  Task 3:
```bash
sail artisan make:test --pest DashboardStatsApiTest
```

## Task 4:
```php
it('returns the product catalog',function(){
    $this->getJson('/api/products/catalog')
	->assertSuccessful()
	->assertJsonStructure(['generated_at','products']);
});
```

## Task 5:
```php
it('returns the same generated_at on consecutive requests',function(){
	// Arrange
    $this->travelTo(now());
    //Act
    $firstResponse = $this->getJson('/api/products/catalog')
        ->assertSuccessful()
        ->json('generated_at');
    $this->travel(30)->second();
    $secondResponse = $this->getJson('/api/products/catalog')
        ->assertSuccessful()
        ->json('generated_at');
    // Assert
    expect($firstResponse)->toBe($secondResponse);
});
```

## Task 6:
```php

it('returns the product catalog',function(){
    $this->getJson('/api/products/catalog')
        ->assertSuccessful()
        ->assertJsonStructure([
            'generated_at',
            'products'=>[
                ['id','name','price']
            ]
        ]);
});
```

## Task 7:
```php
it('returns the same generated_at on consecutive requests',function(){
	// Arrange
    $this->travelTo(now());
    //Act
    $firstResponse = $this->getJson('/api/products/catalog')
        ->assertSuccessful()
        ->json('generated_at');
    $this->travel(30)->second();
    $secondResponse = $this->getJson('/api/products/catalog')
        ->assertSuccessful()
        ->json('generated_at');
    // Assert
    expect($firstResponse)->toBe($secondResponse);
});
```

## Task 8:
```php
it('clears the catalog cache on refresh',function(){
    $this->travelTo(now());

    $first = $this->getJson('/api/products/catalog')
        ->assertSuccessful()
        ->json('generated_at');

    $this->postJson('/api/products/catalog/refresh')
        ->assertSuccessful()
        ->assertJson(['message' => 'Products Catalog Refreshed Successfully']);

    $this->travel(1)->second();

    $second = $this->getJson('/api/products/catalog')
        ->assertSuccessful()
        ->json('generated_at');
    
    expect($second)->not->toBe($first);
});
```

## Task 9:
1. Answer in one sentence: when would you use `assertJsonPath` vs `json()` + `expect()`?
	- use `assertJsonPath` when you want the error tied to the http response
	- use `json()` + `expect()` when you compare values across the requests

## Task 10:
1. Give one example bug that only an integration test would catch in this project.
	- Controller returns wrong keys

## Task 11:
why do the catalog/stats API tests in this lesson skip `RefreshDatabase`?
	- Because we use `RefreshDatabase` when we deal with models, migrations , db reads and writes but for this lesson we're deal with caching concepts only.

## Task 12:
1. Answer in one sentence: why is `Http::fake()` useful in integration tests, but not needed for `/api/products/catalog` today?

	- `Http::fake()` is useful when dealing with third party services (eg. Payment gateway, shipping api, sms providers), for now we're dealing with caching concepts.

## Task 13:
- [x] File is under `tests/Feature`
- [x] URLs start with `/api`
- [x] Uses `getJson` / `postJson`
- [x] No direct `new ProductCatalogService()` (for HTTP tests)
- [x] At least 3 focused tests

## Task 14:
- In two sentences, explain how lesson 13 and lesson 14 test the same cache hit behavior differently.

    - lesson 13 test the cache hit by testing the `getProducts()` service method directly twice and checking that they have the same `generated_at` value
    - lesson 14 test the cache hit by sending a get request to `/api/products/catalog` twice and both retrive the same `generated_at` value

## Task 15:
- All Features passed when running
```bash
./vendor/bin/sail artisan test tests/Feature --compact
```

## Task 16:
- name one test you would not write in this lesson but would write after you add authenticated order APIs.

    - Testing auth on `/api/user` that checks if user is authenticated

