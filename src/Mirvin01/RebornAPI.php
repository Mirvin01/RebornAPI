<?php

declare(strict_types = 1);

namespace Mirvin01;



use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use pocketmine\network\mcpe\protocol\PlaySoundPacket;

use Mirvin01\RebornCommand;
use Mirvin01\sound\SoundManager;

class RebornAPI extends PluginBase{

    public static RebornAPI $instance;

    public static function getInstance() {
        return self::$instance;
    }

    public function onEnable(): void{
        self::$instance = $this;

        $this->getLogger()->info(TextFormat::GREEN . "on");
    }

    public function sendSound(string $soundType, array $players = null){
        if($players === null){
            $players = $this->getServer()->getOnlinePlayers();
        }

        foreach($players as $player){
            $packet = PlaySoundPacket::create(
                $soundType,
                $player->getPosition()->x,
                $player->getPosition()->y,
                $player->getPosition()->z,
                1.0, 1.0
            );
            $player->getNetworkSession()->sendDataPacket($packet);
        }
    }
}