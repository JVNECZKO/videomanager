<?php
if (!defined('_PS_VERSION_')) {
    exit;
}

class VideoManager extends Module
{
    public function __construct()
    {
        $this->name = 'videomanager';
        $this->tab = 'administration';
        $this->version = '1.0.0';
        $this->author = 'Your Name';
        $this->need_instance = 0;
        parent::__construct();

        $this->displayName = $this->l('Video Manager');
        $this->description = $this->l('Module to manage and search videos.');
    }

    public function install()
    {
        return parent::install() && $this->createTables() && $this->registerTab();
    }

    public function uninstall()
    {
        return parent::uninstall() && $this->deleteTables() && $this->unregisterTab();
    }

    private function createTables()
    {
        $sql = [];
        $sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'videos` (
            `id_video` INT AUTO_INCREMENT PRIMARY KEY,
            `title` VARCHAR(255) NOT NULL,
            `description` TEXT,
            `url` VARCHAR(255) NOT NULL,
            `watch_time` INT,
            `brand_id` INT,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;';
        
        $sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'brands` (
            `id_brand` INT AUTO_INCREMENT PRIMARY KEY,
            `name` VARCHAR(255) NOT NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;';

        foreach ($sql as $query) {
            if (!Db::getInstance()->execute($query)) {
                return false;
            }
        }
        return true;
    }

    private function deleteTables()
    {
        $sql = [];
        $sql[] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'videos`';
        $sql[] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'brands`';

        foreach ($sql as $query) {
            if (!Db::getInstance()->execute($query)) {
                return false;
            }
        }
        return true;
    }

    private function registerTab()
    {
        $tab = new Tab();
        $tab->active = 1;
        $tab->class_name = 'AdminVideoManager';
        $tab->name = array_fill_keys(Language::getIDs(false), 'Video Manager');
        $tab->id_parent = (int)Tab::getIdFromClassName('AdminParentModulesSf');
        $tab->module = $this->name;
        return $tab->add();
    }

    private function unregisterTab()
    {
        $id_tab = (int)Tab::getIdFromClassName('AdminVideoManager');
        if ($id_tab) {
            $tab = new Tab($id_tab);
            return $tab->delete();
        }
        return true;
    }
}
