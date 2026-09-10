## Micro Tasks:

### Task 1:
1. Look at the two responses. Name two changes that would break an existing client.

```json
{
    "id": 42,
    "name": "Mechanical Keyboard",
    "price": 1500
}
```

```json
{
    "id": 42,
    "title": "Mechanical Keyboard",
    "price": {
        "amount": 1500,
        "currency": "EGP"
    },
    "availability": {
        "in_stock": true
    }
}
```
- Answer:
    1. Price key is changed
    2. new availability key is added
    3. name key is changed to title

---

### Task 2:
- For each change below, mark it breaking or compatible:

    1. Add a nullable description field. --> (Compatible)
    2. Rename stock to quantity. --> (Breaking)
    3. Add GET /api/v1/products/{product}/reviews. --> (Compatible)
    4. Change created_at from a string to an object. --> (Breaking)

---

## Questions:
Answer in your own words:

1. What is the exact V1 URL and request field in this practice?
    - `/api/v1/welcome?name=Ziad`
2. What is the exact V2 URL and request field?
    - `/api/v2/welcome?first_name=Ziad`
3. Which V1 response field must remain unchanged after V2 is added?
    - `"message"`
4. Why do V1 and V2 use separate controllers?
    - to utilize deprication so the client remains stable and provide a migration plan
5. Why would changing name to first_name in V1 be a breaking change?
    - because the change requires the client to change the code so it's breaking change
6. Why is the V2 data wrapper a breaking response change for V1 clients?
    - Because the client reads the keys defined in the V1 contract so changing the keys require a v2 contract and a migration plan
7. Why must V1 feature tests still run after V2 is created?
    - So the v1 becoms stable until the client changes the code to v2
8. Which versioning strategy does this project use?
    - URL Prefix versioning
9. What would you tell a V1 client before removing V1?
    - Migrate to V2 before the sunset date: new URL, first_name instead of name, and read data.greeting instead of message. V1 will stop working after that date.