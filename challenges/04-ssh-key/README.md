# Stage 4 — SSH Private Key Access

Use the recovered key:
```bash
chmod 600 escape_key
ssh -i escape_key guard@<IP>
````

Check artifacts (e.g., `~/.bash_history`) for `FLAG_4`.&#x20;
