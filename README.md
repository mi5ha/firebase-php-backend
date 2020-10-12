# Firebase PHP Backend

[![Supported PHP version](https://img.shields.io/static/v1?logo=php&label=PHP&message=%5E7.2&color=777bb4)](https://github.com/mi5ha/firebase-php-backend)

Some Firebase functionalities require that you write a server application in order to use them.

This is very simple PHP application that exposes some useful API endpoints that you can use from your mobile or web app.

## Overview

1. For example, sending multiple Notifications from one device to several other
devices can not be done without a server app.
2. This app uses [Firebase Admin SKD for PHP](https://github.com/kreait/firebase-php) under the hood

## Requirements

- Minimal PHP version is v7.2
- Apache

## Installation

### Create new project

```
composer create-project mi5ha/firebase-backend-api
```

### Configuration

- [Download service account key](https://console.firebase.google.com/project/_/settings/serviceaccounts/adminsdk) file from Firebase
- Put service key file somewhere outside document root
- Open `config/config.php`, and add the path to your service key relative to config file

## Security Warning

- Its important that your service account key, i.e. json file you
  downloaded from Firebase, is not accessible from the net
- If you accidentally put this file inside this project, there is .htaccess that should prevent user accessing it (Apache only)
- At the moment this application doesn't support any kind of API authentication

## API

## License

Firebase PHP Backend is licensed under the [MIT License](LICENSE).

Your use of Firebase is governed by the [Terms of Service for Firebase Services](https://firebase.google.com/terms/).