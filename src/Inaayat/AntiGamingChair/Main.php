<?php

namespace Inaayat\AntiGamingChair;

use Inaayat\AntiGamingChair\Autoclicker\AutoclickManager;
use Inaayat\AntiGamingChair\Fly\FlyManager;
use Inaayat\AntiGamingChair\Reach\ReachManager;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase {

    /** @var ReachManager */
    private $reachManager;

    /** @var FlyManager */
    private $flyManager;

    /** @var AutoclickManager */
    private $autoclickerManager;

    public function onEnable(){
        @mkdir($this->getDataFolder());
        $this->saveResource("config.yml");
        $this->reachManager = new ReachManager($this);
        $this->flyManager = new FlyManager($this);
        $this->autoclickerManager = new AutoclickManager($this);
    }

    public function getReachManager(){
        return $this->reachManager;
    }

    public function getFlyManager(){
        return $this->flyManager;
    }

    public function getAutoclickerManager(){
        return $this->autoclickerManager;
    }
}