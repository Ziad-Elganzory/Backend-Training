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