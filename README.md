## 1.14 Questions For You
Answer these in your own words:
- What problem does Singleton solve?
    - Singleton Ensures that the class has just a single instance and Provide a global access point to that instance
- Why is the constructor usually private?
    - To prevent creation of multiple instances
- What is the difference between new Logger() and Logger::getInstance()?
    -- new Logger creates a new instance of the class while Logger::getInstance() checks if there's already created instance of that class use it , else create a new instance that's shared along the application lifecycle
- Why can Singleton make testing harder?
    - because it Provides a shared global state and hidden dependencies that prevent test isolation 
- Why is Laravel’s container singleton often better than the classic static Singleton?
    - because it allows dependency injection , support easy mocking for tests , handle multiple isolated container instances, and avoid global state issue that make traditional static classes hard to maintain and test
- Should CurrentUserService be a singleton? Why or why not?
    - no because if the data is shared , the user data can be leaked since the class is shared globaly
- In Laravel Octane, why should we be careful with singleton state?
    - because the application instance stay alive in memory across multiple incoming requests , so the data can be leaked into other user's requests