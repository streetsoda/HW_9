<?php

require_once('separateNode.php');

class LinkedList
{
    public $head = null;

    public function append($value)
    {
        $newElement = new SeparateNode();
        $newElement->setValue($value);
        if (!empty($this->head)) {
            $lastElement = $this->head;
            while (!empty($lastElement->getNext())) {
                $lastElement = $lastElement->getNext();
            }
            $lastElement->setNext($newElement);
            $newElement->setPrevious($lastElement);
        } else {
            $this->head = $newElement;
        }
    }
    public function prepend($value)
    {
        $obj = new SeparateNode();
        $obj->setValue($value);
        $headObj = $this->head;
        $obj->setNext($headObj);
        $this->head = $obj;
    }
    public function deleteFromHead()
    {
        if (empty($this->head)) {
            throw new RuntimeException("Notice");
        }
        $this->head = $this->head->getNext();
    }
    public function deleteFromEnd()
    {
        if (!empty($this->head)) {
            $lastElement = $this->head;
            $prev = null;
            while (!empty($lastElement->getNext())) {
                $prev = $lastElement;
                $lastElement = $lastElement->getNext();
            }
            $prev->setNext(null);
        } else {
            throw new RuntimeException('Notice');
        }
    }
    public function insertAfterAt($value, $atVal)
    {
        $newElement = new SeparateNode();
        $newElement->setValue($value);
        $at = $this->search($atVal);
        $next = $at->getNext();
        $next->setPrevious($newElement);
        $newElement->setPrevious($at);
    }
    public function deleteAt($atVal)
    {
        $at = $this->search($atVal);
        $prev = $at->getPrevious();
        $next = $at->getNext();
        $prev->setNext($next);
        $next->setPrevious($prev);
    }
    public function search($value)
    {
        $lastElement = $this->head;
        while (!($lastElement->getValue() == $value)) {
            if (!empty($lastElement->getNext())) {
                $lastElement = $lastElement->getNext();
            }
        }
        return $lastElement;
    }
    public function insertBeforeAt($value, $atVal)
    {
        $newElement = new SeparateNode();
        $newElement->setValue($value);
        $at = $this->search($atVal);
        $prev = $at->getPrevious();
        $prev->setNext($newElement);
        $newElement->setNext($at);
    }
}