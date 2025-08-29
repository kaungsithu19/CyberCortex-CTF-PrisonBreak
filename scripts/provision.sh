#!/usr/bin/env bash
set -euo pipefail

# Web
sudo apt update
sudo apt install -y apache2 php libapache2-mod-php mysql-server

# FTP
sudo apt install -y vsftpd

# IMAP
sudo apt install -y dovecot-imapd

# SSH (usually present)
sudo apt install -y openssh-server gcc python3

sudo systemctl enable --now apache2 vsftpd dovecot ssh
