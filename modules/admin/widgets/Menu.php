<?php
namespace app\modules\admin\widgets;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * Class Menu
 * @property mixed parentLinkClass
 * @package backend\components\widget
 */
class Menu extends \yii\widgets\Menu
{
    /**
     * @var string
     */
    public $linkTemplate = "<a href=\"{url}\" class='{class}'>\n{icon}\n<span class='hide-menu'>{label}{badge}</span></a>";
    /**
     * @var string
     */
    public $labelTemplate = "{icon}\n{label}\n{badge}";
    
    /**
     * @var string
     */
    public $badgeTag = 'span';
    /**
     * @var string
     */
    public $badgeClass = 'label pull-right';
    /**
     * @var string
     */
    public $parentLinkClass = 'has-arrow';
    /**
     * @var string
     */
    public $badgeBgClass;
    
    /**
     * Recursively renders the menu items (without the container tag).
     * @param array $items the menu items to be rendered recursively
     * @return string the rendering result
     */
    protected function renderItems($items)
    {
        $n = count($items);
        $lines = [];
        foreach ($items as $i => $item) {
            $options = array_merge($this->itemOptions, ArrayHelper::getValue($item, 'options', []));
            $tag = ArrayHelper::remove($options, 'tag', 'li');
            $class = [];
            if ($item['active']) {
                $class[] = $this->activeCssClass;
            }
            if ($i === 0 && $this->firstItemCssClass !== null) {
                $class[] = $this->firstItemCssClass;
            }
            if ($i === $n - 1 && $this->lastItemCssClass !== null) {
                $class[] = $this->lastItemCssClass;
            }
            Html::addCssClass($options, $class);
    
            if (!empty($item['items'])) {
                $menu = $this->renderItem($item, true);
                $submenuTemplate = ArrayHelper::getValue($item, 'submenuTemplate', $this->submenuTemplate);
                $menu .= strtr($submenuTemplate, [
                    '{items}' => $this->renderItems($item['items']),
                ]);
            } else {
                $menu = $this->renderItem($item);
            }
            $lines[] = Html::tag($tag, $menu, $options);
        }
        
        return implode("\n", $lines);
    }
    
    /**
     * @inheritdoc
     */
    protected function renderItem($item, $items = false)
    {
        $item['badgeOptions'] = isset($item['badgeOptions']) ? $item['badgeOptions'] : [];
        
        if (!ArrayHelper::getValue($item, 'badgeOptions.class')) {
            $bg = isset($item['badgeBgClass']) ? $item['badgeBgClass'] : $this->badgeBgClass;
            $item['badgeOptions']['class'] = $this->badgeClass.' '.$bg;
        }
        
        if (isset($item['url'])) {
            $template = ArrayHelper::getValue($item, 'template', $this->linkTemplate);
            
            if ($items) {
                return strtr($template, [
                    '{badge}'=> isset($item['badge'])
                        ? Html::tag('span', $item['badge'], $item['badgeOptions'])
                        : '',
                    '{icon}'=>isset($item['icon']) ? $item['icon'] : '',
                    '{url}' => Url::to($item['url']),
                    '{label}' => $item['label'],
                    '{class}' => $this->parentLinkClass
                ]);
            } else {
                return strtr($template, [
                    '{badge}'=> isset($item['badge'])
                        ? Html::tag('span', $item['badge'], $item['badgeOptions'])
                        : '',
                    '{icon}'=>isset($item['icon']) ? $item['icon'] : '',
                    '{url}' => Url::to($item['url']),
                    '{label}' => $item['label'],
                    '{class}' => false
                ]);
            }
        } else {
            $template = ArrayHelper::getValue($item, 'template', $this->labelTemplate);
            
            return strtr($template, [
                '{badge}'=> isset($item['badge'])
                    ? Html::tag('span', $item['badge'], $item['badgeOptions'])
                    : '',
                '{icon}'=>isset($item['icon']) ? $item['icon'] : '',
                '{label}' => $item['label'],
            ]);
        }
    }
}
