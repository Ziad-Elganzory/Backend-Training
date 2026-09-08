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

### Task 2:
Point to the line where LibraryService depends on an abstraction instead of a concrete storage class.

- The service depends on abstraction to provide a dynamic way to get the content so if the lgoic of book storage changes it still gets the answer

### Task 3:
- Why does Laravel need the bind call? What would it not know from the interface alone?
    - because the service container doesn't know automatically what the concrete class you need to use so we need to bind it in the provider and let the Service Container Loads it's Dependencies