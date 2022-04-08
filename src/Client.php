<?php
declare(strict_types=1);

namespace BlueMedia;

use BlueMedia\Common\Builder\ServiceDtoBuilder;
use BlueMedia\Common\Enum\ClientEnum;
use BlueMedia\Common\Parser\ServiceResponseParser;
use BlueMedia\Common\Util\EnvironmentRequirements;
use BlueMedia\Confirmation\Builder\ConfirmationVOBuilder;
use BlueMedia\Hash\HashChecker;
use BlueMedia\HttpClient\HttpClient;
use BlueMedia\HttpClient\HttpClientInterface;
use BlueMedia\HttpClient\ValueObject\Request;
use BlueMedia\HttpClient\ValueObject\Response;
use BlueMedia\Itn\Builder\ItnDtoBuilder;
use BlueMedia\Itn\Builder\ItnResponseBuilder;
use BlueMedia\Itn\Builder\ItnVOBuilder;
use BlueMedia\Itn\Decoder\ItnDecoder;
use BlueMedia\Itn\ValueObject\Itn;
use BlueMedia\PaywayList\Dto\PaywayListDto;
use BlueMedia\PaywayList\ValueObject\PaywayListResponse\PaywayListResponse;
use BlueMedia\Recurring\Builder\RecurringDtoBuilder;
use BlueMedia\Recurring\Parser\RecurringResponseParser;
use BlueMedia\RegulationList\Dto\RegulationListDto;
use BlueMedia\RegulationList\ValueObject\RegulationListResponse\RegulationListResponse;
use BlueMedia\Rpan\Builder\RpanBuilder;
use BlueMedia\Rpan\Builder\RpanDtoBuilder;
use BlueMedia\Rpan\Builder\RpanVOBuilder;
use BlueMedia\Rpan\Decoder\RpanDecoder;
use BlueMedia\Rpan\ValueObject\Rpan;
use BlueMedia\Rpdn\Builder\RpdnBuilder;
use BlueMedia\Rpdn\Builder\RpdnDtoBuilder;
use BlueMedia\Rpdn\Builder\RpdnVOBuilder;
use BlueMedia\Rpdn\Decoder\RpdnDecoder;
use BlueMedia\Rpdn\ValueObject\Rpdn;
use BlueMedia\Serializer\SerializableInterface;
use BlueMedia\Transaction\Builder\TransactionDtoBuilder;
use BlueMedia\Transaction\Parser\TransactionResponseParser;
use BlueMedia\Transaction\View;

final class Client
{
    private const HEADER = 'BmHeader';
    private const PAY_HEADER = 'pay-bm';
    private const CONTINUE_HEADER = 'pay-bm-continue-transaction-url';

    /**
     * @var Configuration
     */
    private $configuration;

    /**
     * @var HttpClientInterface|null
     */
    private $httpClient;

    public function __construct(
        string $serviceId,
        string $sharedKey,
        string $hashMode = ClientEnum::HASH_SHA256,
        string $hashSeparator = ClientEnum::HASH_SEPARATOR,
        HttpClientInterface $httpClient = null
    ) {
        EnvironmentRequirements::checkPhpEnvironment();

        $this->configuration = new Configuration($serviceId, $sharedKey, $hashMode, $hashSeparator);
        $this->httpClient = $httpClient ?? new HttpClient();
    }

    /**
     * Perform standard transaction.
     *
     * @param array $transactionData
     *
     * @return Response
     * @api
     */
    public function getTransactionRedirect(array $transactionData): Response
    {
        return new Response(
            View::createRedirectHtml(TransactionDtoBuilder::build($transactionData, $this->configuration))
        );
    }

    /**
     * Perform transaction in background.
     * Returns payway form or transaction data for user.
     *
     * @param array $transactionData
     *
     * @return Response
     * @api
     */
    public function doTransactionBackground(array $transactionData): Response
    {
        $transactionDto = TransactionDtoBuilder::build($transactionData, $this->configuration);

        $transactionDto->setRequest(new Request(
            $transactionDto->getGatewayUrl() . ClientEnum::PAYMENT_ROUTE,
            [self::HEADER => self::PAY_HEADER]
        ));

        $parser = new TransactionResponseParser($this->httpClient->post($transactionDto), $this->configuration);

        return $parser->parse();
    }

    /**
     * Initialize transaction.
     * Returns transaction continuation or transaction information.
     *
     * @param array $transactionData
     *
     * @return Response
     * @api
     */
    public function doTransactionInit(array $transactionData): Response
    {
        $transactionDto = TransactionDtoBuilder::build($transactionData, $this->configuration);

        $transactionDto->setRequest(new Request(
            $transactionDto->getGatewayUrl() . ClientEnum::PAYMENT_ROUTE,
            [self::HEADER => self::CONTINUE_HEADER]
        ));

        $parser = new TransactionResponseParser($this->httpClient->post($transactionDto), $this->configuration);

        return $parser->parse(true);
    }

    /**
     * Initialize deactivation recurring.
     * Returns recurring information.
     *
     * @param array $transactionData
     *
     * @return Response
     * @api
     */
    public function doRecurringDeactivationInit(array $recurringData): Response
    {
        $recurringData['recurringDeactivation']['messageID'] = bin2hex(random_bytes(ClientEnum::MESSAGE_ID_LENGTH));
        $recurringDeactivationDto = RecurringDtoBuilder::build($recurringData, $this->configuration);

        $recurringDeactivationDto->setRequest(new Request(
            $recurringDeactivationDto->getGatewayUrl() . ClientEnum::DEACTIVATE_RECURRING_ROUTE,
            [self::HEADER => self::CONTINUE_HEADER]
        ));

        $parser = new RecurringResponseParser($this->httpClient->post($recurringDeactivationDto), $this->configuration);

        return $parser->parse();
    }

    /**
     * Process ITN requests.
     *
     * @param string $itn encoded with base64
     * @return Response
     * @api
     */
    public function doItnIn(string $itn): Response
    {
        $itnDto = ItnDtoBuilder::build(ItnDecoder::decode($itn));

        return new Response($itnDto->getItn());
    }

    /**
     * Process RPAN requests.
     *
     * @param string $rpan encoded with base64
     * @return Response
     * @api
     */
    public function doRpanIn(string $rpan): Response
    {
        $rpanDto = RpanDtoBuilder::build(RpanDecoder::decode($rpan));

        return new Response($rpanDto->getRpan());
    }

    /**
     * Process RPDN requests.
     *
     * @param string $rpdn encoded with base64
     * @return Response
     * @api
     */
    public function doRpdnIn(string $rpdn): Response
    {
        $rpdnDto = RpdnDtoBuilder::build(RpdnDecoder::decode($rpdn));

        return new Response($rpdnDto->getRpdn());
    }

    /**
     * Returns response for ITN IN request.
     *
     * @param Itn $itn
     * @param bool $transactionConfirmed
     *
     * @return Response
     * @api
     *
     */
    public function doItnInResponse(Itn $itn, bool $transactionConfirmed = true)
    {
        return new Response(ItnResponseBuilder::build($itn, $transactionConfirmed, $this->configuration));
    }

    /**
     * Returns response for RPAN IN request.
     *
     * @param Rpan $rpan
     * @param bool $transactionConfirmed
     *
     * @return Response
     * @api
     *
     */
    public function doRpanInResponse(Rpan $rpan, bool $transactionConfirmed = true)
    {
        return new Response(RpanBuilder::build($rpan, $transactionConfirmed, $this->configuration));
    }

    /**
     * Returns response for RPDN IN request.
     *
     * @param Rpdn $rpdn
     * @param bool $transactionConfirmed
     *
     * @return Response
     * @api
     *
     */
    public function doRpdnInResponse(Rpdn $rpdn, bool $transactionConfirmed = true)
    {
        return new Response(RpdnBuilder::build($rpdn, $transactionConfirmed, $this->configuration));
    }

    /**
     * Returns payway list.
     *
     * @param string $gatewayUrl
     * @return Response
     * @api
     */
    public function getPaywayList(string $gatewayUrl): Response
    {
        $paywayListDto = ServiceDtoBuilder::build(
            [
                'gatewayUrl' => $gatewayUrl,
                'paywayList' => [
                    'serviceID' => $this->configuration->getServiceId(),
                    'messageID' => bin2hex(random_bytes(ClientEnum::MESSAGE_ID_LENGTH))
                ]
            ],
            PaywayListDto::class,
            $this->configuration
        );

        $paywayListDto->setRequest(new Request(
            $paywayListDto->getGatewayUrl() . ClientEnum::PAYWAY_LIST_ROUTE
        ));

        $parser = new ServiceResponseParser($this->httpClient->post($paywayListDto), $this->configuration);

        return new Response($parser->parseListResponse(PaywayListResponse::class));
    }

    /**
     * Returns payment regulations.
     *
     * @param string $gatewayUrl
     * @return Response
     * @api
     */
    public function getRegulationList(string $gatewayUrl): Response
    {
        $regulationListDto = ServiceDtoBuilder::build(
            [
                'gatewayUrl' => $gatewayUrl,
                'regulationList' => [
                    'serviceID' => $this->configuration->getServiceId(),
                    'messageID' => bin2hex(random_bytes(ClientEnum::MESSAGE_ID_LENGTH))
                ]
            ],
            RegulationListDto::class,
            $this->configuration
        );

        $regulationListDto->setRequest(new Request(
            $regulationListDto->getGatewayUrl() . ClientEnum::GET_REGULATIONS_ROUTE
        ));

        $parser = new ServiceResponseParser($this->httpClient->post($regulationListDto), $this->configuration);

        return new Response($parser->parseListResponse(RegulationListResponse::class));
    }

    /**
     * Checks id hash is valid.
     *
     * @param SerializableInterface $data
     * @return bool
     * @api
     */
    public function checkHash(SerializableInterface $data): bool
    {
        return HashChecker::checkHash($data, $this->configuration);
    }

    /**
     * Method allows to check if gateway returns with valid data.
     *
     * @param array $data
     * @return bool
     * @api
     */
    public function doConfirmationCheck(array $data): bool
    {
        return $this->checkHash(ConfirmationVOBuilder::build($data));
    }

    /**
     * Method allows to get Itn object from base64
     *
     * @param string $itn
     * @return Itn
     */
    public static function getItnObject(string $itn): Itn
    {
        return ItnVOBuilder::build(ItnDecoder::decode($itn));
    }

    /**
     * Method allows to get Rpan object from base64
     *
     * @param string $rpan
     * @return Rpan
     */
    public static function getRpanObject(string $rpan): Rpan
    {
        return RpanVOBuilder::build(RpanDecoder::decode($rpan));
    }

    /**
     * Method allows to get Rpdn object from base64
     *
     * @param string $rpdn
     * @return Rpdn
     */
    public static function getRpdnObject(string $rpdn): Rpdn
    {
        return RpdnVOBuilder::build(RpdnDecoder::decode($rpdn));
    }
}
