## Answer Those Questions:

- What problem does Factory Pattern solve?
    - it solves the Tightly coupled code by removing direct object creation from core business logic and delegating it in a new Method or Class
- Why is it better to put object creation in a factory instead of a controller?
    - To Separate the object creation logic from the core buisness logic 
- Why should all factory-created classes usually implement the same interface?
    - So it ensures polymorphysim and allow losse coupling and allow the code to interact with any generated object without knowing it's specific concrete class
- Does Factory Pattern remove `if`/`match` logic completely, or move it to a better place?
    - it moves the if / match logic to a more centralized place rather than removing it completely
- What should a factory return: unrelated objects or variants of the same family?
    - It Should Return Variants of the same family to achive the single responspility principle
- How does Laravel’s IoC container make factories more powerful?
    - The IoC container lets the factory create classes with their dependencies automatically, so the factory does not need to manually pass constructor dependencies.”