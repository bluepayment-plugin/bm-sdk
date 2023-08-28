<?php
declare(strict_types=1);

namespace BlueMedia\Common\Util;

use BlueMedia\Common\Exception\TranslationException;

class Translations
{
    public const REDIRECT = 'form.paywall.redirect';
    public const JAVASCRIPT_DISABLED = 'form.paywall.javascript_disabled';
    public const JAVASCRIPT_REQUIRED = 'form.paywall.javascript_required';

    private const REQUIRED_TRANSLATIONS = [
        self::REDIRECT,
        self::JAVASCRIPT_DISABLED,
        self::JAVASCRIPT_REQUIRED
    ];

    private $translations = [
        'pl' => [
            self::REDIRECT => 'Trwa przekierowanie do Bramki Płatniczej Autopay...',
            self::JAVASCRIPT_DISABLED => 'Masz wyłączoną obsługę JavaScript',
            self::JAVASCRIPT_REQUIRED =>
                'Aby przejść do Bramki Płatniczej  Autopay, musisz włączyć obsługę JavaScript w przeglądarce.',
        ],
        'en' => [
            self::REDIRECT => 'You are being redirected to the Autopay Payment Gateway...',
            self::JAVASCRIPT_DISABLED => 'You have disabled JavaScript',
            self::JAVASCRIPT_REQUIRED =>
                'To access the Autopay Payment Gateway, you need to enable JavaScript in your browser.',
        ],
        'de' => [
            self::REDIRECT => 'Sie werden zum Autopay Payment Gateway weitergeleitet...',
            self::JAVASCRIPT_DISABLED => 'Sie haben JavaScript deaktiviert',
            self::JAVASCRIPT_REQUIRED =>
                'Damit du auf die zahlungspflichtige Seite Autopay zugreifen kannst, aktiviere das JavaScript.',
        ],
    ];

    public function getTranslation(string $language, array $required_translations = self::REQUIRED_TRANSLATIONS): array
    {
        if (array_key_exists($language, $this->translations) === false) {
            $language = 'en';
        }

        $translation = $this->translations[$language];

        $missing_translation_keys = array_diff($required_translations, array_keys($translation));

        if (!empty($missing_translation_keys)) {
            throw TranslationException::missingTranslation($missing_translation_keys);
        }

        return $this->translations[$language];
    }
}
