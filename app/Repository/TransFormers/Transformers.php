<?php namespace App\Repository\TransFormers;
abstract class Transformers {

    public function transformCollection(array $items){
        return array_map([$this, 'transform'], $items);
    }
    public abstract function transform($item);
}
