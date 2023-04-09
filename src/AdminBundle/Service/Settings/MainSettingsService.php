<?php

namespace App\AdminBundle\Service\Settings;

use App\AdminBundle\Entity\Settings;
use App\AdminBundle\Repository\SettingsRepository;

class MainSettingsService
{
    /**
     * @param SettingsRepository $settingsRepository
     */
    public function __construct(
        private SettingsRepository $settingsRepository
    )
    {
    }

    /**
     * @param Settings $settings
     * @return void
     */
    public function saveSettings(Settings $settings)
    {
        $this->settingsRepository->save($settings, true);
    }


    /**
     * Method return empty class if id not exists in db
     *
     * @param int $id
     * @return Settings
     */
    public function findSettingsById(int $id): Settings
    {
        $settings = $this->settingsRepository->findOneBy(['id' => $id]);
        if(is_null($settings) || empty($settings))
        {
            return new Settings();
        }
        return $settings;
    }


}