<?php
class AllCraterTest extends CakeTestSuite {
    public static function suite() {
        $suite = new CakeTestSuite('All Crater tests');
        $suite->addTestDirectoryRecursive(TESTS . 'Case');
        return $suite;
    }
}
?>