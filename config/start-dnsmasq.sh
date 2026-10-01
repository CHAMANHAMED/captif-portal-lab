#!/bin/bash
dnsmasq --interface=wlan0 --bind-interfaces -C /dev/null \
  --dhcp-range=10.0.0.10,10.0.0.50,255.255.255.0 \
  --dhcp-option=3,10.0.0.1 \
  --dhcp-option=6,10.0.0.1 \
  --dhcp-option=114,http://10.0.0.1/index.html \
  --address=/#/10.0.0.1 \
  --no-resolv \
  --no-hosts \
  --no-daemon --log-dhcp --log-queries
