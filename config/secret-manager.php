<?php

return [

    "enableSecretManager" => env("ENABLE_SECRET_MANAGER",false),
    "checkSecretManagerApi" => env("CHECK_SECRET_MANAGER_API"),

    "aws" => [
        "region" => env("AWS_DEFAULT_REGION",""),
        "secretName" => env("AWS_SECRET_NAME",""),
    ],
    "configVariables" => [
        "DB_USERNAME" => "database.connections.mysql.username",
        "DB_PASSWORD" => "database.connections.mysql.password",
        "STRIPE_KEY" => "stripe.key",
        "STRIPE_SECRET" => "stripe.secret",
        "MAIL_USERNAME" => "mail.username",
        "MAIL_PASSWORD" => "mail.password",
    ]

];
