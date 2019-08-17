<?php
/*
   _____  .__                .___  __          ____  ________
  /  _  \ |  |   ____ ___  __|   |/  |________/_   |/  _____/
 /  /_\  \|  | _/ __ \\  \/  /   \   __\___   /|   /   __  \ 
/    |    \  |_\  ___/ >    <|   ||  |  /    / |   \  |__\  \
\____|__  /____/\___  >__/\_ \___||__| /_____ \|___|\_____  /
        \/          \/      \/               \/           \/ 
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
        $this->getLogger()->info(TextFormat::GREEN . "CoreUI Enable");
    }
    public function onDisable() {
        $this->getLogger()->info(TextFormat::RED . "CoreUI Disable");
    }
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
        switch($cmd->getName()){                    
            case "coreui":
                if ($sender->hasPermission("coreui.command")){
                     $this->Menu($sender);
                }else{     
                     $sender->sendMessage(TextFormat::RED . "You dont have permission!");
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
            $sender->sendMessage(TextFormat::YELLOW . "Enabled flight mode!");
            $sender->setAllowFlight(true);
                break;
                case 1:
            $sender->sendMessage(TextFormat::YELLOW . "Disabled flight mode!");
            $sender->setAllowFlight(false);
                break;				
                case 2:
            $sender->setHealth(20);
            $sender->sendMessage(TextFormat::YELLOW . "Your has ben Healed");
                break;  
                case 3:
            $sender->setFood(20);
            $sender->sendMessage(TextFormat::YELLOW . "You have been feed!");
                break;  
                case 4:
            $sender->setGameMode(1);
            $sender->sendMessage(TextFormat::YELLOW . "GameMode changed to §9Creative");
                break;
                case 5:
            $sender->setGameMode(2);
            $sender->sendMessage(TextFormat::YELLOW . "GameMode changed to §9Adventure");
                break;
                case 6:
            $sender->setGameMode(3);
            $sender->sendMessage(TextFormat::YELLOW . "GameMode changed to §9Spectator");
                break;				
                case 7:
            $sender->sendMessage(TextFormat::YELLOW . "CoreUI Closed");
                break;				
            }
            
            
            });
            $form->setTitle("§7-= §l§eCoreUI§r §7=-");
			$form->setContent("§o§7MiniCoreUI By AlexItz16");
                        $form->addButton("§l§eFly on\n§r§o§7Tap to Select");
			$form->addButton("§l§eFly off\n§r§o§7Tap to Select");
			$form->addButton("§l§eHeal\n§r§o§7Tap to Select");
			$form->addButton("§l§eFeed\n§r§o§7Tap to Select");
			$form->addButton("§l§eCreative\n§r§o§7Tap to Select");
			$form->addButton("§l§eAdventure\n§r§o§7Tap to Select");
			$form->addButton("§l§eSpectator\n§r§o§7Tap to Select");
			
            $form->addButton("§l§6CLOSE");
            $form->sendToPlayer($sender);
            return $form;                                            
    }
 
                                                                                                                                                                                                                                                                                          
}
