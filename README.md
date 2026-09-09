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