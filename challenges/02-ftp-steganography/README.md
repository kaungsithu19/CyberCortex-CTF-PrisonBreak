# Stage 2 — FTP & Steganography

- Service: VSFTPD on :21
- Login: `mark` / (cracked in Stage 1)
- Hint: hidden HTML comment reveals steghide passphrase `prisonbreak`. :contentReference[oaicite:18]{index=18}
- Command:
  ```bash
  steghide extract -sf prisoners.jpg -p prisonbreak
````

Outcome: reveals text + `FLAG_2` per report.&#x20;
