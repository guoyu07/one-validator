<?php
/**
 * Created by PhpStorm.
 * User: matanya
 * Date: 10/2/14
 * Time: 9:32 PM
 */

namespace Fish\OneValidator\PHP\FileFetcher;


class FileValidator {

    /**
     * @return bool
     */
    public function hasValidExtension($fileName) {

        $ext = pathinfo($fileName, PATHINFO_EXTENSION);

        return $ext=='php';
    }

    /**
     * @return bool
     */
    public function hasOpeningPHPTag($fileContent) {


        $hasPhpTag = preg_match("/\<\?php/", $fileContent);

        return $hasPhpTag;
    }

} 