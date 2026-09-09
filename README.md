## Micro Tasks
### Task 1:
```php
final class CheckoutService
{
    public function place(array $data): void
    {
        $payments = new StripePaymentGateway(
            config('services.stripe.secret'),
        );

        $orders = new EloquentOrderRepository();

        $mailer = new OrderMailer();

        $orders->save($data);

        $payments->charge($data['amount']);

        $mailer->sendConfirmation($data['email']);
    }
}
```
1. List three objects that CheckoutService creates. Which one would be hardest to replace in a test?
    - `StripePaymentGateway`
    - `EloquentOrderRepository`
    - `OrderMailer`
    - We cannot easily fake a payment gateway in a test 
---

### Task 2:
```php
final class OrderMailer
{
    public function sendConfirmation(string $email): void
    {
        // Send the email.
    }
}

final class CheckoutService
{
    public function __construct(private OrderMailer $mailer)
    {
    }
}
```

1. Why can Laravel create OrderMailer without a binding, but not an interface such as PaymentGateway?
    - Because Concrete Classes is resolvable by laravel that is available for zero-configuration resolution
    - While Interfaces , Abstract classes , scalar values , etc.. are not resolvable since it's not defined what concrete classes needs to be binded to this interface or abstract class
---

## Questions:

1. What is Laravel's Service Container responsible for?
    - The Service Container responsible for resolving the classes dependencies by automatic resolution or class bindings
2. What is the difference between Dependency Injection and Inversion of Control?
    - Dependency Injection is Defining the dependencies required for the class while Inversion of Control is the process of loading the dependencies via the service container
3. Why can Laravel resolve a simple concrete class automatically?
    - Because the dependencies are clearly injected through the constructor , methods , properties injection and the Service container can see the required dependencies to load (zero-configuration resolution)
4. Why does an interface need a binding?
    - Because the interface is a promise not a class laravel can instantiate
5. What is the difference between bind, singleton, scoped, and instance?
    - Bind: Creates a new object whenever the container resolves it
    - Singleton: Creates one object and reuses the same object for the life of the application process
    - Scoped: Creates one object per request or per job lifecycle, then forgets it at the next lifecycle
    - Instance: Gives the container an object you already created
6. When would you use a closure binding?
    - When laravel needsspecial instructions to build  the object
7. When would contextual binding be a better choice than one global binding?
    - When there's multiple consumers need the same interface but diffrent implementations
8. Why is constructor injection usually better than calling app() inside a service?
    - Because `app()` hides the dependencies
9. How did the container make the Repository Pattern work in Lesson 8?
    - The container binds the `UserRepository` interface to the concrete implementation
10. How can a test replace a real payment gateway without changing CheckoutService?
    - by using a `FakePaymentGateway` instance and binding it inside the test