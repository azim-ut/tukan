<?

_define('DOMAIN', trim($_SERVER['HTTP_HOST'],'/'));
define('HOST', 'https://'.DOMAIN."/");
_define('ROOT_URL', 'main');
_define('ROOT_DIR', 'site/');

_define('TEMPLATE', "template/proftrud/");
_define('TEMPLATE_CRM', "template/crm/");
_define('TEMPLATE_OFFICE', "template/office/");

define('EMAIL_TEMPLATES_ROOT', "../template_mail/proftrud/");

define('TEMPLATE_MAIL', 'template_mail/');
define('ADMIN_EMAIL', '9420183@gmail.com');
define('NO_REPLY_EMAIL', 'akm@leongaming.com');
define('SUPPORT_EMAIL', 'office@it-prom');
//_define('FB_LOGIN_URL', '/crm/login/');
define('DEFAULT_LANG', 'en');

_define('EMAIL_PROJECT', 'ProfTrud.ru');
_define('EMAIL_LOGO', 'https://proftrud.ru/img/proftrud/logo.png');
define('EMAIL_SMTP_HOST', 'smtp.it-prom.com');
define('EMAIL_SMTP_PORT', '587');
define('EMAIL_SMTP_SECURE', '');
define('EMAIL_SMTP_NOREPLY_LOGIN', 'noreply@it-prom.com');
define('EMAIL_SMTP_NOREPLY_PASSWORD', 'UW8A8QzY');
define('EMAIL_SMTP_LOG_LEVEL', '0');
define('EMAIL_SMTP_AUTH', '1');

_define('BACKEND', 'http://userbets');

_define('FB_APP_ID', '838006139589433');
_define('FB_APP_SECRET', '46b70d27180fea3a2d9630ac84fc7bb5');

_define('GOOGLE_CLIENT_ID', '1007003034268-q7on0ienju81sgn0s2u0bn74997nbjph.apps.googleusercontent.com');

_define('TW_CONSUMER_KEY', '1SN4EOdkWvF4xxsKuhySCgsXH');
_define('TW_CONSUMER_SECRET', 'kbz97GyCnPpJkujnx4y9HzmNmfkTvoykr8Seg7BZNUrNqLsZii');
_define('TW_ACCESS_TOKEN', '2997925457-60LKmHQub9gTIPXQV0lDckavhWdvd4qK8mDY9Ea');
_define('TW_ACCESS_TOKEN_SECRET', 'Pn05TMJDfHUZbpbnQSZlo4yFzBIgQEoQ9tBO5c2Q4i9UZ');
_define('TW_OWNER_ID', '2997925457');

define('GOOGLE_CONFIG_JSON', '{"web":{"client_id":"898923403913-jih422jprnih4aq8aogvar49di80pgr1.apps.googleusercontent.com","project_id":"plated-valor-854","auth_uri":"https://accounts.google.com/o/oauth2/auth","token_uri":"https://accounts.google.com/o/oauth2/token","auth_provider_x509_cert_url":"https://www.googleapis.com/oauth2/v1/certs","client_secret":"sbu3BXSDpcinS4vh3R3V6aT4","redirect_uris":["https://it-prom.com/test/google_login.php","http://it-prom.com/test/login_google.php"],"javascript_origins":["https://it-prom.com"]}}');

define('IS_DEV', true);
define('COUNTERS_TEST_BLOCK', 93);
_define('UPDATED', 100);
