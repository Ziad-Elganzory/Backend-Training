## Micro Tasks

### Task 1:
1. What is incompatible in the Twilio vs Local example?
    - Each Service speaks it's own language , both recive the same info but in diffrent ways
2. What would go wrong if controllers talk to both SDKs directly?
    - if we wanted to add a new sdk , that requires a huge modification in the core controller or service and scatterd logic.

### Task 2:
1. The interface your app owns is called the : Target Interface
2. The foreign class being wrapped is called the : Adaptee
3. The class that translates is called the : Adapter

### Task 3:
- why is changing the adapter better than rewriting every controller when you switch SMS providers?
    - to achive the open closed principle , where we add a new logic without doing modifications to the main controllers , services , jobs, etc...


### Task 4:
- Why is composition (has-a) usually better than inheritance (is-a) for adapters in Laravel?
    - because it decouples the adapter from the adapted service and allows behavior to change or swap dynamically at runtime

### Task 5:
- your `send($to, $message)` becomes which Local method? 
    - it becomes `sendSms` in the LocalSmsClient class
- which Local response field becomes your returned message id?
    - `message_id` is the field returend

### Task 6:
1. `CheckoutFacade::place()` calls inventory, payment, notifier : Facade Pattern
2. `TwilioSmsAdapter` wraps Twilio’s SDK to match `SmsSender` : Adapter Pattern
3. `PercentageDiscount` and `FixedDiscount` both implement `DiscountCalculator` : Strategy Pattern

### Task 7:
- Why should `SmsController` depend on `SmsSender` / the factory, not `TwilioClient`?
    - Controllers should depend on SmsSender so they never know Twilio method names. The factory (or container) chooses the adapter.
### Task 8:
- Write one good cache key for USD -> EGP rates, and one reason you would not cache a card charge result.
    - key : `fx.USD.EGP.v1`
    - don’t cache because each charge is a unique money move that must hit the provider now

### Task 9:
Mark each as unit / feature:

1. Assert `TwilioSmsAdapter` maps `sid` -> return value : Unit Test
2. `POST /api/sms/send` returns 200 JSON : Feature Test
3. `Http::fake` response for a rates API used by an adapter : Unit Test

### Task 10:
- Give one backend example from your work/study where Adapter fits, and one where it would be overkill.

    - Fits: When using multiple payment gateways sdks
    - Overkill : a single internal MailService with one method and no foreign SDK — an adapter adds nothing.

### Task 11:
- Fix this design smell in one sentence: `OrderController` calls `TwilioClient` and `LocalSmsClient` with if/else.

    - Fix: move the service selection from if/else to adapter pattern so the controller doesn't know what provider our app currently using