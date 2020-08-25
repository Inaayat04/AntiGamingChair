<?php

namespace Inaayat\AntiGamingChair\Reach;

use Inaayat\AntiGamingChair\Main;
use Inaayat\AntiGamingChair\Utils;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\utils\Config;

class ReachListener implements Listener
{

    private $plugin;

    public function __construct(Main $plugin)
    {
        $this->plugin = $plugin;
    }

    public function onDamage(EntityDamageEvent $event)
    {
        if ($event instanceof EntityDamageByEntityEvent) {
            $attacker = $event->getDamager();
            $victim = $event->getEntity();
            $config = new Config($this->plugin->getDataFolder() . "config.yml");
            $meter = $config->get("ReachDistance");
            $reason = $config->get("ReachKickMessage");
            $distance = $attacker->distance($victim->getPosition());
            $reason = str_replace("{distance}", $distance, $reason);
            if ($distance > $meter && $attacker->getLevel()->getName() == $victim->getLevel()->getName()) {
                if ($attacker instanceof Player) {
                    if ($attacker->getInventory()->getItemInHand()->getId() == Item::BOW) {
                        return;
                    } else {
                            if($config->get("ReachBan") === true){
                                $attacker->setBanned(true);
                            }else{
                                if($config->get("ReachKick") === true){
                                    $attacker->kick(Utils::PREFIX . "\n" . $reason, "false");
                                }
                        }
                    }
                }
            }
        }
    }
}