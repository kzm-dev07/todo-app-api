<?php

return [
    'jwks_url' => env('KEYCLOAK_JWKS_URL', 'keycloak:8080/realms/kzm-app/protocol/openid-connect/certs'),
];
