<?php

return array (
  0 => 
  array (
    'line' => 23,
    'function' => 'getDeeperStackTrace',
    'class' => 'ezcDebugPhpStacktraceIteratorTest',
    'params' => 
    array (
      0 => '\'some string\'',
      1 => 'array (0 => TRUE, 1 => 23, 2 => NULL)',
    ),
  ),
  1 => 
  array (
    'line' => 40,
    'function' => 'getStackTrace',
    'class' => 'ezcDebugPhpStacktraceIteratorTest',
    'params' => 
    array (
      0 => '\'some string\'',
      1 => 'array (0 => TRUE, 1 => 23, 2 => NULL)',
    ),
  ),
  2 => 
  array (
    'function' => 'testIterateTrace',
    'class' => 'ezcDebugPhpStacktraceIteratorTest',
    'params' => 
    array (
    ),
  ),
  3 => 
  array (
    'line' => 449,
    'function' => 'invoke',
    'class' => 'ReflectionMethod',
    'params' => 
    array (
      0 => 'class ezcDebugPhpStacktraceIteratorTest { protected $backupGlobals = TRUE; protected $data = array (); protected $dataName = \'\'; protected $expectedException = NULL; protected $expectedExceptionMessage = \'\'; protected $sharedFixture = NULL; protected $name = \'testIterateTrace\'; protected $exception = NULL; protected $iniSettings = array (); protected $locale = array (); protected $mockObjects = array () }',
    ),
  ),
  4 => 
  array (
    'line' => 376,
    'function' => 'runTest',
    'class' => 'PHPUnit_Framework_TestCase',
    'params' => 
    array (
    ),
  ),
);

?>