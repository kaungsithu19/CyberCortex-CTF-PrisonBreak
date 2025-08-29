# CyberCortex: Prison Break (CTF VM)

A narrative, 5-stage Capture-the-Flag virtual machine for cybersecurity training. Built on **Ubuntu 20.04**, it teaches: SQLi → stego/FTP → IMAP/bruteforce → SSH key access → SUID priv-esc. :contentReference[oaicite:0]{index=0}

> **Docs**: Full project report lives in [`docs/CyberCortex_CTF_PrisonBreak.pdf`](./docs/CyberCortex_CTF_PrisonBreak.pdf). :contentReference[oaicite:1]{index=1}

## Quick start
1. Import the OVA from `vm/OVA_LINKS.md`. (Contains the shared Drive link from the report.) :contentReference[oaicite:2]{index=2}
2. Boot the VM and ensure services are up (Apache, VSFTPD, Dovecot IMAP, OpenSSH, MySQL). :contentReference[oaicite:3]{index=3}
3. Use the stage READMEs under `challenges/` to play or to rebuild the VM.

## Scenario at a glance
- **Users**: `admin` (web), `mark` (FTP), `david` (IMAP), `guard` (SSH), `root` (final). :contentReference[oaicite:4]{index=4}  
- **Services/ports**: HTTP :80, FTP :21, IMAP :143, SSH :22, MySQL (local). :contentReference[oaicite:5]{index=5}
- **Stages**:  
  1. SQL injection against a vulnerable PHP login. :contentReference[oaicite:6]{index=6}  
  2. FTP download + steganography to extract hidden data. :contentReference[oaicite:7]{index=7}  
  3. IMAP mailbox + brute force to retrieve a flag and an SSH private key. :contentReference[oaicite:8]{index=8}  
  4. SSH with the recovered key; inspect artifacts for the next flag. :contentReference[oaicite:9]{index=9}  
  5. Privilege escalation via SUID wrapper executing a Python script as root. :contentReference[oaicite:10]{index=10}

## Wordlists
- `wordlists/key.txt` — curated passwords used during the CTF (provided). :contentReference[oaicite:11]{index=11}
- `wordlists/guess_u.txt` — sample usernames derived from in-game hints. :contentReference[oaicite:12]{index=12}

## Rebuild scripts
See `scripts/` for provisioning and seeding helpers to reconstruct key parts of the VM from a fresh Ubuntu 20.04 base. :contentReference[oaicite:13]{index=13}

## Safety notice
This VM intentionally contains vulnerabilities. Run **only** in an isolated lab network with non-routable IPs. Do not expose to the public internet.

## License
See [LICENSE](./LICENSE).
