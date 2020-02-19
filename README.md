# Acme Inc. Vulnerable Web Application

This is a vulnerable web application made for the 2016 CNY Hackathon. It's written in PHP and uses MySQL.

DON'T USE THIS IN A PRODUCTION ENVIRONMENT!

The operational state can be tested using the ```test.php``` file. 

## Requirements

Needs the PHP ```mysqli``` library.

## Installation

### Manual

Copy the contents of the `html` directory into the `/var/www/html` or equivalent directory.

Create the database `hackathon`, then populate it using the `database.sql` file.

### Docker

Build using:
```
docker build -t j2h2-vulnapp1 .
```

Then run using (Maps port 1337 to port 80 on the container):
```
docker run -p 1337:80 --name vulnapp j2h2-vulnapp1
```

## Vulnerability List

A list of vulnerabilities is available in the ```vuln_list.txt.base64``` file. As indicated, the list is base64 encoded so you can try to find all the vulnerabilities on your own before checking it against the list. Don't cheat :).

