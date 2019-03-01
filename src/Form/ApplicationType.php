<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;

class ApplicationType extends AbstractType {
    /**
     * Permet d'avoir la configuration d'un champ
     *
     * @param [type] $label
     * @param [type] $placeholder
     * @return array
     */
    protected function getconfiguration($label, $placeholder) {
        return [
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
            ];
    }
} 