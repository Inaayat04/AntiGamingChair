<?php

namespace Inaayat\AntiGamingChair\Autoclicker;

use Inaayat\AntiGamingChair\Main;
use Inaayat\AntiGamingChair\Utils;
use pocketmine\scheduler\Task;
use pocketmine\utils\Config;

class AutoclickTask extends Task
{

    private $plugin;

    public function __construct(Main $plugin){
        $this->plugin = $plugin;
    }

    public function onRun(int $currentTick){
        $config = new Config($this->plugin->getDataFolder() . "config.yml");
        $maxcps = $config->get("AutoclickerMax");
        $reason = $config->get("AutoclickerKickMessage");
        foreach($this->plugin->getServer()->getOnlinePlayers() as $player){
            $reason = str_replace("{cps}", $this->plugin->getAutoclickerManager()->getClicks($player), $reason);
            if($this->plugin->getAutoclickerManager()->getClicks($player) > $maxcps){
                if($config->get("AutoclickerBan") === true){
                    $player->setBanned(true);
                }else{
                    if($config->get("AutoclickerKick") === true){
                        $player->kick(Utils::PREFIX . "\n" . $reason, "false");
                    }
                }
            }
        }
    }
}