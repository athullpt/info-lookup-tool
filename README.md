INFO LOOKUP TOOL

A simple and beginner-friendly OSINT (Open Source Intelligence) web tool built in PHP to gather:

- Domain WHOIS Information
- IP Details using ip-api.com
- Subdomains using Sublist3r
- Phone Number Validation using AbstractAPI

---

WHY I CREATED THIS TOOL

I built this project as a beginner in ethical hacking and web development to:

- Practice using PHP and HTML
- Learn how OSINT tools and APIs work
- Create a local, private, easy-to-use recon tool
- Understand how to run shell commands in web apps

---

STEP-BY-STEP SETUP ON KALI LINUX

1. CREATE PROJECT FOLDER

Run these commands in your terminal:

    mkdir ~/tool
    cd ~/tool

2. CREATE index.php FILE

Open nano to create the PHP file:

    nano index.php

Paste your full PHP + HTML code here (your existing code).

Save and exit nano by pressing:

    Ctrl + O   (then Enter to confirm)
    Ctrl + X

3. INSTALL REQUIRED TOOLS

Update your system and install needed tools:

    sudo apt update
    sudo apt install whois curl php sublist3r

4. RUN THE TOOL (START PHP SERVER)

From your project folder, start PHP’s built-in server:

    php -S 127.0.0.1:8000

Open your browser and go to:

    http://127.0.0.1:8000

5. OPTIONAL: CREATE DESKTOP LAUNCHER

a) Create a script to start the server and open browser:

    nano ~/infotool.sh

Paste this:

    #!/bin/bash
    php -S 127.0.0.1:8000 -t /home/kali/tool > /dev/null 2>&1 &
    sleep 1
    xdg-open http://127.0.0.1:8000

Save and exit (Ctrl + O, Enter, Ctrl + X).

Make the script executable:

    chmod +x ~/infotool.sh

b) Create a desktop shortcut:

    nano ~/.local/share/applications/infotool.desktop

Paste this:

    [Desktop Entry]
    Name=Info Lookup 
    Comment=Open Web Info Lookup Tool
    Exec=/home/kali/infotool.sh
    Icon=/home/kali/Pictures/info.png
    Terminal=false
    Type=Application
    Categories=Utility;

Save and exit.

Make it executable:

    chmod +x ~/.local/share/applications/infotool.desktop

Now you can search for "Info Lookup Tool" in your app menu and launch it.

---

IMPORTANT NOTES:

- This tool is for local and educational use only.
- Do NOT expose it to the internet (no authentication/security).
- Replace the API key in index.php with your own from AbstractAPI.
- Make sure you have internet access for API lookups (IP and Phone).

---

TOOLS USED

Feature           | Tool Used
------------------|-------------------------------
Web Server        | PHP built-in server
Domain Lookup     | whois
IP Lookup         | curl + ip-api.com
Subdomains        | sublist3r
Phone Info        | curl + AbstractAPI

---

