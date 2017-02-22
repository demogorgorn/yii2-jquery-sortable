# jQuery (Johnny) Sortable for Yii 2
=====================================

This is the useful widget for, in my humble opinion, the most powerful and flexible, opinionated sorting plugin for jQuery.
Why another sortable plugin? you might ask. Aren't there many others? 
The answer is: nested lists. None of the other solutions had a decent support for nested lists. nestedSortable relies on a fixed width hierarchy. Others mimic the way jQuery UI does sortables and therefore require ugly hacks that suffer from sudden jumps.

### Basic Example

The view:
```php
<?php 
use demogorgorn\jquerysortable\Sortable;

$items = [
        [
            'content' => 'First'
            'options' => ['class' => 'panel', 'data-id' => 12]
        ],
        [
            'content' => 'Second'
            'options' => ['class' => 'panel', 'data-id' => 13],
            'items' => [
                [
                    'content' => 'Nested 1'
                    'options' => ['class' => 'panel', 'data-id' => 14]
                ],
                [
                    'content' => 'Nested 2'
                    'options' => ['class' => 'another class']
                ],

            ]

        ],
        
    ];

echo Sortable::widget([

    'listTag' => 'ol',
    'autoNestedEnabled' => true,
    'useDragHandle' => FA::icon('bars', ['style' => 'margin: 4px;']),
    'options' => [
        'class' => 'vertical',
        'id' => 'menulist',
    ],
    'items'=> $items,
    'clientOptions' => [
        'handle' => '.fa-bars',
        'onDragStart' => new \yii\web\JsExpression('function ($item, container, _super) {
                // Duplicate items of the no drop area
                if(!container.options.drop)
                    $item.clone().insertAfter($item);
                    _super($item, container);
        }'),

    ],
]); ?>
```

### Widget's options

Variable | Description | Type
------------ | ------------- | -------------
clientOptions | JS widget options | Array
options | HTML attributes and other options of the widget's container tag | Array
items | array of the sortable items configuration for rendering elements within the sortable list / grid. | Array
listTag | the tag to use for a container | String
useDragHandle | whether the handle for drag should be used. If you want to use drag handle just specify it's html code: e.g., _<i class="fa fa-bars"></i>_. Please notice that you should set the handle param in clientOptions manually. E.g. '.fa-bars'. By default is set to false. | Boolean / String
autoNestedEnabled | enable auto nested mode. By default Sortable support nested lists only in cases when these nested lists were defined when Sortable was initialized. | Boolean
appendElement | HTML element which will be appended to each list item. To disable set it to false. | Boolean / String

*Please note You can set the following properties:*

     * content: string, the list item content (this is not HTML encoded)
     * disabled: bool, whether the list item is disabled
     * options: array, the HTML attributes for the list item.

## Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require demogorgorn/yii2-jquery-sortable "*"
```

or add

```
"demogorgorn/yii2-jquery-sortable": "*"
```

to the require section of your `composer.json` file and run `composer update`.
