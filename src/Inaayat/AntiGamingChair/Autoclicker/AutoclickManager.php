<?php

namespace Inaayat\AntiGamingChair\Autoclicker;

use Inaayat\AntiGamingChair\Main;
use pocketmine\Player;
use pocketmine\utils\Config;

class AutoclickManager {

    private $plugin;
    private $clicks = [];

    public function __construct(Main $plugin){
        $this->plugin = $plugin;
        $this->init();
    }

    public function init(){
        $config = new Config($this->plugin->getDataFolder() . "config.yml");
        if($config->get("Autoclicker") === true){
            $this->plugin->getServer()->getPluginManager()->registerEvents(new AutoclickListener($this->plugin), $this->plugin);
            $this->plugin->getScheduler()->scheduleRepeatingTask(new AutoclickTask($this->plugin), 1 * 20);
        }
    }

    public function getClicks(Player $player): int{
        if(!isset($this->clicks[$player->getLowerCaseName()])){
            return 0;
        }
        $time = $this->clicks[$player->getLowerCaseName()][0];
        $clicks = $this->clicks[$player->getLowerCaseName()][1];
        if($time !== time()){
            unset($this->clicks[$player->getLowerCaseName()]);
            return 0;
        }
        return $clicks;
    }

    public function addClick(Player $player): void{
        if(!isset($this->clicks[$player->getLowerCaseName()])){
            $this->clicks[$player->getLowerCaseName()] = [time(), 0];
        }
        $time = $this->clicks[$player->getLowerCaseName()][0];
        $clicks = $this->clicks[$player->getLowerCaseName()][1];
        if($time !== time()){
            $time = time();
            $clicks = 0;
        }
        $clicks++;
        $this->clicks[$player->getLowerCaseName()] = [$time, $clicks];
    }

}