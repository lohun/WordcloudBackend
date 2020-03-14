<?php

namespace App\Tools;

class WordCounter
{
    private $string;

    public function __construct($string = null)
    {
        $this->load($string);
    }

    public function load($string)
    {
        $this->string = $string;
    }

    public function explodeStringToArray()
    {
        $string = $this->normalizeString();
        // $regex = /\/b[0-9\p{L}]+\([0-9]+\)?\/b/;
        $string = preg_match_all('/[0-9a-zA-Z]+\([0-9]+\)|[0-9a-zA-Z]+/', $string, $words);
        return $words[0];
    }

    public function normalizeString()
    {
        $string = $this->string;
        $string = preg_replace('/<script[^>]*?>.*?<\/script>/is', "", $string);
        $string = strip_tags($string);
        $string = mb_strtolower($string, 'UTF-8');
        return $string;
    }

    public function countEachWord()
    {
        $words = [];

        foreach ($this->explodeStringToArray() as $word_item) {

            $founded = false;

            foreach ($words as $key => $word) {
                if ($word->text == $word_item) {
                    $founded = true;
                    $words[$key]->value += 5;
                break;
                }
            }

            if ($founded && preg_match("/[0-9a-zA-Z]+\([0-9]+\)/", $word_item)) {
                preg_match("/\([0-9]+\)/", $word->word, $matches);
                $number =(int) $matches[0];
                $value = preg_replace("/\([0-9]+\)/", "", $word->word);
                $result = (object) ['text'=>$value, 'value'=>$number];
                array_push($words, $result);
            }
            if (! $founded) {
                if (preg_match("/\([0-9]+\)/", $word_item)) {
                    preg_match("/\d+/", $word_item, $matches);
                    $number =(int)  $matches[0];
                    $value = preg_replace("/\([0-9]+\)/", "", $word_item);
                    $words[] = (object) ['text'=>$value, 'value'=>$number];
                }else{
                    $words[] = (object) ['text' => $word_item, 'value' => 10];
                }
            }

        }

        return $words;
    }
}
