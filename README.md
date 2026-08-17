Answer in your own words:

- What problem does Strategy Pattern solve?
    - Strategy pattern solves the selection of the suitable logic in a list of related behaviours 
- What is the main difference between Strategy and Factory?
    - Strategy thinks about what's the required behaviour while the factory concerns the object creation
- Why should each strategy implement the same interface?
    - to achive the polymorphism concept where all strategies are related to the same context , and to provide one single source of truth so if we added a new strategy ,
      we don't do a huge modification we just add a new class for the new strategy and use it directly or add a new key in the factory match
- What does the context class do in Strategy Pattern?
    -   the context is the place where it calls the strategy and contain the business rules (Service Class) so we ensure that the controller does not include any business logic and it's handled in the Service Class
- Why is Strategy better than a large `if/else` block for business rules?
    - because the main goal is to achive the open/closed principle , we don't modify the code we just extend it so we have a clear responsibility for each strategy
- Give three real Laravel/backend examples where Strategy would be useful.
    -   Discount Strategies, Payment Providers , Shipping Types
- When should you avoid using Strategy Pattern?
    - when the strategies are not related , when we only have one strategy that has no room for change , when the logic requires 2 if else lines to save effort