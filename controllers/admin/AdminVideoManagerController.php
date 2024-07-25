<?php

class AdminVideoManagerController extends ModuleAdminController
{
    public function __construct()
    {
        $this->table = 'videos';
        $this->className = 'Video';
        $this->bootstrap = true;

        parent::__construct();

        $this->fields_list = [
            'id_video' => ['title' => $this->l('ID'), 'align' => 'center', 'class' => 'fixed-width-xs'],
            'title' => ['title' => $this->l('Title')],
            'description' => ['title' => $this->l('Description')],
            'url' => ['title' => $this->l('URL')],
            'watch_time' => ['title' => $this->l('Watch Time')],
            'brand_id' => ['title' => $this->l('Brand ID')],
            'created_at' => ['title' => $this->l('Created At')],
        ];

        $this->_select = 'b.name as brand';
        $this->_join = 'LEFT JOIN ' . _DB_PREFIX_ . 'brands b ON (a.brand_id = b.id_brand)';
    }

    public function renderForm()
    {
        $this->fields_form = [
            'legend' => ['title' => $this->l('Video Details')],
            'input' => [
                ['type' => 'text', 'label' => $this->l('Title'), 'name' => 'title', 'required' => true],
                ['type' => 'textarea', 'label' => $this->l('Description'), 'name' => 'description'],
                ['type' => 'text', 'label' => $this->l('URL'), 'name' => 'url', 'required' => true],
                ['type' => 'text', 'label' => $this->l('Watch Time'), 'name' => 'watch_time'],
                ['type' => 'select', 'label' => $this->l('Brand'), 'name' => 'brand_id', 'options' => [
                    'query' => $this->getBrands(),
                    'id' => 'id_brand',
                    'name' => 'name'
                ]],
            ],
            'submit' => ['title' => $this->l('Save')]
        ];

        return parent::renderForm();
    }

    private function getBrands()
    {
        $sql = 'SELECT id_brand, name FROM ' . _DB_PREFIX_ . 'brands';
        return Db::getInstance()->executeS($sql);
    }

    public function renderList()
    {
        $searchQuery = Tools::getValue('search_query', '');
        $this->_where = '';
        if ($searchQuery) {
            $this->_where .= ' AND (a.title LIKE "%' . pSQL($searchQuery) . '%" OR a.description LIKE "%' . pSQL($searchQuery) . '%")';
        }
        return parent::renderList();
    }

    public function initPageHeaderToolbar()
    {
        $this->page_header_toolbar_btn['new'] = [
            'href' => self::$currentIndex . '&addvideo&token=' . $this->token,
            'desc' => $this->l('Add new video'),
            'icon' => 'process-icon-new'
        ];
        parent::initPageHeaderToolbar();
    }
}
