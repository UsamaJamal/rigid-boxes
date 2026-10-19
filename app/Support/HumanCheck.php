<?php

namespace App\Support;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

/**
 * "Are you a human?" addition check for the public forms.
 *
 * The correct sum never appears in the page: it travels inside an encrypted
 * token. A token is valid for a few hours and can be used for one submission
 * only, so a solved answer cannot be replayed by a bot.
 */
class HumanCheck
{
    private const LIFETIME_SECONDS = 6 * 60 * 60;

    /**
     * A new question: ['a' => int, 'b' => int, 'token' => string].
     */
    public static function issue(): array
    {
        $a = random_int(1, 9);
        $b = random_int(1, 9);

        $token = Crypt::encryptString(json_encode([
            'sum' => $a + $b,
            'issued' => time(),
            'nonce' => Str::random(12),
        ]));

        return ['a' => $a, 'b' => $b, 'token' => $token];
    }

    /**
     * Whether $answer is the right sum for $token. With $consume the token is
     * marked as used, so the same token is rejected next time.
     */
    public static function passes($token, $answer, bool $consume = false): bool
    {
        if (!is_string($token) || $token === '' || !is_numeric($answer)) {
            return false;
        }

        try {
            $payload = json_decode(Crypt::decryptString($token), true);
        } catch (DecryptException $e) {
            return false;
        }

        if (!is_array($payload) || !isset($payload['sum'], $payload['issued'])) {
            return false;
        }
        if (time() - (int) $payload['issued'] > self::LIFETIME_SECONDS) {
            return false;
        }
        if ((int) $answer !== (int) $payload['sum']) {
            return false;
        }

        $usedKey = 'human-check-used:' . sha1($token);
        if ($consume) {
            // add() only succeeds for the first caller, so a token works once.
            return Cache::add($usedKey, true, self::LIFETIME_SECONDS);
        }

        return !Cache::has($usedKey);
    }
}
