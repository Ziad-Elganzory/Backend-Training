## Answer in your own words:

1. What problem does Builder Pattern solve?
    - Builder Pattern is a construction tool that provides a clean way to build the object , by steps and building the object once the steps are completed , and provide what is needed to be added and what can be skipped
2. Why does Builder use `build()` instead of treating the builder as the final object?
    - because builder pattern is just a construction tool that builds the object and can't have any buisness logic related to the created object
3. What is the difference between Builder and Factory?
    - Factory Selects the Object required to create , while builder ensures that the object properties are built step by step and initiate the build command to create the object (Both Factory and Builder can be used together tho)
4. Why do builder methods return `$this`?
    - to achive a fluent interface that allows chaining methods
5. How is Laravel’s query builder related to Builder Pattern?
    - Laravel's query builder provides a way to build the query step by step until running the `get()` command that runs the query
6. Give three backend examples where Builder is useful.
    - Invoice Creation , Email Components Building , Database Query Building
7. When should you avoid Builder?
    - If chaining methods looks fancy
    - When the Normal Constructor is clear or the DTO
    - every call uses the same arguments
    - the object has 2 or 3 required fields and nothing else