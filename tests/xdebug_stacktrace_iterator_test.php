<?php
/**
 *
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 * 
 *   http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 *
 * @copyright Copyright (C) 2005-2010 eZ Systems AS. All rights reserved.
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @version //autogentag//
 * @filesource
 * @package Debug
 * @subpackage Tests
 */

require_once 'classes/debug_test_dump_extended_object.php';

/**
 * Test suite for the ezcDebugOptions class.
 *
 * @package Debug
 * @subpackage Tests
 */
class ezcDebugXdebugStacktraceIteratorTest extends ezcTestCase
{
    private function getStackTrace( $foo, $bar = null )
    {
        return $this->getDeeperStackTrace( $foo, $bar );
    }

    private function getDeeperStackTrace( $foo, $bar )
    {
        return xdebug_get_function_stack();
    }

    public static function suite()
    {
        return new PHPUnit_Framework_TestSuite( __CLASS__ );
    }

    protected function setup()
    {
        if ( !extension_loaded( 'xdebug' ) )
        {
            $this->markTestSkipped( 'Only run when Xdebug is available.' );
        }
    }

    public function testIterateTraceCollectParams0()
    {
        // Backup old setting and set test setting
        $oldCollectParams = ini_get( 'xdebug.collect_params' );
        ini_set( 'xdebug.collect_params', 0 );

        $stackTrace = $this->getStackTrace( 'some string', array( true, 23, null ) );

        // Restore old setting
        ini_set( 'xdebug.collect_params', $oldCollectParams );

        array_splice( $stackTrace, 0, -3 );

        $opts = new ezcDebugOptions();
        $itr = new ezcDebugXdebugStacktraceIterator(
            $stackTrace,
            0,
            $opts
        );

        $res = require 'data/xdebug_stacktrace_iterator_test__' . __FUNCTION__ . '.php';
        foreach ( $itr as $key => $value )
        {
            // Remove 'file' keys to not store system dependant pathes.
            $this->assertTrue(
                isset( $value['file'] )
            );
            unset( $value['file'] );

            $this->assertEquals(
                $res[$key],
                $value,
                "Incorrect stack element $key."
            );
        }
    }

    public function testIterateTraceCollectParams123()
    {
        // Backup old setting and set test setting
        $oldCollectParams = ini_get( 'xdebug.collect_params' );
        // 1, 2 and 3 should be the same. Info by DR.
        ini_set( 'xdebug.collect_params', 1 );

        $stackTrace = $this->getStackTrace( 'some string', array( true, 23, null ) );

        // Restore old setting
        ini_set( 'xdebug.collect_params', $oldCollectParams );

        array_splice( $stackTrace, 0, -3 );

        $opts = new ezcDebugOptions();
        $itr = new ezcDebugXdebugStacktraceIterator(
            $stackTrace,
            0,
            $opts
        );

        $res = require 'data/xdebug_stacktrace_iterator_test__' . __FUNCTION__ . '.php';
        foreach ( $itr as $key => $value )
        {
            // Remove 'file' keys to not store system dependant pathes.
            $this->assertTrue(
                isset( $value['file'] )
            );
            unset( $value['file'] );

            $this->assertEquals(
                $res[$key],
                $value,
                "Incorrect stack element $key."
            );
        }
    }

    public function testIterateTraceCollectParams4()
    {
        // Backup old setting and set test setting
        $oldCollectParams = ini_get( 'xdebug.collect_params' );
        ini_set( 'xdebug.collect_params', 4 );

        $stackTrace = $this->getStackTrace( 'some string', array( true, 23, null ) );

        // Restore old setting
        ini_set( 'xdebug.collect_params', $oldCollectParams );

        array_splice( $stackTrace, 0, -3 );

        $opts = new ezcDebugOptions();
        $itr = new ezcDebugXdebugStacktraceIterator(
            $stackTrace,
            0,
            $opts
        );

        $res = require 'data/xdebug_stacktrace_iterator_test__' . __FUNCTION__ . '.php';
        foreach ( $itr as $key => $value )
        {
            // Remove 'file' keys to not store system dependant pathes.
            $this->assertTrue(
                isset( $value['file'] )
            );
            unset( $value['file'] );

            $this->assertEquals(
                $res[$key],
                $value,
                "Incorrect stack element $key."
            );
        }
    }

    public function testCountTrace()
    {
        $opts = new ezcDebugOptions();
        $itr = new ezcDebugXdebugStacktraceIterator(
            $this->getStackTrace( 'some string', array( true, 23, null ) ),
            0,
            $opts
        );
        
        $this->assertEquals(
            5,
            count( $itr )
        );
    }
    
    public function testArrayAccess()
    {
        $opts = new ezcDebugOptions();
        $itr = new ezcDebugXdebugStacktraceIterator(
            $this->getStackTrace( 'some string', array( true, 23, null ) ),
            0,
            $opts
        );

        $this->assertTrue(
            isset( $itr[0] )
        );

        $this->assertTrue(
            is_array( $itr[0] )
        );

        try
        {
            $itr[0] = true;
            $this->fail( 'Exception not throwen on not permitted array access.' );
        }
        catch ( ezcDebugOperationNotPermittedException $e ) {}

        try
        {
            unset( $itr[0] );
            $this->fail( 'Exception not throwen on not permitted array access.' );
        }
        catch ( ezcDebugOperationNotPermittedException $e ) {}
        
        try
        {
            echo $itr['foo'];
            $this->fail( 'ezcBaseValueException not throwen on array get access to non-existent key.' );
        }
        catch ( ezcBaseValueException $e ) {}

    }
}

?>
