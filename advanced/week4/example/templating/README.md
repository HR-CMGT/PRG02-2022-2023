To configure in XAMPP:

- Edit `/XAMPP-path/etc/extra/httpd-vhosts.conf`

First add localhost as default to prevent localhost from being broken
(please change the `DocumentRoot` to your own path):
```text
<VirtualHost *:80>
    ServerAdmin webmaster@dummy-host2.example.com
    DocumentRoot "/Applications/XAMPP/xamppfiles/htdocs"
    ServerName localhost
    ErrorLog "logs/localhost-error_log"
    CustomLog "logs/localhost-access_log" common
</VirtualHost>
```

Add extra hosts for w4 example (please change the `DocumentRoot` to your own path)
If you continue in the next weeks you can repeat the same trick again and again):

```text
<VirtualHost *:80>
    ServerAdmin webmaster@dummy-host2.example.com
    DocumentRoot "/Applications/XAMPP/xamppfiles/htdocs/PRG02/advanced/week4/example/templating"
    ServerName templating-w4.localhost
    ErrorLog "logs/music-collection.local-error_log"
    CustomLog "logs/music-collection.local-access_log" common
</VirtualHost>
```

- Enable custom hosts in the main config file `/XAMPP-path/etc/httpd.conf`

Remove the `#` before: `Include etc/extra/httpd-vhosts.conf`

**NOTE**: always restart your apache after these changes!!!

Finally, change your hosts file with the following lines:

```text
127.0.0.1       templating-w4.localhost
```

Mac: Open terminal and run `sudo nano /etc/hosts`
Windows edit the `C:\Windows\System 32\drivers\etc\hosts.txt` file as administrator

Tada! Now you can visit `http://templating-w4.localhost` in your browser.
