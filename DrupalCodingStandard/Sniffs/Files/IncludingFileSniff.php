<?php
/**
 * DrupalCodingStandard_Sniffs_Files_IncludingFileSniff.
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @author    Marc McIntyre <mmcintyre@squiz.net>
 * @copyright 2006-2011 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   http://matrix.squiz.net/developer/tools/php_cs/licence BSD Licence
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */

/**
 * DrupalCodingStandard_Sniffs_Files_IncludingFileSniff.
 *
 * Checks that brackets do not surround the include/require statements. Largely
 * copied from PEAR_Sniffs_Files_IncludingFileSniff.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @author    Marc McIntyre <mmcintyre@squiz.net>
 * @copyright 2006-2011 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   http://matrix.squiz.net/developer/tools/php_cs/licence BSD Licence
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
class DrupalCodingStandard_Sniffs_Files_IncludingFileSniff implements PHP_CodeSniffer_Sniff
{

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return array(
                T_INCLUDE_ONCE,
                T_REQUIRE_ONCE,
                T_REQUIRE,
                T_INCLUDE,
               );

    }//end register()


    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token in the
     *                                        stack passed in $tokens.
     *
     * @return void
     */
    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        $nextToken = $phpcsFile->findNext(PHP_CodeSniffer_Tokens::$emptyTokens, ($stackPtr + 1), null, true);
        if ($tokens[$nextToken]['code'] === T_OPEN_PARENTHESIS) {
            $error = '"%s" is a statement not a function; no parentheses are required';
            $data  = array($tokens[$stackPtr]['content']);
            $phpcsFile->addError($error, $stackPtr, 'BracketsNotRequired', $data);
        }

    }//end process()


}//end class

?>
