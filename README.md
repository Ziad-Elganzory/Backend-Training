## Answer in your own words:

1. What problem does caching solve?
	- Caching avoids repeating expensive work (like the same DB query) on every request by storing the result temporarily under a key and reusing it until it expires or is invalidated.
2. What is a cache hit and a cache miss?
	- Cache hit: the key exists in the store and is still valid, so we return the saved value and skip the expensive work.
	- Cache miss: the key is missing or expired, so we must compute the value, store it, then return it.
3. Why is Redis a good cache store for this project?
	- Redis keeps data in memory (fast), supports tags and locks, and can be shared by all Sail/PHP workers — better than database/file cache for this lesson and for production-style caching.
4. Why is `Cache::remember()` better than manual get/put?
	- `remember()` does get-or-compute-and-put in one call, so the miss/hit flow stays in one place and you are less likely to forget the `put` step.
5. What is cache invalidation, and why is it hard?
	- Invalidation means deleting or refreshing a cached value when the real data changes (for example `Cache::forget()` or a tag flush). It is hard because you must know every related key, and wrong timing causes either stale data or too many rebuilds.
6. What is a cache stampede?
	- When a cache key expires and many requests miss at the same time, they all rebuild the expensive value together and overload the database. A Redis lock (or flexible refresh) lets one request rebuild while others wait or reuse.
7. When should you avoid caching?
	- When the data must be exact right now (money, stock, payment status, auth decisions)
	- When user-specific data would sit under a shared key
	- When the flow is write-heavy
	- When the query is already tiny and cheap
	- When you cannot invalidate safely
8. What is the difference between request memoization and Redis `remember()`?
	- Memoization (`once()` / `Cache::memo()`) reuses a result inside one HTTP request only, then it is gone.
	- Redis `remember()` stores a result in a shared store across requests, so later traffic can reuse it until TTL ends or the key is forgotten.
9. Why can a shared Redis key for user-specific data be dangerous?
	- A shared key like `profile` can return User A's data to User B. User-specific data needs the user id in the key, for example `user.profile.17` or `user.profile.'.auth()->id()`.
10. Why can we use cache tags now, when a `database` cache store could not?
	- The `database` and `file` cache drivers do not support tags. Redis does, so we can group related keys and flush a group without calling `Cache::flush()` on everything.