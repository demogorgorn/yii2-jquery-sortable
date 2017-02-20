<?php
/**
 * @copyright Copyright &copy; Oleg Martemjanov, 2017
 * @package yii2-jquery-sortable
 * @version 1.0
 */
namespace demogorgorn\jquerysortable;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
/**
 * Create a flexible, opinionated sorting plugin for jQuery
 *
 * @see https://johnny.github.io/jquery-sortable/
 * @author Oleg Martemjanov <demogorgorn@gmail.com>
 * @since 1.0
 */
class Sortable extends \yii\base\Widget
{
    public $options = [];
    
    public $clientOptions = [];

    /**
     * @var array the sortable items configuration for rendering elements within the sortable
     * list / grid. You can set the following properties:
     * - content: string, the list item content (this is not HTML encoded)
     * - disabled: bool, whether the list item is disabled
     * - options: array, the HTML attributes for the list item.
     */
    public $items = [];

    public $listTag = 'ul';

    /**
     * Initializes the widget
     */
    public function init()
    {
        parent::init();
        if (!isset($this->options['id'])) 
            $this->options['id'] = $this->getId();
        $this->registerAssets();
    }

    /**
     * Runs the widget
     *
     * @return string|void
     */
    public function run()
    {
        echo $this->createList($this->items, $this->options);
    }

    /**
     * Render the list items for the sortable widget
     *
     * @return string 
     */
    public function createList($items, $options = []) {

        $htmlTree = Html::beginTag($this->listTag, $options);

        foreach ($items as $item) {
            $htmlTree .= $this->renderItem($item);
        }
        $htmlTree .= Html::endTag($this->listTag);

        return $htmlTree;
    }

    public function renderItem($item)
    {
        if (!isset($item['content'])) {
            throw new InvalidConfigException("The 'content' option is required.");
        }

        $content = ArrayHelper::getValue($item, 'content', '');
        $options = ArrayHelper::getValue($item, 'options', []);

        $items = "";
        if (isset($item['items']) and !empty($item['items'])) {
            $items = $this->createList($item['items']);
        }

        return Html::tag('li', $content . $items, $options);
    }

    /**
     * Register client assets
     */
    public function registerAssets()
    {
        $view = $this->getView();
        SortableAsset::register($view);
        
        $id = $this->options['id'];
        $clientOptions = Json::encode($this->clientOptions, JSON_FORCE_OBJECT);

        $js = '$("#' . $id . '").sortable(' . $clientOptions . ');';

        $view->registerJs($js);
    }
}