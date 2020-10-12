# Firebase PHP Backend

[![Supported PHP version](https://img.shields.io/static/v1?logo=php&label=PHP&message=%5E7.2&color=777bb4)](https://github.com/mi5ha/firebase-php-backend)

Some Firebase functionalities require that you write a server application in order to use them.

This is very simple PHP application that exposes some useful API endpoints that you can use from your mobile or web app.

## Table of contents

  * [Overview](#overview)
  * [Requirements](#requirements)
  * [Installation](#installation)
  * [Security warning](#security-warning)
  * [API](#api)

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
    - Go to "Settings -> Service accounts"
    - First click "Create service account" then "Generate new private key"
- Put service key file somewhere outside document root
- Open `config/config.php`, and add the path to your service key relative to config file

## Security Warning

- Its important that your service account key, i.e. json file you
  downloaded from Firebase, is not accessible from the net
- If you accidentally put this file inside this project, there is .htaccess that should prevent user accessing it (Apache only)
- At the moment this application doesn't support any kind of API authentication

## API

### sendMulticast

Send notifications from one device to multiple other devices.

<details><summary><b>Example</b></summary>

**Path**

```
http://<your-domain>/?method=sendMulticast
```

**JSON request body**

```json
{
  "title": "I am Iron Man",
  "deviceTokens":
    [
        "fqORTS66YYQHKnpSsdf0QIKl:APA91bEggEnA-NDaSRvFtHsdd3UQLw3miPSw0jINjrgg0DdaRUP9u2DXBE6Veq2br9qsmDI5q2S-VnA1SvSmBnrOKMCxyuLzhh0EY2YXvQRqrDL5nf5FC8sjjLAgenLm-voggrtjAdlW",
        "f4fRp143affMgijGpVoj5I:APA91bGaaeqJ1IwtTmVvPVahdzeFbffvXizaL1u2iYGqWDhhht0aJuEFDt-qNHHHTgggUGfrM6qcrwKffFz7Sm-2PMsCFfkjjQjcNDbnn_tOcu9AF0OwGX21aaOpbXCUhhGyy4o5Zcr"
    ],
	"imageUrl": "https://i.insider.com/5b52400e51dfbe20008b45f9?width=750&format=jpeg&auto=webp"
}
```

**Success response**

```json
{
  "success": true
}
```

**Error response**

```json
{
  "success": false,
  "errorMessages": [
    "The registration token is not a valid FCM registration token",
    "The registration token is not a valid FCM registration token"
  ]
}
```

errorMessages is an array of specific error messages for each device token.

</details>

<details><summary><b>You need to get device tokens to use this method.</b></summary>

For example from [React Native Firebase](https://rnfirebase.io) you can get this token with [getToken()](https://rnfirebase.io/reference/messaging#getToken)

```
import messaging from '@react-native-firebase/messaging';

let deviceToken = await messaging().getToken();
```

</details>

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## License

Firebase PHP Backend is licensed under the [MIT License](LICENSE).

Your use of Firebase is governed by the [Terms of Service for Firebase Services](https://firebase.google.com/terms/).