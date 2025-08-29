# Stage 1 — SQL Injection (Web)

- Service: Apache2 on :80
- Vulnerable endpoint: `/prison/prison_login.php`
- Core flaw: unsanitized string interpolation in SQL query:
````

SELECT \* FROM prisoners WHERE username = '\$username' AND password = '\$password';

```
- Example payload: username `' OR 1=1 #` (password any). :contentReference[oaicite:15]{index=15}

See `setup.sql` for minimal schema + seed (flag location as per report). :contentReference[oaicite:16]{index=16}
