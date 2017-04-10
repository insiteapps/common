<?php

//use SilverStripe\Admin\ModelAdmin;
//use SilverStripe\Forms\GridField\GridFieldFilterHeader;

class InsiteModelAdmin extends ModelAdmin
{

    private static $url_segment = 'insite-model';
    private static $menu_title = 'Insite';
    private static $menu_priority = 5;
    private static $page_length = 100;

    private static $model_importers = array();
    private static $managed_models = array();

    public function getEditForm($id = null, $fields = null)
    {
        $sortableModels = array();
        $form = parent::getEditForm($id, $fields);
        $gridFieldNames = array_merge($sortableModels, self::config()->managed_models);
        foreach ($gridFieldNames as $gridFieldName) {
            $gridField = $form->Fields()->fieldByName($gridFieldName);
            if ($gridField) {
                $Confing = $gridField->getConfig();
                $Confing->addComponent(new GridFieldFilterHeader());
                $Confing->addComponent(new GridFieldSortableRows('SortOrder'));

            }

        }
        return $form;
    }

}
