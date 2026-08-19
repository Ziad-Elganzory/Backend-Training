## Answer in your own words:

1. What problem does Builder Pattern solve?

    - constructing a complex object with many optional pieces. A giant constructor is hard to read, and creating the object too early leaves it half-valid.
2. Why does Builder use `build()` instead of treating the builder as the final object?

    - build() turns a half-finished construction tool into a finished object. The builder may validate and calculate while assembling. The product is what the rest of the app uses. If you treat the builder as the final object, you can pass around something that is still incomplete.

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