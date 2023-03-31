<?php

namespace App\Form\Helpers;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\HttpFoundation\File\File;

class StringToFileTransformer implements DataTransformerInterface
{
    public function transform($value): string
    {
        return '';
    }

    public function reverseTransform($value): ?File
    {
        if (empty($value)) {
            return null;
        }

        return new File($value);
    }
}
