<?php

namespace App\AdminBundle\Service\OpenAiService;

use App\Repository\OpenAIResponseRepository;
use OpenAI;

class OpenAiService
{

    public function __construct(
        private string $apiKey,
        private OpenAIResponseRepository $openAIResponseRepository
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

    public function getAnswerByMessage($prompt): mixed
    {
        $client = OpenAI::client($this->apiKey);

        $competenceDefinition = 'Тебе дано определение слова Профессиональная компетенция: Профессиональная компетенция - это знания, умения и опыт, необходимые для работы в конкретной профессии. Она включает теоретические основы, практическое применение и опыт работы.';

        $prePromptImagine = 'Представь, что ты HR в IT компании.';

        $prePromptRequest = 'Используя данное тебе определение выдели из приведенного ниже текста набор профессиональных компетенций. Сами профессиональные компетенции должны выглядеть в виде очень-очень коротких тегов для поиска резюме по IT вакансиям.';

        $prePromptOutputStyleJSON = 'Ответ выдай в виде JSON где поле competencies содержит вид массива ключевых слов. После нумерованного списка определи профессию, которую можно получить, опирясь на эти профессиональные компетенции. Обозначь найденную профессию в поле JSON profession. Сам текст представлен далее: ';

        $content['prompt'] = $competenceDefinition . ' ' . $prePromptImagine . ' ' . $prePromptRequest . ' ' . $prePromptOutputStyleJSON . ' ' . $prompt;

        $result = $client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $content['prompt']],
            ],
        ]);

        $text = json_decode($result->choices[0]->message->content, true);
        $text = array_merge((array) $text, $content);

        dd($text);

        return $text;
    }
}