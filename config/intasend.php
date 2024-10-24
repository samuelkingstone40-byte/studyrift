<?php

return [
    'token'=>env('INTASEND_SECRET_KEY','ISSecretKey_live_d4a7188d-9990-414d-a948-fb99fb4019e1'),
    'publishable_key'=>env('INTASEND_PUBLIC_KEY','ISPubKey_live_98233316-0de2-479a-9c00-f9762fdf29d4'),
    'live'=>env('INTASEND_ENVIRONMENT','LIVE'),
    'host'=>env('APP_URL','https://studymerit.com')
];

