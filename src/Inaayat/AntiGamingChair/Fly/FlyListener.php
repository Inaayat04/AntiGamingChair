<?php

namespace Inaayat\AntiGamingChair\Fly;

use Inaayat\AntiGamingChair\Main;
use Inaayat\AntiGamingChair\Utils;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\utils\Config;

class FlyListener implements Listener
{

    private $plugin;

    public function __construct(Main $plugin)
    {
        $this->plugin = $plugin;
    }

    public function onMove(PlayerMoveEvent $event){
        $player = $event->getPlayer();
        $config = new Config($this->plugin->getDataFolder() . "config.yml");
        $reason = $config->get("FlyKickMessage");
        if ($player->getAllowFlight() === true){
            return;
        }else{
        if ($player->getAllowFlight() === false){
            if($player->isFlying()) {
                if($config->get("FlyBan") === true){
                    $player->setBanned(true);
                }else {
                    if($config->get("FlyKick") === true) {
                        $player->kick(Utils::PREFIX . "\n" . $reason);
                    }
                }
               }
            }
        }
    }
}