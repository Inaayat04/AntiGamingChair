<?php

namespace Inaayat\AntiGamingChair\Reach;

use Inaayat\AntiGamingChair\Main;
use pocketmine\utils\Config;

class ReachManager {

    private $plugin;

    public function __construct(Main $plugin){
        $this->plugin = $plugin;
        $this->init();
    }

    public function init(){
        $config = new Config($this->plugin->getDataFolder() . "config.yml");
        if($config->get("Reach") === true){
            $this->plugin->getServer()->getPluginManager()->registerEvents(new ReachListener($this->plugin), $this->plugin);
        }
    }
}