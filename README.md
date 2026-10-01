# Captive Portal Lab

Laboratoire de test simulant un point d'accès Wi-Fi malveillant (evil twin) avec portail captif, à des fins d'apprentissage en sécurité réseau et sensibilisation aux risques liés aux réseaux Wi-Fi non fiables.

## ⚠️ Avertissement légal et éthique

Ce projet est fourni uniquement à des fins éducatives et de test en environnement autorisé (lab personnel, machines/réseaux vous appartenant, ou dans le cadre d'un test d'intrusion avec autorisation écrite explicite).

L'utilisation de ce type d'outil contre un réseau, un appareil ou une personne sans consentement explicite est illégale dans la très grande majorité des juridictions (interception de communications, usurpation de point d'accès, collecte non autorisée d'identifiants). L'auteur de ce dépôt décline toute responsabilité en cas d'usage non autorisé.

N'utilisez jamais ce projet en dehors d'un environnement que vous possédez ou êtes explicitement autorisé à tester.

## Architecture

Client (victime) --Wi-Fi--> hostapd (point d'accès usurpé) --> dnsmasq (DHCP + DNS wildcard) --> Apache + PHP (portail captif)

1. hostapd crée un faux point d'accès Wi-Fi reproduisant le SSID d'un réseau cible.
2. dnsmasq attribue les adresses IP (DHCP) et résout tous les noms de domaine vers le serveur du portail (DNS wildcard), forçant la redirection de tout trafic HTTP.
3. Apache + PHP sert la page de connexion imitant le portail du réseau visé, et journalise les tentatives de connexion.

## Stack technique

- hostapd — point d'accès Wi-Fi logiciel
- dnsmasq — serveur DHCP/DNS léger
- Apache 2.4 + PHP — serveur web et logique du portail
- Testé sous Kali Linux

## Structure du dépôt

- config/
  - hostapd.conf — Configuration du point d'accès
  - start-dnsmasq.sh — Script de lancement DHCP/DNS
  - 000-default.conf — Vhost Apache (redirections captive portal)
- web/
  - index.html / index.php
  - post.php — Traitement du formulaire de connexion
  - portal/ — Template de la page de portail
- README.md

## Installation et lancement

### Prérequis

sudo apt install hostapd dnsmasq apache2 php libapache2-mod-php

### 1. Configurer l'interface Wi-Fi

Adaptez config/hostapd.conf (SSID, canal) à votre scénario de test, puis :

sudo hostapd config/hostapd.conf

### 2. Démarrer le DHCP/DNS

sudo bash config/start-dnsmasq.sh

### 3. Déployer le portail

sudo cp -r web/* /var/www/html/
sudo cp config/000-default.conf /etc/apache2/sites-enabled/000-default.conf
sudo systemctl restart apache2

## Limitations connues

- Testé en environnement de lab isolé (sans accès Internet réel sur le point d'accès).
- La détection automatique du portail captif par certains appareils (Android notamment) dépend fortement de la version d'OS et du mécanisme de sondage utilisé (generate_204, option DHCP 114/RFC 8910, etc.).

## Licence

Usage personnel / éducatif. Aucune garantie fournie.
