#!/usr/bin/env bash
set -euo pipefail
gcc -o /bin/suid_wrapper ./../challenges/05-suid-priv-esc/suid_wrapper.c
sudo chown root:root /bin/suid_wrapper
sudo chmod u+s /bin/suid_wrapper
sudo install -m 755 ../challenges/05-suid-priv-esc/suid_script.py /bin/suid_script.py
