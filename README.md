## Answer in your own words:

1. What problem does Facade Pattern solve?
    - Facade hides a complicated subsystem behind one simple method, so callers do not need to know every inner service or repeat the same sequence.
2. Why is a class that only wraps one other class with the same methods not a real Facade?
    - In that case It becomes an Extra layer not a facade since both do the same operations
3. What is the difference between Facade and Builder?
    - Builder assembles one product while facade can use builder in a large workflow
4. What is the difference between Facade and Factory?
    - factory creates one object, Facade uses several objects that already exists
5. What is the difference between the GoF Facade Pattern and a Laravel Facade like `Cache` or `Log`?
    - Laravel Facade is a static proxy that may be simillar like the GoF facade but the concept is diffrent , laravel facade exposes the service container key that can be used anywhere statically
6. Give three backend examples where Facade is useful.
    - Place Order
    - Generate and store reports
    - Process a refund
7. When should you avoid Facade?
    - when it's only one class behind it
    - when hiding a workflow that should be visible
    - when the facade starts absorbing unrelated features