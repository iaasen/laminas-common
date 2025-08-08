<?php
/**
 * User: ingvar.aasen
 * Date: 30.06.2017
 */

namespace Iaasen\Service;


use Iaasen\WithOptions;
use Laminas\ApiTools\Rest\AbstractResourceListener;
use Laminas\Http\Header\Authorization;

abstract class AbstractRestResource extends AbstractResourceListener {

	/**
	 * @see CalculateStartEndHelper::calculateStartEnd()
     * @return int[]
	 */
    protected function calculateStartEnd(): array
    {
        $event = $this->getEvent();
        return CalculateStartEndHelper::calculateStartEnd(
            $event->getRouteParam('year', $event->getQueryParam('year', date('Y'))),
            $event->getRouteParam('month', $event->getQueryParam('month', date('m'))),
            $event->getQueryParam('start'),
            $event->getQueryParam('end'),
        );
    }

	protected function isRequestForSingleMonth(): bool
    {
        $event = $this->getEvent();
        return CalculateStartEndHelper::isRequestForSingleMonth(
            $event->getRouteParam('year', $event->getQueryParam('year')),
            $event->getRouteParam('month', $event->getQueryParam('month'))
        );
	}

    /**
     * @return int[]|null
     */
	protected function getRequestForSingleMonth(): array|null
    {
        $event = $this->getEvent();
        return CalculateStartEndHelper::getRequestForSingleMonth(
            $event->getRouteParam('year', $event->getQueryParam('year')),
            $event->getRouteParam('month', $event->getQueryParam('month'))
        );
	}

    /**
     * @param array|string|null $withString
     * @param array $default
     * @param array $full
     * @return array
     * @deprecated
     */
	public static function extractWith(array|string|null $withString, array $default = [], array $full = []) : array {
		return WithOptions::extractWith($withString, $default, $full);
	}


	protected function getAccessTokenFromRequest() : ?string {
		/** @var Authorization $authorization */
		$authorization = $this->getEvent()->getRequest()->getHeaders()->get('Authorization');
		if(!$authorization) return null;
		$matches = [];
		$success = preg_match('/^Bearer (.+)$/', trim($authorization->getFieldValue()), $matches);
		if(!$success) return null;
		return $matches[1];
	}

}
