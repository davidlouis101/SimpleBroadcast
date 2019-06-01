<?php

declare(strict_types=1);

namespace rafmex;

use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\Config;

class Main extends PluginBase{
	
	public function onEnable(){
		$this->getLogger()->info("|---[Broadcast]---|");
		$this->getLogger()->info("----by-rafmexhd----");
		$this->getLogger()->info("----Version-1.0----");
		$this->getLogger()->info("--Edit->config.yml-");
		$this->saveResource("config.yml");
	}
	
	public function onDisable(){
		$this->getLogger()->info("|---[Broadcast]---|");
		$this->getLogger()->info("----by-rafmexhd----");
		$this->getLogger()->info("----Version-1.0----");
		$this->getLogger()->info("--Save->config.yml-");
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool{
		switch($cmd->getName()){
			case "broadcast":
			 $cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML);
			 $noperm = $cfg->get("noperm");
			 $succes = $cfg->get("succes");
			 $format = $cfg->get("format");
			 $name = $sender->getName();
			 $msg = implode(" ",$args);
			 if($sender->hasPermission("bcast.use")){
			 	$format = str_replace("{sender}", $name, $format);
			 	$format = str_replace("{msg}", $msg, $format);
			 	
			 	$sender->sendMessage($succes);
			 	$this->getServer()->broadcastMessage($format);
			 }else{
			 	$sender->sendMessage($noperm);
			 }
		}
		return true;
	}
}
