<?php


namespace App\Service;


class Slugify
{
    public function generate(string $input) : string {
        $input = strtolower($input);
        /*
         * Remplaçement des characters spéciaux par des characters normaux.
           ['.', '!', '?', '\'']
        '-'

        */

        $special = ['à', 'â', 'ä', 'ç', 'é', 'è', 'ê', 'ë', 'î', 'ï', 'ô', 'ö', '.', '!', '?', '\''];
        $replacement = ['a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'o', 'o', ''];
        $input = str_replace($special, $replacement, $input);

        $input = trim($input);

        $input = preg_replace('!\s+!', '-', $input);

        return $input;
    }
}