## Micor Tasks
### Task 1:
- What knowledge is leaking out of the controller in this example?

```php
public function index(Request $request)
{
    $products = Product::query()
        ->with('category')
        ->where('is_active', true)
        ->when(
            $request->string('search')->isNotEmpty(),
            fn ($query) => $query->where(
                'name',
                'like',
                '%' . $request->string('search')->value() . '%',
            ),
        )
        ->orderBy('name')
        ->paginate(20);

    return response()->json($products);
}
```
Answer:

1. Model Name
2. Relationships
3. active rows
4. search syntax
5. sort order
6. pagination details

- If “available products” changes, where would you rather make that change?
    
    1. Bad Practice: Doing the change in all controllers using the same logic
    2. Good Practice: Utilize Repository Patter so the change occures in one place and affects all the controllers using it
---
### Task 2:
Point to the line where LibraryService depends on an abstraction instead of a concrete storage class.

- The service depends on abstraction to provide a dynamic way to get the content so if the lgoic of book storage changes it still gets the answer
---
### Task 3:
- Why does Laravel need the bind call? What would it not know from the interface alone?
    - because the service container doesn't know automatically what the concrete class you need to use so we need to bind it in the provider and let the Service Container Loads it's Dependencies
---
## Questions:

1. What problem does Repository solve in a Laravel application?
    - Solves the problem of tight coupling between business logic and data access code
2. Why does `UserDirectoryService` depend on `UserRepository` instead of `EloquentUserRepository`?
    - becuase `EloquentUserRepository` is a concrete implementation of `UserRepository` Interface , when we want to change the concrete implementation we should do it to all calls , but we use the interface binding to provide an abstract implementation so switching will be easier
3. Why is paginate() a better repository method than query() for this small exercise?
    - because `query()` is just mimicing the eloquent methods wich already exists while `paginate()` is solving a buisness question frequently asked
4. Where does Eloquent belong after you introduce a repository?
    - Eloquent belongs to the repository class so we provide isolation between business and data access
5. What is the difference between a Repository and a Service?
    - Repository acts as a translator between business logic and data access layer,
    - while Service Focuses only on the business logic using the methods defined in the Repository Class
6. When would a repository be overkill?
    - When the controller uses one simple model query once
    - When the interface mirrors the Eloquent (ORM) Methods
    - When there's no shared behavior or boundary exists
    - When the repository adds no meaning , only extra files 
7. How does Laravel know which repository implementation to inject?
    - By utilizing the Service Container binding in the `AppServiceProvider` since we map the interface to the concrete implementation
8. How can a fake UserRepository help a unit test?
    - helps by isolating the code under test from external dependencies like database or networks APIs