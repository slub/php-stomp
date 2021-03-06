<?php
/**
 *
 * Copyright 2005-2006 The Apache Software Foundation
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace CentralDesktop\Stomp\Test;

use CentralDesktop\Stomp;

/**
 * Stomp test case.
 * @package Stomp
 * @author  Michael Caplan <mcaplan@labnet.net>
 * @version $Revision: 38 $
 */
class StompSslTest extends \PHPUnit_Framework_TestCase {
    /**
     * @var Stomp\Connection
     */
    private $Stomp;
    private $broker = 'ssl://localhost:61612';
    private $queue = '/queue/test';

    /**
     * Prepares the environment before running a test.
     */
//    protected
//    function setUp() {
//        parent::setUp();
//
//
//        $this->Stomp       = new Stomp\Connection($this->broker);
//        $this->Stomp->sync = false;
//    }

    /**
     * Cleans up the environment after running a test.
     */
//    protected
//    function tearDown() {
//        $this->Stomp = null;
//        parent::tearDown();
//    }

    /**
     * Tests Stomp->abort()
     */
    public
    function testAbort() {
        // TODO Auto-generated StompTest->testAbort()
        $this->markTestIncomplete("abort test not implemented");
    }

    /**
     * Tests Stomp->hasFrameToRead()
     *
     */
    public
    function testHasFrameToRead() {
        $this->markTestIncomplete(
            "This test doesn't use mocks, it tries to talk to a STOMP server"
        );

        if (!$this->Stomp->isConnected()) {
            $this->Stomp->connect();
        }

        $this->Stomp->setReadTimeout(5);

        $this->assertFalse($this->Stomp->hasFrameToRead(), 'Has frame to read when non expected');

        $this->Stomp->send($this->queue, 'testHasFrameToRead');

        $this->Stomp->subscribe($this->queue, array('ack' => 'client', 'activemq.prefetchSize' => 1));

        $this->assertTrue($this->Stomp->hasFrameToRead(), 'Did not have frame to read when expected');

        $frame = $this->Stomp->readFrame();

        $this->assertTrue($frame instanceof StompFrame, 'Frame expected');

        $this->Stomp->ack($frame);

        $this->Stomp->disconnect();

        $this->Stomp->setReadTimeout(60);
    }

    /**
     * Tests Stomp->ack()
     */
    public
    function testAck() {
        $this->markTestIncomplete(
            "This test doesn't use mocks, it tries to talk to a STOMP server"
        );


        if (!$this->Stomp->isConnected()) {
            $this->Stomp->connect();
        }

        $messages = array();

        for ($x = 0; $x < 100; ++$x) {
            $this->Stomp->send($this->queue, $x);
            $messages[$x] = 'sent';
        }

        $this->Stomp->disconnect();

        for ($y = 0; $y < 100; $y += 10) {

            $this->Stomp->connect();

            $this->Stomp->subscribe($this->queue, array('ack' => 'client', 'activemq.prefetchSize' => 1));

            for ($x = $y; $x < $y + 10; ++$x) {
                $frame = $this->Stomp->readFrame();
                $this->assertTrue($frame instanceof StompFrame);
                $this->assertArrayHasKey($frame->body, $messages, $frame->body . ' is not in the list of messages to ack');
                $this->assertEquals('sent', $messages[$frame->body], $frame->body . ' has been marked acked, but has been received again.');
                $messages[$frame->body] = 'acked';

                $this->assertTrue($this->Stomp->ack($frame), "Unable to ack {$frame->headers['message-id']}");

            }

            $this->Stomp->disconnect();

        }
    }

    /**
     * Tests Stomp->begin()
     */
    public
    function testBegin() {

        $this->markTestIncomplete(
            "This test doesn't use mocks, it tries to talk to a STOMP server"
        );
        // TODO Auto-generated StompTest->testBegin()
        $this->markTestIncomplete("begin test not implemented");
        $this->Stomp->begin( /* parameters */);
    }

    /**
     * Tests Stomp->commit()
     */
    public
    function testCommit() {

        $this->markTestIncomplete(
            "This test doesn't use mocks, it tries to talk to a STOMP server"
        );


        // TODO Auto-generated StompTest->testCommit()
        $this->markTestIncomplete("commit test not implemented");
        $this->Stomp->commit( /* parameters */);
    }

    /**
     * Tests Stomp->connect()
     */
    public
    function testConnect() {
        $this->markTestIncomplete(
            "This test doesn't use mocks, it tries to talk to a STOMP server"
        );

        $this->assertTrue($this->Stomp->connect());
        $this->assertTrue($this->Stomp->isConnected());
    }

    /**
     * Tests Stomp->disconnect()
     */
    public
    function testDisconnect() {
        $this->markTestIncomplete(
            "This test doesn't use mocks, it tries to talk to a STOMP server"
        );
        if (!$this->Stomp->isConnected()) {
            $this->Stomp->connect();
        }
        $this->assertTrue($this->Stomp->isConnected());
        $this->Stomp->disconnect();
        $this->assertFalse($this->Stomp->isConnected());
    }

    /**
     * Tests Stomp->getSessionId()
     */
    public
    function testGetSessionId() {
        $this->markTestIncomplete(
            "This test doesn't use mocks, it tries to talk to a STOMP server"
        );
        if (!$this->Stomp->isConnected()) {
            $this->Stomp->connect();
        }
        $this->assertNotNull($this->Stomp->getSessionId());
    }

    /**
     * Tests Stomp->isConnected()
     */
    public
    function testIsConnected() {
        $this->markTestIncomplete(
            "This test doesn't use mocks, it tries to talk to a STOMP server"
        );
        $this->Stomp->connect();
        $this->assertTrue($this->Stomp->isConnected());
        $this->Stomp->disconnect();
        $this->assertFalse($this->Stomp->isConnected());
    }

    /**
     * Tests Stomp->readFrame()
     */
    public
    function testReadFrame() {
        $this->markTestIncomplete(
            "This test doesn't use mocks, it tries to talk to a STOMP server"
        );
        if (!$this->Stomp->isConnected()) {
            $this->Stomp->connect();
        }
        $this->Stomp->send($this->queue, 'testReadFrame');
        $this->Stomp->subscribe($this->queue);
        $frame = $this->Stomp->readFrame();
        $this->assertTrue($frame instanceof StompFrame);
        $this->assertEquals('testReadFrame', $frame->body, 'Body of test frame does not match sent message');
        $this->Stomp->ack($frame);
        $this->Stomp->unsubscribe($this->queue);
    }

    /**
     * Tests Stomp->send()
     */
    public
    function testSend() {
        $this->markTestIncomplete(
            "This test doesn't use mocks, it tries to talk to a STOMP server"
        );
        if (!$this->Stomp->isConnected()) {
            $this->Stomp->connect();
        }
        $this->assertTrue($this->Stomp->send($this->queue, 'testSend'));
        $this->Stomp->subscribe($this->queue);
        $frame = $this->Stomp->readFrame();
        $this->assertEquals('testSend', $frame->body, 'Body of test frame does not match sent message');
        $this->Stomp->ack($frame);
        $this->Stomp->unsubscribe($this->queue);
    }

    /**
     * Tests Stomp->subscribe()
     */
    public
    function testSubscribe() {
        $this->markTestIncomplete(
            "This test doesn't use mocks, it tries to talk to a STOMP server"
        );
        if (!$this->Stomp->isConnected()) {
            $this->Stomp->connect();
        }
        $this->assertTrue($this->Stomp->subscribe($this->queue));
        $this->Stomp->unsubscribe($this->queue);
    }

    /**
     * Tests Stomp->unsubscribe()
     */
    public
    function testUnsubscribe() {
        $this->markTestIncomplete(
            "This test doesn't use mocks, it tries to talk to a STOMP server"
        );
        if (!$this->Stomp->isConnected()) {
            $this->Stomp->connect();
        }
        $this->Stomp->subscribe($this->queue);
        $this->assertTrue($this->Stomp->unsubscribe($this->queue));
    }
}

