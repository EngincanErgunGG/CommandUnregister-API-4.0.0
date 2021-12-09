<?php

namespace KurSkyTR;

use pocketmine\{
    plugin\PluginBase,
    utils\Config,
    utils\MainLogger as M
};

/**
* Class CommandUnregister
* @package KurSkyTR
*/
class CommandUnregister extends PluginBase
{
    
    /** @var static */
    public static $api = null;
    
    /** @var \pocketmine\utils\Config */
    public static $config;
    
    /** @var integer $count */
    public static $count;
    
    function onEnable(): void
    {
        self::$api = $this;
        self::$config = new Config($this->getDataFolder() . "commands.yml", Config::YAML, [
            "Commands" => []
        ]);
        self::$count = 0;
        $cmdMap = $this->getServer()->getCommandMap();
        if (self::$config->get("Commands") === [])
        {
            $this->getLogger()->info("A not have unregistered command.");
            return;
        }
        foreach (self::$config->get("Commands") as $command)
        {
            if ($cmdMap->getCommand($command) != null)
            {
                $cmdMap->unregister($cmdMap->getCommand($command));
                self::$count++;
            }else{
                $this->getLogger()->error("Command \"" . $command . "\" not found in the server.");
            }
        }
        $this->getLogger()->info(self::$count > 0 ? "Total " . self::$count . " command unregistered." : "A not have unregistered command.");
    }
    
    public static function getAPI(): ?self
    {
        return self::$api;
    }
    
    public static function addUnregisterCommandList(string $commandname = ""): void
    {
        if ($commandname === "") return;
        $list = self::$config->get("Commands");
        $list[] = $commandname;
        self::$config->set("Commands", $list);
        self::$config->save();
    }
    
    public static function removeUnregisterCommandList(string $commandname = ""): void
    {
        if ($commandname === "") return;
        $list = self::$config->get("Commands");
        if ($list === []) return;
        if (in_array($commandname, $list))
        {
            $value = array_search($commandname, $list);
            unset($list[$value]);
            self::$config->set("Commands", $list);
            self::$config->save();
        }else{
            self::$api->getLogger()->info("This command is not found command list.");
        }
    }
}
