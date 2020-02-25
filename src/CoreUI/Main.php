<?php
/*
  _____ _          ____            _    _    _           
 |_   _| |__   ___|  _ \ ___  __ _| |  / \  | | _____  __
   | | | '_ \ / _ \ |_) / _ \/ _` | | / _ \ | |/ _ \ \/ /
   | | | | | |  __/  _ <  __/ (_| | |/ ___ \| |  __/>  < 
   |_| |_| |_|\___|_| \_\___|\__,_|_/_/   \_\_|\___/_/\_\
                                                         
*/
namespace CoreUI;

use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\ConsoleCommandSender;

class Main extends PluginBase implements Listener {
	
    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);    
        $this->getLogger()->info(TextFormat::GREEN . "AdminTools Aktiviert");
    }
    public function onDisable() {
        $this->getLogger()->info(TextFormat::RED . "AdminTools Deaktiviert");
    }
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
        switch($cmd->getName()){                    
            case "AdminTool":
                if ($sender->hasPermission("AdminTool.command")){
                     $this->Menu($sender);
                }else{     
                     $sender->sendMessage(TextFormat::RED . "[AdminTools] Du Hast Keine Rechte\ Bist Kein Teammitglied!");
                     return true;
                }     
            break;         
            
         }  
        return true;                         
    }
   
    public function Menu($sender){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, int $data = null) { 
            $result = $data;
            if($result === null){
                return true;
            }             
            switch($result){
                case 0:
            $sender->sendMessage(TextFormat::YELLOW . "[AdminTools] Fly Modus Aktiviert");
            $sender->setAllowFlight(true);
                break;
                case 1:
            $sender->sendMessage(TextFormat::YELLOW . "[AdminTools] Fly Modus Deaktiviert");
            $sender->setAllowFlight(false);
                break;				
                case 2:
            $sender->setHealth(20);
            $sender->sendMessage(TextFormat::YELLOW . "[AdminTools] Du Wurdest Geheilt");
                break;  
                case 3:
            $sender->setFood(20);
            $sender->sendMessage(TextFormat::YELLOW . "[AdminTools] Du hast Nun Kein Hunger Mehr");
                break;  
                case 4:
            $sender->setGameMode(1);
            $sender->sendMessage(TextFormat::YELLOW . "[AdminTools] Du Bist Nun im §9Gamemode 1");
                break;
                case 5:
            $sender->setGameMode(2);
            $sender->sendMessage(TextFormat::YELLOW . "[AdminTools] Du Bist Nun im§9Gamemode 2");
                break;
                case 6:
            $sender->setGameMode(3);
            $sender->sendMessage(TextFormat::YELLOW . "[AdminTools] Du Bist Nun im§9Gamemode 3");
                break;			
		case 7:
            $sender->addEffect(new EffectInstance(Effect::getEffect(Effect::INVISIBILITY), 99999999, 0, false));
            $sender->addTitle(TextFormat::YELLOW . "[AdminTools] Vanish Aktiviert");
                break;		    
		case 8:
            $sender->removeEffect(Effect::INVISIBILITY);
            $sender->addTitle(TextFormat::YELLOW . "Vanish Enabled");
		break;	    
		case 9:
            $command = "pl" ;
            $this->getServer()->getCommandMap()->dispatch($sender, $command);
		break;	     
                case 10:
            $sender->addTitle(TextFormat::YELLOW . ("§4AdminTools");
                break;				
            }
            
            
            });
            $form->setTitle("§7-= §l§eAdminTools§r §7=-");
			$form->setContent("§o§7Plugin unprogrammiert von Crow Balde");
                        $form->addButton("§l§eFly An\n§r§o§7Fly Aktivieren");
			$form->addButton("§l§eFly Aus\n§r§o§7Fly Deaktivieren");
			$form->addButton("§l§6Healen\n§r§o§7Heile Dich");
			$form->addButton("§l§6Hunger\n§r§o§7Hunger Auffullen");
			$form->addButton("§l§bGamemode\n§r§o§7Du Bist Nun Im Gamemode 1");
			$form->addButton("§l§bGamemode\n§r§o§7Du Bist Nu ln Im Gamemode 2");
			$form->addButton("§l§bGamemode\n§r§o§7Du Bist Nun Gamemode 1");
	     		$form->addButton("§l§bVanish An\n§r§o§7Du Bist Nun Im Vanish");
	    		$form->addButton("§l§bVanish An\n§r§o§7Du Bist Nicht Mehr Im Vanish");
	    		$form->addButton("§l§5Plugins\n§r§o§7Sehe Alle Plugins Auf Denn Server");
			
            $form->addButton("§l§6[AdminTools] Menu Schlissen");
            $form->sendToPlayer($sender);
            return $form;                                            
    }
 
                                                                                                                                                                                                   
}
