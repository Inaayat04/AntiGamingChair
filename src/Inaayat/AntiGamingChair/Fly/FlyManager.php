<?php

namespace Inaayat\AntiGamingChair\Fly;

use Inaayat\AntiGamingChair\Main;
use pocketmine\utils\Config;

class FlyManager {

    private $plugin;

    public function __construct(Main $plugin){
        $this->plugin = $plugin;
        $this->init();
    }

    public function init(){
        $config = new Config($this->plugin->getDataFolder() . "config.yml");
        if($config->get("Fly") === true){
            $this->plugin->getServer()->getPluginManager()->registerEvents(new FlyListener($this->plugin), $this->plugin);
        }
    }
}