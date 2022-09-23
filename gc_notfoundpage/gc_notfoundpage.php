<?php
/**
* 2007-2022 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2022 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/



if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShop\PrestaShop\Adapter\Category\CategoryProductSearchProvider;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchContext;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchQuery;
use PrestaShop\PrestaShop\Core\Product\Search\SortOrder;

class Gc_notfoundpage extends Module
{
    protected $config_form = false;

    public function __construct()
    {
        $this->name = 'gc_notfoundpage';
        $this->tab = 'content_management';
        $this->version = '0.1.0';
        $this->author = 'Josias Olaya';
        $this->need_instance = 0;
        $this->bootstrap = true;
        parent::__construct();
        $this->displayName = $this->l('Not Found Page');
        $this->description = $this->l('Not found page design');
        $this->confirmUninstall = $this->l('Are you sure you want to uninstall this module?');
        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);
    }

    public function install()
    {
        Configuration::updateValue('HOME_FEATURED_CAT', (int) Context::getContext()->shop->getCategory());
        return parent::install() && $this->registerHook('displayPageNotFound')
        && $this->registerHook('actionFrontControllerSetMedia')
        && $this->registerHook('displayPopularProducts')
        && $this->registerHook('displayHome')
        && $this->registerHook('displayOrderConfirmation2')
        && $this->registerHook('displayCrossSellingShoppingCart')
        && $this->registerHook('actionCategoryUpdate')
        && $this->registerHook('actionAdminGroupsControllerSaveAfter');
    }

    public function uninstall()
    {
        return parent::uninstall();
    }

    private function getForm()
    {
        $helper = new HelperForm();
        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->identifier = $this->identifier;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->languages = $this->context->controller->getLanguages();
        $helper->currentIndex = AdminController::$currentIndex . '&configure=' . $this->name;
        $helper->default_form_language = $this->context->controller->default_form_language;
        $helper->allow_employee_form_lang = $this->context->controller->allow_employee_form_lang;
        $helper->title = $this->displayName;
        $helper->submit_action = 'gc_submitpnf';

        $helper->fields_value = [
            'message' => Configuration::get('GC_NFP_MESSAGE'),
            'image' => Configuration::get('GC_NFP_IMAGE'),
        ];


        $form[] = [
            'form' => [
                'legend' => [
                    'title' => $this->l('Pagina no encontrada')
                ],
                'input' => [
                    [
                        'label' => 'Message',
                        'type' => 'text',
                        'name' => 'message'
                    ],
                    [
                        'label' => 'Image',
                        'type' => 'file',
                        'name' => 'image'
                    ],
                    [
                        'label' => 'Note lo puedo creer',
                        'type' => 'categories',
                        'name' => 'HOME_FEATURED_CAT',
                        'tree' => [
                            'id' => 'home_featured_category',
                            'selected_categories' => [Configuration::get('HOME_FEATURED_CAT')],
                        ],
                    ],  
                ],
                'submit' => [
                    'title' => $this->l('Save')
                ],
            ],
        ];

        return $helper->generateForm($form);
    }

    public function getContent()
    {
        $output = '';
        $errors = [];

        if (Tools::isSubmit('submitHomeFeatured')) {
            $cat = Tools::getValue('HOME_FEATURED_CAT');
            if (!Validate::isInt($cat) || $cat <= 0) {
                $errors[] = $this->trans('The category ID is invalid. Please choose an existing category ID.', [], 'Modules.Featuredproducts.Admin');
            }

            if (count($errors)) {
                $output = $this->displayError(implode('<br />', $errors));
            } else {
                Configuration::updateValue('HOME_FEATURED_CAT', (int) $cat);

                $this->_clearCache('*');

                $output = $this->displayConfirmation($this->trans('The settings have been updated.', [], 'Admin.Notifications.Success'));
            }
        }
        return $output . $this->postProcess() . $this->getForm();
    }

    private function postProcess()
    {
        if (Tools::isSubmit('gc_submitpnf'))
        {
            $message = Tools::getValue('message');
            Configuration::updateValue('GC_NFP_MESSAGE', $message);
            $image = Tools::getValue("image");
            Configuration::updateValue('GC_NFP_IMAGE', $image);
            //$this->html .= $this->displayConfirmation($this->l('Guardado Correctamente'));
        }
    }

    public function HookDisplayPageNotFound()
    {
        $message = Configuration::get('GC_NFP_MESSAGE');
        $image = Configuration::get('GC_NFP_IMAGE');
        $products = $this->getProducts();

        $this->context->smarty->assign([
            'message' => $message,
            'image' => $image,
            'products' => $products,
        ]);
        return $this->display(__FILE__, 'views/templates/hook/page.tpl');
    }

    public function HookDisplayPopularProducts()
    {
        $message = Configuration::get('GC_NFP_MESSAGE');
        $image = Configuration::get('GC_NFP_IMAGE');
        $products = $this->getProducts();

        $this->context->smarty->assign([
            'message' => $message,
            'image' => $image,
            'products' => $products,
        ]);
        return $this->display(__FILE__, 'views/templates/hook/page.tpl');
    }

    public function HookActionFrontControllerSetMedia($params)
    {
        $this->context->controller->registerStylesheet('gc_notfoundpage', 'modules/gc_notfoundpage/views/css/gc_pagenotfound.css', ['media' => 'all', 'priority' => 160]);
    }

    protected function getProducts()
    {
        $category = new Category((int) Configuration::get('HOME_FEATURED_CAT'));

        $searchProvider = new CategoryProductSearchProvider(
            $this->context->getTranslator(),
            $category
        );

        $context = new ProductSearchContext($this->context);

        $query = new ProductSearchQuery();

        
        $nProducts = 12;
        

        $query
            ->setResultsPerPage($nProducts)
            ->setPage(1)
        ;

        
        $query->setSortOrder(new SortOrder('product', 'position', 'asc'));
        

        $result = $searchProvider->runQuery(
            $context,
            $query
        );

        $assembler = new ProductAssembler($this->context);

        $presenterFactory = new ProductPresenterFactory($this->context);
        $presentationSettings = $presenterFactory->getPresentationSettings();
        $presenter = $presenterFactory->getPresenter();

        $products_for_template = [];

        foreach ($result->getProducts() as $rawProduct) {
            $products_for_template[] = $presenter->present(
                $presentationSettings,
                $assembler->assembleProduct($rawProduct),
                $this->context->language
            );
        }

        return $products_for_template;
    }

    public function setConfigFormValues($form_values)
    {
        foreach (array_keys($form_values) as $key) {
            Configuration::updateValue($key, Tools::getValue($key));
        }
    }

    
}
    // public function getContent()
    // {
    //     /**
    //      * If values have been submitted in the form, process.
    //      */
    //     if (((bool)Tools::isSubmit('submitGc_notfoundpageModule')) == true) {
    //         $this->postProcess();
    //     }

    //     $this->context->smarty->assign('module_dir', $this->_path);

    //     $output = $this->context->smarty->fetch($this->local_path.'views/templates/admin/configure.tpl');

    //     return $output.$this->renderForm();
    // }

    // /**
    //  * Create the form that will be displayed in the configuration of your module.
    //  */
    // protected function renderForm()
    // {
    //     $helper = new HelperForm();

    //     $helper->show_toolbar = false;
    //     $helper->table = $this->table;
    //     $helper->module = $this;
    //     $helper->default_form_language = $this->context->language->id;
    //     $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);

    //     $helper->identifier = $this->identifier;
    //     $helper->submit_action = 'submitGc_notfoundpageModule';
    //     $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
    //         .'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
    //     $helper->token = Tools::getAdminTokenLite('AdminModules');

    //     $helper->tpl_vars = array(
    //         'fields_value' => $this->getConfigFormValues(), /* Add values for your inputs */
    //         'languages' => $this->context->controller->getLanguages(),
    //         'id_language' => $this->context->language->id,
    //     );

    //     return $helper->generateForm(array($this->getConfigForm()));
    // }

    // /**
    //  * Create the structure of your form.
    //  */
    // protected function getConfigForm()
    // {
    //     return array(
    //         'form' => array(
    //             'legend' => array(
    //             'title' => $this->l('Settings'),
    //             'icon' => 'icon-cogs',
    //             ),
    //             'input' => array(
    //                 array(
    //                     'type' => 'switch',
    //                     'label' => $this->l('Live mode'),
    //                     'name' => 'GC_NOTFOUNDPAGE_LIVE_MODE',
    //                     'is_bool' => true,
    //                     'desc' => $this->l('Use this module in live mode'),
    //                     'values' => array(
    //                         array(
    //                             'id' => 'active_on',
    //                             'value' => true,
    //                             'label' => $this->l('Enabled')
    //                         ),
    //                         array(
    //                             'id' => 'active_off',
    //                             'value' => false,
    //                             'label' => $this->l('Disabled')
    //                         )
    //                     ),
    //                 ),
    //                 array(
    //                     'col' => 3,
    //                     'type' => 'text',
    //                     'prefix' => '<i class="icon icon-envelope"></i>',
    //                     'desc' => $this->l('Enter a valid email address'),
    //                     'name' => 'GC_NOTFOUNDPAGE_ACCOUNT_EMAIL',
    //                     'label' => $this->l('Email'),
    //                 ),
    //                 array(
    //                     'type' => 'password',
    //                     'name' => 'GC_NOTFOUNDPAGE_ACCOUNT_PASSWORD',
    //                     'label' => $this->l('Password'),
    //                 ),
    //             ),
    //             'submit' => array(
    //                 'title' => $this->l('Save'),
    //             ),
    //         ),
    //     );
    // }

    // /**
    //  * Set values for the inputs.
    //  */
    // protected function getConfigFormValues()
    // {
    //     return array(
    //         'GC_NOTFOUNDPAGE_LIVE_MODE' => Configuration::get('GC_NOTFOUNDPAGE_LIVE_MODE', true),
    //         'GC_NOTFOUNDPAGE_ACCOUNT_EMAIL' => Configuration::get('GC_NOTFOUNDPAGE_ACCOUNT_EMAIL', 'contact@prestashop.com'),
    //         'GC_NOTFOUNDPAGE_ACCOUNT_PASSWORD' => Configuration::get('GC_NOTFOUNDPAGE_ACCOUNT_PASSWORD', null),
    //     );
    // }

    // /**
    //  * Save form data.
    //  */
    // protected function postProcess()
    // {
    //     $form_values = $this->getConfigFormValues();

    //     foreach (array_keys($form_values) as $key) {
    //         Configuration::updateValue($key, Tools::getValue($key));
    //     }
    // }

    // /**
    // * Add the CSS & JavaScript files you want to be loaded in the BO.
    // */
    // public function hookBackOfficeHeader()
    // {
    //     if (Tools::getValue('module_name') == $this->name) {
    //         $this->context->controller->addJS($this->_path.'views/js/back.js');
    //         $this->context->controller->addCSS($this->_path.'views/css/back.css');
    //     }
    // }

    // /**
    //  * Add the CSS & JavaScript files you want to be added on the FO.
    //  */
    // public function hookHeader()
    // {
    //     $this->context->controller->addJS($this->_path.'/views/js/front.js');
    //     $this->context->controller->addCSS($this->_path.'/views/css/front.css');
    // }}
