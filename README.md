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

## Questions:
1. What problem does Adapter Pattern solve?
    - It solves interface incompatibility between existing third-party or legacy code (Adaptees) and your application's expected domain interface (Target), allowing incompatible classes to work together without altering their source code.
2. What are Target, Adaptee, and Adapter?
    - Target: The interface or abstract class that your application code expects.
    - Adaptee: The existing/foreign class/SDK that has an incompatible interface. (In your answer, you wrote "Adaptee is the client", which is incorrect).
    - Adapter: The wrapper class that implements the Target interface and delegates calls to the Adaptee, translating parameters and return types.
3. What is the difference between Adapter and Facade?
    - Adapter: Hides the incombatibility
    - Facade: hides the complexity
4. What is the difference between Adapter and Strategy?
    - Both can look the same but
        - Adapter:
            - foreign api exists
            - wrap it to match the interface
        - Strategy:
            - we design the interface
            - we write the algorithms to match it
5. Why should controllers depend on your interface, not the vendor SDK?
    - because the vendor sdk can look diffrent, and when we require to change the client , we also change the logic inside the controller.
    since we want to apply the open closed principle , controller should write the logic once and when we want to add a new logic we don't modify the controller
6. How can Factory help when you have multiple adapters?
    - factory can choose the required adapter based on configuration (eg. Admin settings Dashboard , Selection flow , config file , etc...).
7. When should you avoid Adapter?
    - when we own the algorithms and we can change the class to match
    - if there's only one call and no real mismatch
    - if we are renaming methods with no translation needed (empty wrappers)
    - if we actually need facade (many of our own services)
8. How would you unit-test an adapter without calling a real third-party API?
    - By mocking the client class and using the `shouldReceive` method to pass the args , then pass the mocked client to the real adapter class
9. Where could caching fit with an adapter, and what should you not cache?

    - Where caching fits:
        - Inside the adapter directly: The adapter receives a request, checks a local/distributed cache first returns the cached result if available, or fetches from the target API on a miss and saves the response.
        - At the adapter boundary: Placed directly before calling the external adaptee service to store normalized domain models for your system.
        
    - What to avoid caching:
        - Sensitive data: Passwords, payment details, PII, or security tokens.
        - Real-time / highly volatile data: Stock ticks, live sensor metrics, or rapidly updating inventory.
        - State-changing operations: Non-idempotent actions (POST, PUT, DELETE).
        - Unscoped user data: Personal multi-tenant responses that risk leaking across users.
        - Low-reuse queries: One-off, highly specific searches or giant single-use analytics exports.
10. Give one Laravel backend example of Adapter in production systems.
    - If we have multiple payment providers (Paymob, Stripe, etc...) and we want to unify the usage methods and swap the service using config or simillar approaches