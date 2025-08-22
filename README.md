🐘 ###Tap PHP SDK

A modern, type-safe, and developer-friendly PHP SDK for Tap Payments
.
Easily create and manage Charges, Authorizations, Refunds, and verify Webhooks with clean PHP objects.

✨ ###Features

🔑 Secure API authentication with secret keys

💳 Manage Charges, Authorizations, Refunds

📦 Clean OOP design (no raw arrays — response objects instead)

🔒 Webhook signature verification helper

⚡ Error handling with custom exceptions (TapException, AuthenticationException, etc.)

🐘 Modern PHP (8.1+, enums, strict types, PSR-18 client support)

✅ Fully tested with PestPHP


📦 ###Installation

```bash
composer require obadaalzidi/tap-php-sdk
```
Requires PHP 8.1+.

🚀 ###Quick Start
```php
use Obadaalzidi\TapPhpSdk\Tap;

$tap = new Tap('sk_test_xxxxxx');

// Create a charge
$charge = $tap->charges()->create([
    'amount'   => 100,
    'currency' => 'KWD',
    'customer' => [
        'first_name' => 'Obada',
        'email'      => 'obada@example.com',
    ],
    'source' => [
        'id' => 'src_all',
    ],
]);

if ($charge->isCaptured()) {
    echo "Charge successful: " . $charge->id();
}
```

📚 ###Usage

Charges
```php
$charge = $tap->charges()->create([...]);
$retrieved = $tap->charges()->retrieve($charge->id());
$list = $tap->charges()->list();
```

Authorizations
```php
$auth = $tap->authorize()->create([...]);
$voided = $tap->authorize()->void($auth->id());
```
Refunds
```php
$refund = $tap->refunds()->create([
    'charge_id' => $charge->id(),
    'amount'    => 50,
]);
```

🧪 ###Testing
This SDK is fully tested with Pest
.
Run the test suite:
```bash
vendor/bin/pest
```

📜 ###License
MIT © Obada Alzidi