<?php
/**
 * Created by PhpStorm.
 * User: Stephen
 * Date: 19/04/2017
 * Time: 13:15
 */

namespace AppBundle;


class BibRepository
{
    private $bibs = [];

    public function __construct()
    {
        $s1 = new Bib(1, 'matt');
        $s2 = new Bib(2, 'joelle');
        $s3 = new Bib(3, 'jim');
        $this->bibs[] = $s1;
        $this->bibs[] = $s2;
        $this->bibs[] = $s3;
    }
    public function getAll()
    {
        return $this->bibs;
    }
}