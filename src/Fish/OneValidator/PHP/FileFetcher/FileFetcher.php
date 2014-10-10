<?php
/**
 * Created by PhpStorm.
 * User: matanya
 * Date: 10/2/14
 * Time: 8:19 PM
 */

namespace Fish\OneValidator\PHP\FileFetcher;

use Fish\OneValidator\PHP\FileFetcher\Exceptions\InvalidFileFormatException;
use Fish\OneValidator\PHP\FileFetcher\FileValidator;

class FileFetcher {

    /**
     * @var FileValidator
     */
    protected $validator;

    /**
     * @var
     */
    protected $file;

    /**
     * @param $file
     */
    public function __construct($file) {

        $this->file =  preg_replace('/\/\//',"/",$file);

        $this->validator = new FileValidator();
    }

    /**
     * @return bool|string
     * @throws Exceptions\InvalidFileFormatException
     */
    public function fetch() {

     $fileContents = $this->getFileContents();

     if (!$this->validator->hasValidExtension($this->file) ||
         !$this->validator->hasOpeningPHPTag($fileContents))
        throw new InvalidFileFormatException;

        return $fileContents;

    }

    /**
     * @return bool|string
     */
    private function getFileContents() {

        if (!file_exists($this->file)) return false;

           $file = file_get_contents($this->file);

        return $file;
    }


} 