<?php

class Shinka_Core_Manager_SettingManager extends Shinka_Core_Manager_Manager
{
    private static $table = "settings";

    /**
     * @param Shinka_Core_Entity_Setting|Shinka_Core_Entity_Setting[] $settings
     * @param int $gid
     * @return void
     */
    public static function create($settings, $gid = null)
    {
        global $db;

        foreach (self::toArray($settings) as $ndx => $setting) {
            $setting->gid = $setting->gid ?: $gid;
            $setting->disporder = $setting->disporder ?: $ndx;

            $db->insert_query(self::$table, $setting->toArray());
        }
    }

    /**
     * @param string|string[] $prefixes
     */
    public static function destroy($prefixes)
    {
        global $db;

        foreach (self::toArray($prefixes) as $prefix) {
            $db->delete_query(self::$table, "`name` LIKE '{$prefix}_%'");
        }
    }
}