# MR T INNICIATIVE'S Ltd

## Project description

A responsive, multi-page PHP website for the fictional business **MR T INNICIATIVE'S Ltd**. The site presents the business, team, services, service detail pages, and a validated contact form. Contact submissions can be reviewed through a locally protected administration page.

## Features

- Shared configuration, header, and footer includes
- Dynamic page titles and active navigation states
- Data-driven service listings and team profiles
- Individual service detail pages with friendly 404 handling
- Server-side contact form validation and sticky form values
- CSRF protection and PHP session handling
- JSON Lines storage for contact submissions
- Post/Redirect/Get submission flow and success feedback
- Password-protected local messages viewer
- Responsive, modern CSS layout
- Escaped output using a reusable `e()` helper

## Tech stack

- PHP 8
- HTML5
- CSS3
- Apache through XAMPP
- JSON Lines (`.jsonl`) file storage

## How to run with XAMPP

1. Place the project in:

   `C:\xampp\htdocs\swd\04-php-site`

2. Start **Apache** from the XAMPP Control Panel.
3. Open the website in a browser at:

   http://localhost/swd/04-php-site/

4. Open the contact page at:

   http://localhost/swd/04-php-site/contact.php

5. Submit the form, then open the protected message viewer at:

   http://localhost/swd/04-php-site/messages.php

6. The local learning password is defined in `includes/config.php` as `$adminPassword`.

## Project structure

```text
04-php-site/
├── assets/
│   └── css/
│       └── style.css
├── includes/
│   ├── config.php
│   ├── data.php
│   ├── footer.php
│   ├── functions.php
│   └── header.php
├── storage/
│   └── .htaccess
├── about.php
├── contact.php
├── index.php
├── messages.php
├── service.php
├── services.php
└── README.md
```

## What I learned

- _[Place your notes about PHP includes and project structure here.]_
- _[Place your notes about data-driven pages and PHP arrays here.]_
- _[Place your notes about form validation and sticky values here.]_
- _[Place your notes about sessions and CSRF protection here.]_
- _[Place your notes about Post/Redirect/Get here.]_
- _[Place your notes about safe output escaping and XSS prevention here.]_
- _[Place your notes about JSON Lines file storage here.]_
- _[Place your notes about responsive web design here.]_

## Local password security note

The password check in this project is intentionally simple and hard-coded for local learning. It is not production-grade because it uses a visible plaintext credential, has no rate limiting, account lockout, password hashing, secure user database, role-based access control, MFA, or strong session/security policy. A production application should store hashed credentials in a database, use HTTPS, implement secure authentication libraries or framework middleware, and apply appropriate rate limiting and security headers.
