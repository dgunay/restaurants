# Restaurants Picker

Helps you decide on a restaurant by maintaining a list of restaurants you like
and how often you've visited them.

## Testing

Before testing, you must recreate the test database fixture in SQLite3 using the
provided dump file. In BASH:

```bash
cat test/test_database.dump | sqlite3 test/test.db
```