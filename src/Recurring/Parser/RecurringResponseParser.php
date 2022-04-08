<?php
declare(strict_types=1);

namespace BlueMedia\Recurring\Parser;

use BlueMedia\Common\Exception\HashException;
use BlueMedia\Common\Parser\ResponseParser;
use BlueMedia\Hash\HashChecker;
use BlueMedia\HttpClient\ValueObject\Response;
use BlueMedia\Recurring\ValueObject\RecurringDeactivationResponse;
use BlueMedia\Serializer\SerializableInterface;
use BlueMedia\Serializer\Serializer;

final class RecurringResponseParser extends ResponseParser
{
    public function parse(): Response
    {
        $this->isErrorResponse();
        return new Response($this->parseRecurringDeactivationInitResponse());
    }

    private function parseRecurringDeactivationInitResponse(): SerializableInterface
    {
        $recurringDeactivation = (new Serializer())->deserializeXml($this->response,
            RecurringDeactivationResponse::class);

        if (HashChecker::checkHash($recurringDeactivation, $this->configuration) === false) {
            throw HashException::wrongHashError();
        }

        return $recurringDeactivation;
    }
}
