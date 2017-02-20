<?php
/**
 * @copyright Copyright &copy; Oleg Martemjanov, 2017
 * @package yii2-jquerysortable
 * @version 1.0
 */
namespace demogorgorn\jquerysortable;
/**
 * Sortable bundle for \demogorgorn\jquerysortable\Sortable
 *
 * @author Oleg Martemjanov <demogorgorn@gmail.com>
 * @since 1.0
 */
class SortableStyleAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@demogorgorn/jquerysortable/assets/';
    public $css = [
        'css/jquery-sortable.css'
    ];
	
}