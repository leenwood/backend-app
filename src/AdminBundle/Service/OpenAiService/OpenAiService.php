<?php

namespace App\AdminBundle\Service\OpenAiService;

use App\AdminBundle\Repository\OpenAiResponseRepository;
use App\AdminBundle\Service\Settings\MainSettingsService;
use OpenAI;

class OpenAiService
{

    /**
     * @param string $apiKey
     * @param OpenAiResponseRepository $openAIResponseRepository
     * @param CompetenciesRequestConfigurator $competenciesRequestConfigurator
     * @param MainSettingsService $mainSettingsService
     */
    public function __construct(
        private string $apiKey,
        private OpenAIResponseRepository $openAIResponseRepository,
        private readonly CompetenciesRequestConfigurator $competenciesRequestConfigurator,
        private MainSettingsService $mainSettingsService
    )
    {
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->openAIResponseRepository->findAll();
    }

    /**
     * @return CompetenciesRequestConfigurator
     */
    public function getConfigurator(): CompetenciesRequestConfigurator
    {
        return $this->competenciesRequestConfigurator;
    }

    /**
     * @param $entity
     * @return void
     */
    public function save($entity): void
    {
        $this->openAIResponseRepository->save($entity, true);
    }

    /**
     * @param $prompt
     * @return mixed
     */
    public function getAnswerByMessage($prompt): mixed
    {
        try {
            $settings = $this->mainSettingsService->findSettingsById(1);
            if(is_null($settings->getOpenAIApiKey())) {
                $apiKey = $this->apiKey;
            } else {
                $apiKey = $settings->getOpenAIApiKey();
            }
        } catch (\Exception $e) {
            $apiKey = $this->apiKey;
        }



        $client = OpenAI::client($apiKey);

        $competenceDefinition = 'Тебе дано определение слова Профессиональная компетенция: Профессиональная компетенция - это знания, умения и опыт, необходимые для работы в конкретной профессии. Она включает теоретические основы, практическое применение и опыт работы.';
        $competenceDefinition = $this->competenciesRequestConfigurator->definition;

        $prePromptImagine = 'Представь, что ты HR в IT компании.';
        $prePromptImagine = $this->competenciesRequestConfigurator->imagine;

        $prePromptRequest = 'Используя данное тебе определение выдели из приведенного ниже текста набор профессиональных компетенций. Сами профессиональные компетенции должны выглядеть в виде очень-очень коротких тегов для поиска резюме по IT вакансиям.';
        $prePromptRequest = $this->competenciesRequestConfigurator->body;

        $prePromptOutputStyleJSON = 'Ответ выдай в виде JSON где поле competencies содержит вид массива ключевых слов. После нумерованного списка определи профессию, которую можно получить, опирясь на эти профессиональные компетенции. Обозначь найденную профессию в поле JSON profession. Сам текст представлен далее: ';
        $prePromptOutputStyleJSON = $this->competenciesRequestConfigurator->outputStyle;

        $content['prompt'] = $competenceDefinition . ' ' . $prePromptImagine . ' ' . $prePromptRequest . ' ' . $prePromptOutputStyleJSON . ' ' . $prompt;

        $result = $client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $content['prompt']],
            ],
        ]);

        $text = json_decode($result->choices[0]->message->content, true);
        $text = array_merge((array) $text, $content);

        return $text;
    }
}