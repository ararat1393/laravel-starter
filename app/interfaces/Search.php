<?php


namespace App\interfaces;

/**
 * Interface Search
 * @package App\interfaces
 */
interface Search
{
    /**
     * @param array $params
     * @return mixed
     */
    public function search(array $params = []);

}
