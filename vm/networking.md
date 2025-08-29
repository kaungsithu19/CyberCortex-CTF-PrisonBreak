# Networking cheatsheet

Bring interface up & assign IP:
```bash
sudo ip link set <iface> up
sudo ip addr add <IP/CIDR> dev <iface>
````

Port forwarding example (redirect 22→2222):

```bash
sudo iptables -t nat -A PREROUTING -p tcp --dport 22 -j REDIRECT --to-ports 2222
```

````
