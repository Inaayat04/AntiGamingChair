<?php

namespace Inaayat\AntiGamingChair\Autoclicker;

use Inaayat\AntiGamingChair\Main;
use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\network\mcpe\protocol\InventoryTransactionPacket;

class AutoclickListener implements Listener
{

    private $plugin;

    public function __construct(Main $plugin)
    {
        $this->plugin = $plugin;
    }

    public function onDataPacketReceive(DataPacketReceiveEvent $event){
        $player = $event->getPlayer();
        $packet = $event->getPacket();
        if ($packet instanceof InventoryTransactionPacket) {
            $transactionType = $packet->transactionType;
            if ($transactionType === InventoryTransactionPacket::TYPE_USE_ITEM || $transactionType === InventoryTransactionPacket::TYPE_USE_ITEM_ON_ENTITY) {
                $this->plugin->getAutoclickerManager()->addClick($player);
            }
        }
    }
}