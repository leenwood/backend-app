<?php

namespace App\AdminBundle\Service\OpenAiService;

class CompetenciesRequestConfigurator
{
    public function __construct(
        public string $definition,
        public string $imagine,
        public string $body,
        public string $outputStyle
    )
    {
    }
}