<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 17/1/7 下午3:29
 */

namespace app\components\libs;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\Nav;

class NavLTE extends Nav {

    /**
     * @var string default icon for menu items.
     * @see renderITem
     */
    public $iconDefault = 'chevron-right';

    /**
     * @var string default icon for sub menu items.
     * @see renderITem
     */
    public $iconSubDefault = 'angle-double-right';

    /**
     * @var string default badge background.
     * @see renderITem
     */
    public $badgeColorDefault = '';

    /**
     * @var array available badge background colors.
     * @see renderITem
     */
    public $badgeColorAvailable = [ 'gray', 'black', 'red', 'yellow', 'aqua', 'blue', 'light-blue', 'green', 'navy', 'teal', 'olive', 'lime', 'orange', 'fuchsia', 'purple', 'maroon' ];

    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
        Html::addCssClass($this->options, 'sidebar-menu');
    }

    /**
     * Renders a widget's item.
     * @param string|array $item the item to render.
     * @return string the rendering result.
     * @throws InvalidConfigException
     */
    public function renderItem($item, $sub = false)
    {
        if (is_string($item)) {
            return $item;
        }
        if (!isset($item['label'])) {
            throw new InvalidConfigException("The 'label' option is required.");
        }
        $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
        $label = $encodeLabel ? Html::encode($item['label']) : $item['label'];
        $options = ArrayHelper::getValue($item, 'options', []);
        if(!$sub) $items = ArrayHelper::getValue($item, 'items');
        $ico = ArrayHelper::getValue($item, 'ico');
        $textClass = ArrayHelper::getValue($item, 'textClass');
        $badge = ArrayHelper::getValue($item, 'badge');
        $url = ArrayHelper::getValue($item, 'url', '#');
        $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);

        if (isset($item['active'])) {
            $active = ArrayHelper::remove($item, 'active', false);
        } else {
            $active = $this->isItemActive($item);
        }

        $submenu = '';
        if (!$sub && $items !== null) {
            Html::addCssClass($options, 'treeview');
            $submenuClass = array();
            Html::addCssClass($submenuClass, 'fa');
            Html::addCssClass($submenuClass, 'fa-angle-left');
            Html::addCssClass($submenuClass, 'pull-right');
            $submenu = ' ' . Html::tag('i', '', $submenuClass);
            if (is_array($items)) {
                if ($this->activateItems) {
                    $items = $this->isChildActive($items, $active);
                }
                $items = $this->renderSubItems($items);
            }
        }

        if (!$ico) {
            $ico = $sub ? $this->iconSubDefault : $this->iconDefault;
        };

        if ($this->activateItems && $active) {
            Html::addCssClass($options, 'active');
        }

        $icoOptions = array();
        Html::addCssClass($icoOptions, 'fa');
        Html::addCssClass($icoOptions, 'fa-'.$ico);
        $textOptions = array();
        if (is_array($textClass)) {
            foreach($textClass as $tc) if (is_string($tc) && $tc != '') {
                Html::addCssClass($textOptions, $tc);
            };
        } else if (is_string($textClass) && $textClass != '') {
            Html::addCssClass($textOptions, $textClass);
        };
        $badgeStr = '';
        if ($badge) {
            if (is_string($badge) && $badge != '') $badge = [ 'text' => $badge ];
            if (is_array($badge) && (isset($badge['text']) || isset($badge['ico']))) {
                if (!isset($badge['text'])) $badge['text'] = '';
                $infoTagOptions = array();
                Html::addCssClass($infoTagOptions, 'badge');
                Html::addCssClass($infoTagOptions, 'pull-right');
                if (isset($badge['color']) && in_array($badge['color'], $this->badgeColorAvailable)) {
                    Html::addCssClass($infoTagOptions, 'bg-'.$badge['color']);
                } else {
                    if($this->badgeColorDefault != '') Html::addCssClass($infoTagOptions, 'bg-'.$this->badgeColorDefault);
                };
                if (isset($badge['ico'])) {
                    $baio = array();
                    Html::addCssClass($baio, 'fa');
                    Html::addCssClass($baio, 'fa-'.$badge['ico']);
                    $badge['text'] = Html::tag('i', '', $baio) . ($badge['text'] ? ' ' . $badge['text'] : '');
                };
                $badgeStr = ' ' .Html::tag('small', $badge['text'], $infoTagOptions);
            };
        };
        if(!$sub) {
            $label = Html::tag('i', '', $icoOptions) . ' ' . Html::tag('span', $label, $textOptions) . $submenu . $badgeStr;
        } else {
            $label = Html::tag('i', '', $icoOptions) . ' ' . $label . $badgeStr;
        };

        if(!isset($items)) $items = '';
        return Html::tag('li', Html::a($label, $url, $linkOptions) . $items, $options);
    }

    /**
     * Renders widget subitems
     * @param string|array $item the item to render.
     * @return string the rendering result.
     */
    public function renderSubItems($items) {
        $it = [];
        foreach ($items as $item) {
            if (!isset($item['visible']) || $item['visible'])  {
                $it[] = $this->renderItem($item, true);
            }
        }

        return Html::tag('ul', implode("\n", $it), ['class' => 'treeview-menu']);
    }



};