<?php
/**
 * @author Kirill chEbba Chebunin
 * @author Vasil coylOne Kulakov <kulakov@vasiliy.pro>
 *
 * This source file is subject to the MIT license that is bundled
 * with this package in the file LICENSE.
 */
namespace EventBand\Tests;

use EventBand\BandDispatcher;
use EventBand\CallbackSubscription;
use EventBand\Event;
use PHPUnit\Framework\TestCase;


class CallbackSubscriptionTest extends TestCase
{
    /**
     * @test dispatch uses provided callback
     */
    public function dispatchWithCallback()
    {
        $event = $this->createMock(Event::class);
        $dispatcher = $this->createMock(BandDispatcher::class);

        $subscription = new CallbackSubscription(
            'event.name',
            function (Event $providedEvent, BandDispatcher $providedDispatcher) use ($event, $dispatcher) {
                $this->assertSame($event, $providedEvent);
                $this->assertSame($dispatcher, $providedDispatcher);

                return true;
            }
        );

        $this->assertTrue($subscription->dispatch($event, $dispatcher));
    }
}
